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
            return redirect()->back()->with('Invalid recipient role.');
        }

        return view('theme.appointment', compact('recipient', 'services'));
    }

    public function store(StoreAppointmentRequest $request)
    {
        try {
            $validated = $request->validated();
            $recipient = User::findOrFail($validated['recipient_id']);

            // Handle optional payment creation
            $paymentId = null;
            if ($validated['attends'] === 'online' && isset($validated['total_amount'])) {
                $payment = Payment::create([
                    'total_amount' => $validated['total_amount'],
                    'method' => $validated['method'] ?? null,
                    'additional_note' => $validated['payment_note'] ?? null,
                ]);
                $paymentId = $payment->id;
            }

            // Set common appointment data
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

            // Assign doctor or psychologist based on role
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


    // public function store(Request $request)
    // {
    //     try {
    //         $validated = $request->validate([
    //             'recipient_id' => 'required|exists:users,id',
    //             'appointment_datetime' => 'required|date|after:now',
    //             'attends' => 'required|in:online,clinic',
    //             'addintional_note' => 'nullable|string|max:1000',
    //         ]);

    //         $recipient = User::findOrFail($validated['recipient_id']);

    //         $data = [
    //             'patient_id' => Auth::id(),
    //             'appointment_datetime' => $validated['appointment_datetime'],
    //             'attends' => $validated['attends'],
    //             'addintional_note' => $validated['addintional_note'],
    //             'doctor_id' => null,
    //             'psychologist_id' => null,
    //         ];

    //         if ($recipient->role === 'doctor') {
    //             $data['doctor_id'] = $recipient->id;
    //         } elseif ($recipient->role === 'psychologist') {
    //             $data['psychologist_id'] = $recipient->id;
    //         } else {
    //             return redirect()->back()->with('error', 'Only doctors or psychologists can be booked.');
    //         }

    //         Appointment::create($data);

    //         return redirect()->back()->with('success', 'Appointment booked successfully!');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->with('error', 'Failed to book the appointment. Please try again.');
    //     }
    // }
}
