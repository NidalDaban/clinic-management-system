@extends('theme.master')
@section('title', 'Place the appointment')

@section('content')
    <div class="container section-title" data-aos="fade-up">
        <h2>Appointment</h2>
        <p>To book an appointment, patients are required to fill out the form below with their personal and medical
            information. This helps our specialists prepare and provide the best care possible.</p>
    </div><!-- End Section Title -->

    <div class="container" data-aos="fade-up" data-aos-delay="100">

        <form action="{{ route('appointments.store') }}" method="post" role="form" class="">
            {{-- class="php-email-form" --}}
            @csrf
            <div class="row">
                {{-- <div class="col-md-4 form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="Your Name"
                    required="">
            </div>
            <div class="col-md-4 form-group mt-3 mt-md-0">
                <input type="email" class="form-control" name="email" id="email" placeholder="Your Email"
                    required="">
            </div>
            <div class="col-md-4 form-group mt-3 mt-md-0">
                <input type="tel" class="form-control" name="phone" id="phone" placeholder="Your Phone"
                    required="">
            </div> --}}
            </div>
            <div class="row">
                <div class="col-md-4 form-group mt-3">
                    <input type="datetime-local" name="date" class="form-control datepicker" id="date"
                        placeholder="Appointment Date" required="">
                </div>

                <div class="col-md-4 form-group mt-3">
                    <select name="id" id="doctor" class="form-select" required="">
                        <option value="" disabled {{ old('id') ? '' : 'selected' }}>Select Doctor</option>
                        @foreach ($doctors as $doctor)
                            <option value="{{ $doctor->id }}" {{ old('id') == $doctor->id ? 'selected' : '' }}>
                                {{ $doctor->first_name . ' ' . $doctor->second_name . ' ' . $doctor->last_name }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4 form-group mt-3">
                    <select name="attends" id="attends" class="form-select" required>
                        <option value="" disabled selected>Select Attendance Type</option>
                        <option value="online">Online</option>
                        <option value="clinic">In Clinic</option>
                    </select>
                </div>
            </div>

            <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="Message (Optional)"></textarea>
            </div>
            <div class="mt-3">
                <div class="text-center">
                    @auth
                        <button type="submit" class="btn btn-primary px-4 py-2 rounded-pill">
                            Make an Appointment
                        </button>
                        @if (session('success'))
                            <div class="alert alert-success mt-3">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger mt-3">
                                {{ session('error') }}
                            </div>
                        @endif
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
                </div>

            </div>
        </form>
    </div>
@endsection
