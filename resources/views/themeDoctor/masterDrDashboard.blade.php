<!DOCTYPE html>
<html lang="en">

<!-- doccure/doctor-dashboard.html  30 Nov 2019 04:12:03 GMT -->

@include('themeDoctor.partials.head')

<body>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        @include('themeDoctor.partials.header')

        <!-- Page Content -->
        <div class="content">
            <div class="container-fluid">

                <div class="row">
                    <div class="col-md-5 col-lg-4 col-xl-3 theiaStickySidebar">

                        @include('themeDoctor.partials.sidebar')

                    </div>

                    @yield('content')

                </div>

            </div>

        </div>
        <!-- /Page Content -->

        @include('themeDoctor.partials.footer')

    </div>
    <!-- /Main Wrapper -->

    @include('themeDoctor.partials.add-editTimeSlot')


    @include('themeDoctor.partials.scripts')

</body>

<!-- doccure/doctor-dashboard.html  30 Nov 2019 04:12:09 GMT -->

</html>
