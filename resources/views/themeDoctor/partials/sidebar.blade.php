<!-- Profile Sidebar -->
<div class="profile-sidebar">
    <div class="widget-profile pro-widget-content">
        <div class="profile-info-widget">
            <a href="#" class="booking-doc-img">
                <img src="{{ asset('doctorDashboard/assets/') }}/img/doctors/doctor-thumb-02.jpg" alt="User Image">
            </a>
            <div class="profile-det-info">
                <h3>Dr. Darren Elder</h3>

                <div class="patient-details">
                    <h5 class="mb-0">BDS, MDS - Oral & Maxillofacial Surgery</h5>
                </div>
            </div>
        </div>
    </div>
    <div class="dashboard-widget">
        <nav class="dashboard-menu">
            <ul>
                <li>
                    <a href="{{ route('doctor.dashboard') }}" class="@yield('dashboard-active')">
                        <i class="fas fa-columns"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('doctor.liveSessions') }}" class="@yield('live-active')">
                        <i class="fas fa-calendar-check"></i>
                        <span>Live Sessions</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('doctor.schedualeTimings') }}" class="@yield('schedule-active')">
                        <i class="fas fa-hourglass-start"></i>
                        <span>Schedule Timings</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('doctor.reviews') }}" class="@yield('reviews-active')">
                        <i class="fas fa-star"></i>
                        <span>Reviews</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('doctor.profileSettings') }}" class="@yield('profile-active')">
                        <i class="fas fa-user-cog"></i>
                        <span>Profile Settings</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('doctor.changePassword') }}" class="@yield('change-pass-active')">
                        <i class="fas fa-lock"></i>
                        <span>Change Password</span>
                    </a>
                </li>
                <li>
                    <form id="outSidebar" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <a href="#" onclick="event.preventDefault(); document.getElementById('outSidebar').submit();">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</div>
<!-- /Profile Sidebar -->
