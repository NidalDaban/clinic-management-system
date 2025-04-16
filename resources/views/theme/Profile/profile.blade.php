<!DOCTYPE html>
<html lang="en">

@include('theme.Profile.profilePartials.head')

<body>
    <div class="container light-style flex-grow-1 container-p-y">
        
        @include('theme.Profile.profilePartials.profileTitle')

        <div class="card overflow-hidden">
            <div class="row no-gutters row-bordered row-border-light">
                <div class="col-md-3 pt-0">
                    <div class="list-group list-group-flush account-settings-links">
                        <a class="list-group-item list-group-item-action active" data-toggle="list"
                            href="#account-general">General Info</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#account-medical-history">Medical History</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#account-appointments">Appointments</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#account-emergency-contact">Emergency Contacts</a>
                        <a class="list-group-item list-group-item-action" data-toggle="list"
                            href="#account-settings">Settings</a>
                    </div>
                </div>
                <div class="col-md-9">
                    <div class="tab-content">
                        <!-- General Info Tab -->
                        <div class="tab-pane fade active show" id="account-general">
                            <div class="card-body media align-items-center">
                                <img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt
                                    class="d-block ui-w-80 profile-img">

                                <div class="media-body ml-4">
                                    <label class="btn btn-outline-primary">
                                        Upload new photo
                                        <input type="file" class="account-settings-fileinput" hidden>
                                    </label> &nbsp;
                                    <button type="button" class="btn btn-default md-btn-flat">Reset</button>
                                    <div class="text-light small mt-1">Allowed JPG, GIF or PNG. Max size of 800K</div>
                                </div>


                            </div>
                            <hr class="border-light m-0">
                            <div class="card-body">
                                <div class="form-group">
                                    <label class="form-label">Full Name</label>
                                    <input type="text" class="form-control mb-1" value="John Doe">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Patient ID</label>
                                    <input type="text" class="form-control" value="123456789">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Date of Birth</label>
                                    <input type="text" class="form-control mb-1" value="1985-12-15">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Gender</label>
                                    <select class="custom-select">
                                        <option selected>Male</option>
                                        <option>Female</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Email</label>
                                    <input type="email" class="form-control" value="johndoe@mail.com">
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control" value="+962 7xx xxx xxx">
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
            <button type="button" class="btn btn-primary">Save Changes</button>&nbsp;
            <button type="button" class="btn btn-default">Cancel</button>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
