<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
    public function show ($id) {
        $doctor = User::with(['doctorReviews.patient'])->findOrFail($id);

        if ($doctor->role !== 'doctor') {
            abort(404);
        }

        return view('theme.doctorDetails', compact('doctor'));
    }
}
