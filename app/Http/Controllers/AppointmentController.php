<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Models\Payment;
use App\Models\Service;
use App\Models\User;
use App\Services\ZoomService;
use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AppointmentController extends Controller
{
    public function index() {}

    public function show($id)
    {
        $appointment = Appointment::with(['patient', 'doctor', 'psychologist', 'secretary'])->findOrFail($id);
        return view('appointment.show', compact('appointment'));
    }

    public function profile()
    {
        $user = Auth::user();

        $upcomingAppointments = Appointment::with(['doctor', 'psychologist', 'service'])
            ->where('patient_id', $user->id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->orderBy('appointment_datetime', 'desc')
            ->paginate(5, ['*'], 'upcoming_page');

        $pastAppointments = Appointment::with(['doctor', 'psychologist', 'service'])
            ->where('patient_id', $user->id)
            ->whereIn('status', ['completed', 'cancelled'])
            ->orderBy('appointment_datetime', 'desc')
            ->paginate(5, ['*'], 'past_page');

        return view('theme.Profile.masterProfile', compact('upcomingAppointments', 'pastAppointments'));
    }


    public function create($doctor_id)
    {
        $recipient = User::findOrFail($doctor_id);

        if (!in_array($recipient->role, ['doctor', 'psychologist'])) {
            return redirect()->back()->with('error', 'You can only book appointments with doctors or psychologists.');
        }

        if ($recipient->role === 'doctor') {
            $services = Service::whereIn('type', ['therapy', 'consultation'])->get();
        } elseif ($recipient->role === 'psychologist') {
            $services = Service::where('type', 'therapy')->get();
        } else {
            return redirect()->back()->with('error', 'Invalid recipient role.');
        }

        return view('theme.appointment', [
            'recipient' => $recipient,
            'services' => $services,
            'doctor' => $recipient,
        ]);
    }

    public function store(StoreAppointmentRequest $request, ZoomService $zoom)
    {
        try {
            $validated = $request->validated();
            $recipient = User::findOrFail($validated['recipient_id']);
            $patientId = Auth::id();

            $existingAppointment = Appointment::where('patient_id', $patientId)
                ->whereIn('status', ['pending', 'confirmed'])
                ->first();

            if ($existingAppointment) {
                return redirect()->back()
                    ->with('error', 'You already have an active appointment ' . $existingAppointment->status . '(with Dr. ' . $recipient->first_name . ' ' . $recipient->last_name . '). Please complete or cancel it before booking a new one.');
            }

            $paymentId = null;
            if ($validated['attends'] === 'online' && isset($validated['total_amount'])) {
                $payment = Payment::create([
                    'total_amount' => $validated['total_amount'],
                    'method' => $validated['method'] ?? null,
                    'additional_note' => $validated['payment_note'] ?? null,
                ]);
                $paymentId = $payment->id;
            }

            $data = [
                'patient_id' => Auth::id(),
                'appointment_datetime' => $validated['appointment_datetime'],
                'attends' => $validated['attends'],
                'addintional_note' => $validated['addintional_note'] ?? null,
                'doctor_id' => null,
                'psychologist_id' => null,
                'payment_id' => $paymentId,
                'service_id' => $validated['service_id'],
                'status' => 'pending',
            ];

            if ($recipient->role === 'doctor') {
                $data['doctor_id'] = $recipient->id;
            } elseif ($recipient->role === 'psychologist') {
                $data['psychologist_id'] = $recipient->id;
            } else {
                return redirect()->back()->with('error', 'You can only book appointments with doctors or psychologists.');
            }

            $appointment = Appointment::create($data);

            // Create Zoom meeting if it's an online appointment
            if ($appointment->attends === 'online') {
                $meeting = $zoom->createMeeting(
                    'RafiqCare Therapy Session',
                    Carbon::parse($appointment->appointment_datetime)->toIso8601String(),
                    60
                );

                logger()->info('Created Zoom Meeting:', ['meeting' => $meeting]);

                if ($meeting && isset($meeting['join_url'])) {
                    $appointment->zoom_meeting_url = $meeting['join_url'];
                    $appointment->save();
                }

                if (!$meeting || !isset($meeting['join_url'])) {
                    return redirect()->back()->with('error', 'Zoom meeting could not be created.');
                }

                $appointment->update([
                    'zoom_join_url' => $meeting['join_url'],
                    'zoom_start_url' => $meeting['start_url'],
                ]);
            }

            return redirect()->back()->with('success', 'Appointment booked successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to book the appointment. Please try again.');
        }
    }
}
