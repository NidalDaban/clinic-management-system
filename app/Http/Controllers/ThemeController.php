<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ThemeController extends Controller
{
    public function index()
    {
        return view('theme.index');
    }

    public function doctors()
    {
        $doctors = User::where('role', 'doctor')->with('doctorReviews')->get();
        return view('theme.doctors', compact('doctors'));
    }

    public function psychologists()
    {
        $psychologists = User::where('role', 'psychologist')->with('psychologistReviews')->get();
        return view('theme.psychologists', compact('psychologists'));
    }

    public function contact()
    {
        return view('theme.contact');
    }

    public function doctorDetails()
    {
        return view('theme.doctorDetails');
    }

    public function login()
    {
        return view('theme.partials.login');
    }

    public function register()
    {
        return view('theme.partials.register');
    }

    public function profile()
    {
        return view('theme.Profile.masterProfile');
    }

    public function fetchAppointments(Request $request)
    {
        $user = Auth::user();
        $type = $request->type;

        $query = Appointment::with(['doctor', 'psychologist', 'service'])
            ->where('patient_id', $user->id);

        if ($type === 'upcoming') {
            $query->whereIn('status', ['pending', 'confirmed']);
        } else {
            $query->whereIn('status', ['completed', 'cancelled']);
        }

        $appointments = $query
            ->orderBy('appointment_datetime', 'desc')
            ->paginate(5);

        return view('theme.Profile.profilePartials.appointmentTable', compact('appointments'))->render();
    }

    public function appointment()
    {
        return view('theme.partials.makeAppointment');
    }

    public function liveSession()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'You must be logged in to access live sessions.');
        }

        $user = Auth::user();

        $upcomingAppointment = Appointment::with('doctor')
            ->where('patient_id', $user->id)
            ->whereIn('status', ['confirmed', 'pending'])
            ->where('appointment_datetime', '>=', now()->subMinutes(10))
            ->orderBy('appointment_datetime')
            ->first();

        return view('theme.liveSessions', compact('upcomingAppointment'));
    }

}
