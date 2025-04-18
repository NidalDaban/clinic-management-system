@if ($appointments->count())
    <table class="table table-bordered table-striped">
        <thead class="thead-dark">
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Day</th>
                <th>Doctor</th>
                <th>Psychologist</th>
                <th>Service</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_datetime)->format('Y-m-d') }}</td>
                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_datetime)->format('H:i') }}</td>
                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_datetime)->format('l') }}</td>
                    <td>{{ optional($appointment->doctor)->full_name ?? '-' }}</td>
                    <td>{{ optional($appointment->psychologist)->full_name ?? '-' }}</td>
                    <td>{{ optional($appointment->service)->name ?? '-' }}</td>
                    <td>{{ ucfirst($appointment->status) }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-center mt-3">
        {{ $appointments->onEachSide(1)->links('vendor.pagination.bootstrap-4') }}
    </div>
@else
    <p class="text-center text-muted">No appointments found.</p>
@endif
