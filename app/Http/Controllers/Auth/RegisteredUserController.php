<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('theme.partials.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'second_name' => ['required', 'string', 'max:255'],
            'middle_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'in:male,female,other'],
            'dob' => ['required', 'date'],
            'marital_status' => ['required', 'in:single,married'],
            'job_title' => ['required', 'string', 'max:255'],
            'phone' => ['required', 'string', 'max:15'],
            'country_id' => ['required', 'exists:countries,id'],

            // Chronic disease fields
            'chronic_disease' => ['nullable', 'in:yes'],
            'chronic_disease_detail' => [
                'nullable',
                'required_if:chronic_disease,yes',
                'string',
                'max:255',
            ],

            // Auth-related
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'first_name' => $request->first_name,
            'second_name' => $request->second_name,
            'middle_name' => $request->middle_name,
            'last_name' => $request->last_name,
            'gender' => $request->gender,
            'date_of_birth' => $request->dob,
            'is_marid' => $request->marital_status == 'single' ? 0 : 1,
            'job_title' => $request->job_title,
            'phone' => $request->phone,
            'country_id' => $request->country_id,
            'chronic_disease' => $request->chronic_disease == 'yes' ? 'yes' : null,
            'chronic_disease' => $request->chronic_disease == 'yes' ? $request->chronic_disease_detail : null,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return to_route('theme.index');
    }

    public function appointmentForm(Request $request)
    {
        $request->validate([
            'first_name',
            'second_name',
            'middle_name',
            'last_name',
            'gender',
            'date_of_birth',
            'is_marid',
            'job_title',
            // 'image_path',
            'phone',
            'address',
            'country_id',
            'email',
            'password',
            // 'chronic_disease'
        ]);

        // $user = User::findorFail('');
        // try {
        //     $user = User::findOrFail($request->id);

        //     return view('users.show', ['user' => null]);
        //     // User exists, continue logic
        // } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
        //     return view('users.show', ['user' => null]);
        // }
    }
}
