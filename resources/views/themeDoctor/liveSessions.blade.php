@extends('themeDoctor.masterDrDashboard')

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">Live Session with Your Patient</h5>
                </div>
                <div class="card-body">
                    @if ($upcomingAppointment)
                        @php
                            $appointmentDateTime = \Carbon\Carbon::parse($upcomingAppointment->appointment_datetime);
                        @endphp

                        <ul class="list-group list-group-flush mb-3">
                            <li class="list-group-item"><strong>Doctor ID:</strong> {{ auth()->user()->id }}</li>
                            <li class="list-group-item"><strong>Appointment ID:</strong> {{ $upcomingAppointment->id }}</li>
                            <li class="list-group-item"><strong>Patient Name:</strong>
                                {{ $upcomingAppointment->patient->full_name ?? 'N/A' }}</li>
                            <li class="list-group-item"><strong>Date:</strong>
                                {{ $appointmentDateTime->format('l, F j, Y') }}</li>
                            <li class="list-group-item"><strong>Time:</strong> {{ $appointmentDateTime->format('h:i A') }}
                            </li>
                        </ul>

                        @php
                            $startWindow = $appointmentDateTime->copy()->subMinutes(10);
                            $endWindow = $appointmentDateTime->copy()->addMinutes(60);
                        @endphp

                        @if (now()->between($startWindow, $endWindow))
                            <a href="{{ $upcomingAppointment->zoom_meeting_url }}" target="_blank" class="btn btn-success">
                                <i class="fas fa-video"></i> Join Live Session
                            </a>
                        @else
                            <div class="alert alert-info">
                                The session will be available 10 minutes before the appointment time.
                            </div>
                        @endif
                    @else
                        <div class="alert alert-warning mb-0">
                            No upcoming appointments available for live session.
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
