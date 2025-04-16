<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function index()
    {
        return view('theme.index');
    }

    // public function doctors () {
    //     return view('theme.doctors');
    // }

    public function doctors() {
        $doctors = User::where('role', 'doctor')->with('doctorReviews')->get();
        return view('theme.doctors', compact('doctors'));
    }

    public function psychologists() {
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

    public function appointment()
    {
        return view('theme.partials.makeAppointment');
    }

}
