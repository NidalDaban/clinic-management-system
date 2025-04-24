@foreach ($appointments as $appointment)
    <tr>
        <td>
            <h2 class="table-avatar">
                <a href="#" class="avatar avatar-sm mr-2">
                    <img class="avatar-img rounded-circle" src="{{ $appointment->patient->image_url }}" alt="User Image">
                </a>
                <a href="#">
                    {{ $appointment->patient->full_name ?? 'No Name' }}
                </a>
            </h2>
        </td>
        <td class="text-center">{{ $appointment->patient->gender ?? 'N/A' }}</td>
        <td>{{ $appointment->patient->phone ?? 'N/A' }}</td>
        <td class="text-center">{{ $appointment->appointment_datetime ?? 'N/A' }}</td>
        <td class="text-right">
            <div class="appointment-action">
                <a href="#" class="btn btn-sm bg-info-light" data-toggle="modal" data-target="#appt_details">
                    <i class="far fa-eye"></i> View
                </a>
                <a href="javascript:void(0);" class="btn btn-sm bg-success-light">
                    <i class="fas fa-check"></i> Accept
                </a>
                <a href="javascript:void(0);" class="btn btn-sm bg-danger-light">
                    <i class="fas fa-times"></i> Cancel
                </a>
            </div>
        </td>
    </tr>
@endforeach
