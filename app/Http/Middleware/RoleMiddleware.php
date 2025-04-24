<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('/login');
        }

        $user = Auth::user();

        if (in_array('patient', $roles)) {
            $patientRoles = [User::ROLE_USER, User::ROLE_PATIENT_DOCTOR, User::ROLE_PATIENT_PSYCHOLOGIST];
            if (in_array($user->role, $patientRoles)) {
                return $next($request);
            }
        }

        if (in_array('doctor', $roles) && $user->role === User::ROLE_DOCTOR) {
            return $next($request);
        }

        if (!in_array($user->role, $roles)) {            
            if (in_array($user->role, [User::ROLE_USER, User::ROLE_PATIENT_DOCTOR, User::ROLE_PATIENT_PSYCHOLOGIST])) {
                return redirect('/');
            }            
            abort(403, 'Unauthorized action.');
        }

        return $next($request);
    }
}
