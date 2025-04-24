@extends('theme.master')

@section('title', 'Live Sessions')
@section('live-sessions-active', 'active')

@section('content')
    <div class="container mt-5">
        <h2 class="mb-4">Live Session with Your Doctor</h2>

        @if ($upcomingAppointment)
            @php
                $appointmentDateTime = \Carbon\Carbon::parse($upcomingAppointment->appointment_datetime);
            @endphp

            <div class="card shadow">
                <div class="card-body">
                    <h5 class="card-title">Upcoming Appointment</h5>
                    <p><strong>Auth Id:</strong> {{ auth()->user()->id ?? 'N/A' }}</p>
                    <p><strong>P Id:</strong> {{ $upcomingAppointment->id ?? 'N/A' }}</p>
                    <p><strong>P Name:</strong> {{ $upcomingAppointment->patient->full_name ?? 'N/A' }}</p>
                    <p><strong>Date:</strong> {{ $appointmentDateTime->format('l, F j, Y') }}</p>
                    <p><strong>Time:</strong> {{ $appointmentDateTime->format('h:i A') }}</p>
                    <p><strong>Doctor:</strong> {{ $upcomingAppointment->doctor->full_name ?? 'N/A' }}</p>

                    <p>Now: {{ now() }}</p>
                    <p>Start window: {{ \Carbon\Carbon::parse($upcomingAppointment->appointment_datetime)->subMinutes(10) }}
                    </p>
                    <p>End window: {{ \Carbon\Carbon::parse($upcomingAppointment->appointment_datetime)->addMinutes(60) }}
                    </p>

                    @if (
                        $upcomingAppointment &&
                            now()->between(
                                \Carbon\Carbon::parse($upcomingAppointment->appointment_datetime)->subMinutes(10),
                                \Carbon\Carbon::parse($upcomingAppointment->appointment_datetime)->addMinutes(60)))
                        <a href="{{ $upcomingAppointment->zoom_meeting_url }}" target="_blank" class="btn btn-success">
                            Join Live Session
                        </a>
                    @else
                        <div class="alert alert-info mt-3">
                            The session will be available 10 minutes before the appointment time.
                        </div>
                    @endif
                </div>
            </div>
        @else
            <div class="alert alert-warning">
                No upcoming appointments available for live session.
            </div>
        @endif
    </div>
@endsection
