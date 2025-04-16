<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\countries;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index()
    {
        $countries = countries::all();
        
        return view('theme.partials.register', compact('countries'));
    }
}
