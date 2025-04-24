@extends('themeDoctor.masterDrDashboard')
@section('dashboard-active', 'active')

@section('content')
    <div class="col-md-7 col-lg-8 col-xl-9">

        @include('themeDoctor.partials.charts')

        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-4">Patient Appoinments</h4>

                <div class="tab-content">

                    <!-- Appointment Tab -->
                    <ul class="nav nav-tabs nav-tabs-solid nav-tabs-rounded">
                        <li class="nav-item">
                            <a class="nav-link active" href="#today-appointments" data-toggle="tab">Today</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#upcoming-appointments" data-toggle="tab">Upcoming</a>
                        </li>
                    </ul>

                    <!-- /Appointment Tab -->

                    <div class="tab-content">
                        <div class="tab-pane show active" id="today-appointments">
                            <div class="card card-table mb-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0 w-auto">
                                            <thead>
                                                <tr>
                                                    <th>Patient</th>
                                                    <th>Gender</th>
                                                    <th>Phone</th>
                                                    <th class="text-center">Date/Time</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="today-appointments-table-body">
                                                @include('themeDoctor.partials.appointment-table-rows', [
                                                    'appointments' => $appointmentsToday,
                                                ])
                                            </tbody>
                                        </table>
                                        {{-- Today Pagination --}}
                                        <div id="today-pagination">
                                            <nav>
                                                {{ $appointmentsToday->links('pagination::bootstrap-5') }}
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- ============================================= --}}

                        <div class="tab-pane" id="upcoming-appointments">
                            <div class="card card-table mb-0">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table table-hover table-center mb-0">
                                            <thead>
                                                <tr>
                                                    <th>Patient</th>
                                                    <th>Gender</th>
                                                    <th>Phone</th>
                                                    <th class="text-center">Date / Time</th>
                                                    <th></th>
                                                </tr>
                                            </thead>
                                            <tbody id="upcoming-appointments-table-body">
                                                @include('themeDoctor.partials.appointment-table-rows', [
                                                    'appointments' => $appointmentsUpcoming,
                                                ])
                                            </tbody>
                                        </table>
                                    </div>
                                    {{-- Upcoming Pagination --}}
                                    <div id="upcoming-pagination">
                                        <nav>
                                            {{ $appointmentsUpcoming->links('pagination::bootstrap-5') }}
                                        </nav>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
