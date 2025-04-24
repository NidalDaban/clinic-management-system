<?php

namespace App\Http\Controllers;

use App\Enums\DayOfWeek;
use App\Http\Controllers\Controller;
use App\Models\DailySchedule;
use App\Models\DailyScheduleSlot;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DoctorScheduleController extends Controller
{
    public function index()
    {
        $schedules = DailySchedule::forUser(auth()->user())
            ->with('slots')
            ->get()
            ->keyBy(function ($item) {
                return $item->day_of_week->value; // Explicitly get the value
            });

        return view('doctor.schedule', [
            'days' => DayOfWeek::cases(),
            'schedules' => $schedules
        ]);
    }

    public function storeSlot(Request $request)
    {
        $request->validate([
            'day_of_week' => ['required', Rule::in(DayOfWeek::values())],
            'slots' => 'required|json',
        ]);

        $slots = json_decode($request->slots, true);

        foreach ($slots as $slot) {
            $validator = Validator::make($slot, [
                'start_time' => 'required|date_format:H:i|before:end_time',
                'end_time' => 'required|date_format:H:i|after:start_time',
            ]);

            if ($validator->fails()) {
                return response()->json([
                    'message' => 'Invalid time slot format',
                    'errors' => $validator->errors()
                ], 422);
            }
        }

        $schedule = DailySchedule::firstOrCreate([
            auth()->user()->role === 'doctor' ? 'doctor_id' : 'psychologist_id' => auth()->id(),
            'day_of_week' => DayOfWeek::from($request->day_of_week),
        ]);

        $schedule->slots()->delete();

        foreach ($slots as $slot) {
            $schedule->slots()->create([
                'start_time' => $slot['start_time'],
                'end_time' => $slot['end_time'],
            ]);
        }

        return response()->json(['success' => true]);
    }

    public function deleteSlot(DailyScheduleSlot $slot)
    {
        if (
            $slot->schedule->doctor_id !== auth()->id() &&
            $slot->schedule->psychologist_id !== auth()->id()
        ) {
            abort(403);
        }

        $slot->delete();
        return redirect()->back()->with('success', 'Time slot deleted successfully');
    }
}
