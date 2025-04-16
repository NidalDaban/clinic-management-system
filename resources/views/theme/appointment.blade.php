@extends('theme.master')
@section('title', 'Doctors')
@section('doctors-active', 'active')

@section('content')
@section('subtitle', 'Place your appointment with your favorite doctor')

<!-- Appointment Section -->
<section id="appointment" class="appointment section py-5 bg-light">
    <div class="container section-title text-center mb-5" data-aos="fade-up">
        <h2>Appointment</h2>
        <p>To book an appointment, fill out the form below. This helps our team prepare and give you the best care
            possible.</p>
    </div>

    <div class="container" data-aos="fade-up" data-aos-delay="100">
        @if (isset($doctor))
            <div class="alert alert-info text-center mb-4">
                Booking with <strong>{{ ucfirst($doctor->first_name) }} {{ ucfirst($doctor->last_name) }}</strong>
            </div>
        @endif

        <form id="appointmentForm" action="{{ route('appointment.store') }}" method="POST"
            class="p-4 bg-white rounded shadow-sm">
            @csrf
            <input type="hidden" name="recipient_id" value="{{ $recipient->id }}">

            <div class="row g-4">
                <!-- Date & Time -->
                <div class="col-md-6">
                    <label for="date" class="form-label">Appointment Date & Time</label>
                    <input type="datetime-local" name="appointment_datetime"
                        class="form-control @error('date') is-invalid @enderror" id="date" required
                        min="{{ \Carbon\Carbon::create(2025, 4, 20, 9, 0)->format('Y-m-d\TH:i') }}">
                    @error('appointment_datetime')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Attendance Type -->
                <div class="col-md-6">
                    <label for="attends" class="form-label">Attendance Type</label>
                    <select name="attends" id="attends" class="form-select @error('attends') is-invalid @enderror"
                        required>
                        <option value="" disabled selected>Select Attendance Type</option>
                        <option value="online">Online</option>
                        <option value="clinic">In Clinic</option>
                    </select>
                    @error('attends')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Optional Message -->
                <div class="col-12">
                    <label for="message" class="form-label">Message (Optional)</label>
                    <textarea class="form-control" name="addintional_note" id="message" rows="4"
                        placeholder="Describe your concerns, preferences, etc."></textarea>
                </div>
            </div>

            <div class="row mt-4">
                <h5>Payment Details</h5>

                <div class="col-md-6">
                    <label for="total_amount" class="form-label">Total Amount</label>
                    <input type="number" name="total_amount" class="form-control" step="0.01" required>
                </div>

                <div class="col-md-6">
                    <label for="method" class="form-label">Payment Method</label>
                    <select name="method" class="form-select" required>
                        <option disabled selected>Select Payment Method</option>
                        <option value="e-wallet">E-Wallet</option>
                        <option value="cash">Cash</option>
                        <option value="visa">Visa</option>
                        <option value="master-card">MasterCard</option>
                    </select>
                </div>

                <div class="col-12 mt-3">
                    <label for="payment_note" class="form-label">Payment Note (Optional)</label>
                    <textarea name="payment_note" class="form-control" rows="3"></textarea>
                </div>
            </div>

            <div class="text-center mt-4">
                @auth
                    <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">
                        Make an Appointment
                    </button>
                @endauth

                @guest
                    <a href="{{ route('register') }}" class="btn btn-primary px-4 py-2 rounded-pill"
                        onclick="showRegisterAlert(event)">
                        Make an Appointment
                    </a>

                    <script>
                        function showRegisterAlert(event) {
                            event.preventDefault();
                            Swal.fire({
                                title: 'Register Required',
                                text: 'You need to register before making an appointment.',
                                icon: 'info',
                                showCancelButton: true,
                                confirmButtonText: 'Register Now',
                                cancelButtonText: 'Cancel',
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33'
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    window.location.href = event.target.href;
                                }
                            });
                        }
                    </script>
                @endguest

                 <div id="formMessage" class="mt-3"></div>
            </div>
        </form>
    </div>
</section>
{{-- 
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session('success') }}',
                icon: 'success',
                confirmButtonColor: '#3085d6'
            });
        @endif

        @if (session('error'))
            Swal.fire({
                title: 'Error!',
                text: '{{ session('error') }}',
                icon: 'error',
                confirmButtonColor: '#d33'
            });
        @endif
    </script>
@endpush --}}
@endsection
