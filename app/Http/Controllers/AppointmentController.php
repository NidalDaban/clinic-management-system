<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAppointmentRequest;
use App\Models\Appointment;
use App\Models\Payment;
use App\Models\Service;
use App\Models\User;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AppointmentController extends Controller
{
    public function show($id)
    {
        $appointment = Appointment::with(['patient', 'doctor', 'psychologist', 'secretary'])->findOrFail($id);
        return view('appointment.show', compact('appointment'));
    }

    public function profile()
    {
        $user = Auth::user();

        // Upcoming Appointments: status = pending or confirmed
        $upcomingAppointments = Appointment::with(['doctor', 'psychologist', 'service'])
            ->where('patient_id', $user->id)
            ->whereIn('status', ['pending', 'confirmed'])
            ->orderBy('appointment_datetime', 'desc')
            ->paginate(5, ['*'], 'upcoming_page'); // Important to use unique page name

        // Past Appointments: status = completed or cancelled
        $pastAppointments = Appointment::with(['doctor', 'psychologist', 'service'])
            ->where('patient_id', $user->id)
            ->whereIn('status', ['completed', 'cancelled'])
            ->orderBy('appointment_datetime', 'desc')
            ->paginate(5, ['*'], 'past_page'); // Also unique

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

    public function store(StoreAppointmentRequest $request)
    {
        try {
            $validated = $request->validated();
            $recipient = User::findOrFail($validated['recipient_id']);

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

            Appointment::create($data);

            return redirect()->back()->with('success', 'Appointment booked successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to book the appointment. Please try again.');
        }
    }
}
