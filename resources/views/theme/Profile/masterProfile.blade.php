<!DOCTYPE html>
<html lang="en">

@include('theme.Profile.profilePartials.head')

<body>
    <div class="container light-style flex-grow-1 container-p-y">
        <h4 class="font-weight-bold py-3 mb-4">
            Patient Profile - RafiqCare
        </h4>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('user-profile.update') }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="card overflow-hidden">
                <div class="row no-gutters row-bordered row-border-light">

                    @include('theme.Profile.profilePartials.sidebar')

                    <div class="col-md-9">
                        @include('theme.Profile.profilePartials.header')

                        <div class="tab-content">
                            <!-- General Info Tab -->
                            <div class="tab-pane fade active show" id="account-general">
                                <hr class="border-light m-0">
                                <div class="card-body">

                                    <div class="form-group">
                                        <label class="form-label">Full Name: </label>
                                        <span style="color: blue">
                                            {{ Auth::user()->first_name . ' ' . Auth::user()->second_name . ' ' . Auth::user()->middle_name . ' ' . Auth::user()->last_name }}
                                        </span>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Job Title</label>
                                        <input type="text" class="form-control" name="job_title"
                                            value="{{ Auth::user()->job_title }}">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Date of Birth</label>
                                        <input type="text" class="form-control mb-1" name="date_of_birth"
                                            value="{{ Auth::user()->date_of_birth }}">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Email</label>
                                        <input type="email" class="form-control" name="email"
                                            value="{{ Auth::user()->email }}">
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Phone</label>
                                        <input type="text" class="form-control" name="phone"
                                            value="{{ Auth::user()->phone }}">
                                    </div>

                                </div>
                            </div>

                            <!-- Medical History Tab -->
                            <div class="tab-pane fade" id="account-medical-history">
                                <div class="card-body pb-2">
                                    <div class="form-group">
                                        <label class="form-label">Allergies</label>
                                        <input type="text" class="form-control" value="Penicillin">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Chronic Conditions</label>
                                        <input type="text" class="form-control" value="None">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Past Surgeries</label>
                                        <input type="text" class="form-control" value="Appendectomy, 2015">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Medications</label>
                                        <input type="text" class="form-control" value="None">
                                    </div>
                                </div>
                            </div>

                            <!-- Appointments Tab -->
                            <div class="tab-pane fade" id="account-appointments">
                                <div class="card-body">
                                    <h5>Upcoming Appointments:</h5>
                                    <ul>
                                        <li>Psychiatrist - Dr. Sarah (2025-04-15 at 2:00 PM)</li>
                                        <li>Therapist - Dr. John (2025-04-20 at 10:00 AM)</li>
                                    </ul>
                                    <button type="button" class="btn btn-primary">Book New Appointment</button>
                                </div>
                            </div>

                            <!-- Emergency Contact Tab -->
                            <div class="tab-pane fade" id="account-emergency-contact">
                                <div class="card-body">
                                    <div class="form-group">
                                        <label class="form-label">Emergency Contact Name</label>
                                        <input type="text" class="form-control" value="Jane Doe">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Relationship</label>
                                        <input type="text" class="form-control" value="Sister">
                                    </div>
                                    <div class="form-group">
                                        <label class="form-label">Phone</label>
                                        <input type="text" class="form-control" value="+962 7xx xxx xxx">
                                    </div>
                                </div>
                            </div>

                            <!-- Settings Tab -->
                            <div class="tab-pane fade" id="account-settings">
                                <div class="card-body pb-2">
                                    <h6>Change Email:</h6>
                                    <input type="email" class="form-control mb-2" value="johndoe@mail.com">
                                    <button type="button" class="btn btn-primary">Save Email</button>
                                    <h6 class="mt-4">Change Password:</h6>
                                    <input type="password" class="form-control mb-2" placeholder="New Password">
                                    <button type="button" class="btn btn-primary">Save Password</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-right mt-3">
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <button type="reset" class="btn btn-default">Cancel</button>
            </div>
        </form>
    </div>

    @include('theme.Profile.profilePartials.scripts')

    <!-- SweetAlert2 CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- SweetAlert Logic -->
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'OK'
            });
        @endif

        @if ($errors->any())
            let errorMessages = `{!! implode('<br>', $errors->all()) !!}`;
            Swal.fire({
                icon: 'error',
                title: 'Update Failed!',
                html: errorMessages,
                confirmButtonColor: '#d33',
                confirmButtonText: 'OK'
            });
        @endif
    </script>

</body>

</html>
