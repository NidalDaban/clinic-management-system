<?php

namespace App\Http\Controllers;

use App\Enums\DayOfWeek;
use App\Http\Controllers\Controller;
use App\Models\Appointment;
use App\Models\DailySchedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ThemeDoctorController extends Controller
{

    public function index(Request $request)
    {
        $doctorId = auth()->id();
        $today = \Carbon\Carbon::today();

        $appointmentsToday = Appointment::with(['patient.country'])
            ->where('doctor_id', $doctorId)
            ->whereDate('appointment_datetime', $today)
            ->paginate(5, ['*'], 'todayPage');

        $appointmentsUpcoming = Appointment::with(['patient.country'])
            ->where('doctor_id', $doctorId)
            ->whereDate('appointment_datetime', '>', $today)
            ->paginate(5, ['*'], 'upcomingPage');

        foreach ($appointmentsToday as $appointment) {
            $patient = $appointment->patient;

            if ($patient) {
                $patient->image_url = $this->getPatientImageUrl($patient);
            }
        }

        foreach ($appointmentsUpcoming as $appointment) {
            $patient = $appointment->patient;

            if ($patient) {
                $patient->image_url = $this->getPatientImageUrl($patient);
            }
        }

        if ($request->ajax()) {
            if ($request->type === 'today') {
                return view('themeDoctor.partials.appointment-table-rows', [
                    'appointments' => $appointmentsToday,
                ])->render();
            } elseif ($request->type === 'upcoming') {
                return view('themeDoctor.partials.appointment-table-rows', [
                    'appointments' => $appointmentsUpcoming,
                ])->render();
            }
        }

        return view('themeDoctor.dashboard', compact('appointmentsToday', 'appointmentsUpcoming'));
    }

    private function getPatientImageUrl($patient)
    {
        if (!$patient->image) {
            $gender = strtolower($patient->gender);
            return $gender === 'female'
                ? 'https://cdn-icons-png.flaticon.com/512/6997/6997662.png'
                : 'https://cdn-icons-png.flaticon.com/512/4140/4140039.png';
        }

        return asset('storage/app/public/images/' . $patient->image);
    }

    public function fetchAppointments(Request $request)
    {
        $doctorId = auth()->id();
        $today = \Carbon\Carbon::today();
        $type = $request->input('type');
        $page = $request->input('page', 1);
        $perPage = 5;

        if ($type === 'today') {
            $appointments = Appointment::with(['patient.country'])
                ->where('doctor_id', $doctorId)
                ->whereDate('appointment_datetime', $today)
                ->paginate($perPage, ['*'], 'todayPage', $page);
        } elseif ($type === 'upcoming') {
            $appointments = Appointment::with(['patient.country'])
                ->where('doctor_id', $doctorId)
                ->whereDate('appointment_datetime', '>', $today)
                ->paginate($perPage, ['*'], 'upcomingPage', $page);
        } else {
            return response()->json(['error' => 'Invalid type'], 400);
        }

        // Add image URLs to patients
        foreach ($appointments as $appointment) {
            if ($appointment->patient) {
                $appointment->patient->image_url = $this->getPatientImageUrl($appointment->patient);
            }
        }

        $html = view('themeDoctor.partials.appointment-table-rows', ['appointments' => $appointments])->render();
        $pagination = $appointments->links('pagination::bootstrap-5')->render();

        return response()->json([
            'rows' => $html,
            'pagination' => $pagination,
        ]);
    }

    public function liveSessions()
    {
        $doctorId = auth()->id();

        $upcomingAppointment = Appointment::with('patient')
            ->where('doctor_id', $doctorId)
            ->where('appointment_datetime', '>=', now())
            ->orderBy('appointment_datetime')
            ->first();

        return view('themeDoctor.liveSessions', compact('upcomingAppointment'));
    }

    public function schedualeTimings()
    {
        $days = DayOfWeek::cases();

        $schedules = DailySchedule::forUser(auth()->user())
            ->with('slots')
            ->get()
            ->keyBy(function ($item) {
                return $item->day_of_week->value;
            });

        return view('themeDoctor.schedualeTimings', [
            'days' => $days,
            'schedules' => $schedules
        ]);
    }

    public function reviews()
    {
        return view('themeDoctor.reviews');
    }

    public function profileSettings()
    {
        return view('themeDoctor.profileSettings');
    }

    public function changePassword()
    {
        return view('themeDoctor.changePassword');
    }
}
