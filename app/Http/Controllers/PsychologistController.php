<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PsychologistController extends Controller
{
    public function show ($id) {
        $psychologist = User::with(['psychologistReviews.patient'])->findOrFail($id);
        
        if ($psychologist->role !== 'psychologist') {
            abort(404);
        }

        return view('theme.psychologistDetails', compact('psychologist'));
    }
}
