<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ReviewController extends Controller
{
    // public function store(Request $request)
    // {
    //     try {

    //         $request->validate([
    //             'doctor_id' => 'required|exists:users,id',
    //             'ratings' => 'required|integer|min:1|max:5',
    //             'comment' => 'required|string|max:1000'
    //         ]);

    //         $doctor = \App\Models\User::where('id', $request->doctor_id)
    //             ->where('role', 'doctor')
    //             ->first();

    //         if (!$doctor) {
    //             return back()->with('error', 'The selected doctor is not a valid doctor.');
    //         }

    //         Review::create([
    //             'doctor_id' => $request->doctor_id,
    //             'patient_id' => auth()->id(),
    //             'ratings' => $request->ratings,
    //             'comment' => $request->comment,
    //         ]);

    //         return back()->with('success', 'Review submitted!');
    //     } catch (ValidationException $e) {
    //         return back()->withErrors($e->validator)->withInput();
    //     } catch (ModelNotFoundException $e) {
    //         return back()->with('error', 'Doctor not found.');
    //     } catch (\Exception $e) {
    //         return back()->with('error', 'An unexpected error occurred. Please try again.');
    //     }
    // }

    // ======

    public function store(Request $request)
    {
        try {
            $request->validate([
                'recipient_id' => 'required|exists:users,id',
                'ratings' => 'required|integer|min:1|max:5',
                'comment' => 'required|string|max:1000'
            ]);

            $recipient = \App\Models\User::find($request->recipient_id);

            
            // Check if recipient is either a doctor or psychologist
            if (!$recipient || !in_array($recipient->role, ['doctor', 'psychologist'])) {
                return back()->with('error', 'The selected user is not a valid doctor or psychologist.');
            }

            // Prepare the review data
            $reviewData = [
                'patient_id' => auth()->id(),
                'ratings' => $request->ratings,
                'comment' => $request->comment,
            ];

            // Dynamically assign the correct recipient column
            if ($recipient->role === 'doctor') {
                $reviewData['doctor_id'] = $recipient->id;
            } elseif ($recipient->role === 'psychologist') {
                $reviewData['psychologist_id'] = $recipient->id;
            }

            Review::create($reviewData);

            return back()->with('success', 'Review submitted!');
        } catch (ValidationException $e) {
            dd('From validation Exception : ' . $e);
            return back()->withErrors($e->validator)->withInput();
        } catch (ModelNotFoundException $e) {
            dd('From validation Exception user not found' . $e);
            return back()->with('error', 'User not found.');
        } catch (\Exception $e) {
            dd('From validation unexpected error occurred' . $e);
            return back()->with('error', 'An unexpected error occurred. Please try again.');
        }
    }
}
