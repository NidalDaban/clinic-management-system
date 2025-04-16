<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
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

    public function create($recipient_id)
    {
        $recipient = User::findOrFail($recipient_id);

        if (!in_array($recipient->role, ['doctor', 'psychologist'])) {
            return redirect()->back()->with('error', 'You can only book appointments with doctors or psychologists.');
        }

        return view('theme.appointment', compact('recipient'));
    }

    public function store(Request $request)
    {
        try {
            $validated = $request->validate([
                'recipient_id' => 'required|exists:users,id',
                'appointment_datetime' => 'required|date|after:now',
                'attends' => 'required|in:online,clinic',
                'addintional_note' => 'nullable|string|max:1000',
            ]);

            $recipient = User::findOrFail($validated['recipient_id']);

            $data = [
                'patient_id' => Auth::id(),
                'appointment_datetime' => $validated['appointment_datetime'],
                'attends' => $validated['attends'],
                'addintional_note' => $validated['addintional_note'],
                'doctor_id' => null,
                'psychologist_id' => null,
            ];

            if ($recipient->role === 'doctor') {
                $data['doctor_id'] = $recipient->id;
            } elseif ($recipient->role === 'psychologist') {
                $data['psychologist_id'] = $recipient->id;
            } else {
                return redirect()->back()->with('error', 'Only doctors or psychologists can be booked.');
            }

            Appointment::create($data);

            return redirect()->back()->with('success', 'Appointment booked successfully!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to book the appointment. Please try again.');
        }
    }
}
