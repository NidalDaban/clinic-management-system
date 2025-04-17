<?php

namespace App\Http\Requests;

use App\Models\Appointment;
use App\Models\User;
use Illuminate\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class StoreAppointmentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'recipient_id' => 'required|exists:users,id',
            'appointment_datetime' => 'required|date|after:now',
            'attends' => 'required|in:online,clinic',
            'addintional_note' => 'nullable|string|max:1000',
            'method' => 'nullable|in:e-wallet,cash,visa,master-card',
            'total_amount' => 'nullable|numeric|min:0',
            'payment_note' => 'nullable|string|max:1000',
            'service_id' => 'required|exists:services,id',
        ];
    }

    public function withValidator(Validator $validator)
    {
        $validator->after(function ($validator) {
            $recipient = User::find($this->recipient_id);
            $datetime = \Carbon\Carbon::parse($this->appointment_datetime)->format('Y-m-d H:i'); // normalize to minute

            if (!$recipient || !in_array($recipient->role, ['doctor', 'psychologist'])) {
                $validator->errors()->add('recipient_id', 'You can only book appointments with doctors or psychologists.');
                return;
            }

            $query = Appointment::whereRaw("DATE_FORMAT(appointment_datetime, '%Y-%m-%d %H:%i') = ?", [$datetime])
                ->whereNotIn('status', ['cancelled', 'completed']);

            if ($recipient->role === 'doctor') {
                $query->where('doctor_id', $recipient->id);
            } elseif ($recipient->role === 'psychologist') {
                $query->where('psychologist_id', $recipient->id);
            }

            if ($query->exists()) {
                $validator->errors()->add('appointment_datetime', 'This time slot is already booked for this recipient.');
            }
        });
    }
}
