<!-- jQuery -->
<script src="{{ asset('doctorDashboard/assets/js/jquery.min.js') }}"></script>

{{-- Sweet alert --}}
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- Bootstrap Core JS -->
<script src="{{ asset('doctorDashboard/assets/js/popper.min.js') }}"></script>
<script src="{{ asset('doctorDashboard/assets/js/bootstrap.min.js') }}"></script>

<!-- Sticky Sidebar JS -->
<script src="{{ asset('doctorDashboard/assets/plugins/theia-sticky-sidebar/ResizeSensor.js') }}"></script>
<script src="{{ asset('doctorDashboard/assets/plugins/theia-sticky-sidebar/theia-sticky-sidebar.js') }}"></script>

<!-- Circle Progress JS -->
<script src="{{ asset('doctorDashboard/assets/js/circle-progress.min.js') }}"></script>

<!-- Select2 JS -->
<script src="{{ asset('doctorDashboard/assets/plugins/select2/js/select2.min.js') }}"></script>

<script src="{{ asset('doctorDashboard/assets/plugins/dropzone/dropzone.min.js') }}"></script>

<!-- Profile Settings JS -->
<script src="{{ asset('doctorDashboard/assets/js/profile-settings.js') }}"></script>

<!-- Custom JS -->
<script src="{{ asset('doctorDashboard/assets/js/script.js') }}"></script>

<script>
    function fetchAppointments(url, type) {
        $.ajax({
            url: url,
            data: {
                type: type
            },
            success: function(data) {
                if (type === 'today') {
                    $('#today-appointments tbody').html(data);
                } else {
                    $('#upcoming-appointments tbody').html(data);
                }

                // Reload pagination links
                loadPagination(type);
            }
        });
    }

    function loadPagination(type) {
        $.ajax({
            url: `{{ route('doctor.dashboard') }}`,
            data: {
                type: type
            },
            success: function(data) {
                if (type === 'today') {
                    $('#today-pagination').html($(data).find('#today-pagination').html());
                } else {
                    $('#upcoming-pagination').html($(data).find('#upcoming-pagination').html());
                }
            }
        });
    }
</script>

<script>
    // Main function to load appointments via AJAX
    function loadAppointments(type, page = 1) {

        $.ajax({
            url: "{{ route('doctor.appointments.fetch') }}",
            type: 'GET',
            data: {
                type: type,
                page: page
            },
            success: function(data) {
                console.log('AJAX success:', data);

                if (type === 'today') {
                    $('#today-appointments-table-body').html(data.rows);
                    $('#today-pagination').html(data.pagination);
                    console.log('Updated today appointments');
                } else {
                    $('#upcoming-appointments-table-body').html(data.rows);
                    $('#upcoming-pagination').html(data.pagination);
                    console.log('Updated upcoming appointments');
                }
            },
            error: function(xhr, status, error) {
                console.error('AJAX Error:', {
                    status: status,
                    error: error,
                    response: xhr.responseText
                });
            }
        });
    }

    // Handle pagination clicks with proper parameter extraction
    $(document).on('click', '.pagination a', function(e) {
        console.log('Pagination link clicked');
        console.log('Href:', $(this).attr('href'));

        e.preventDefault();

        try {
            const url = $(this).attr('href');
            const urlObj = new URL(url);

            // Determine which tab we're on
            const isTodayTab = $(this).closest('#today-pagination').length > 0;
            const type = isTodayTab ? 'today' : 'upcoming';

            // Get the correct page parameter based on tab type
            const pageParam = isTodayTab ? 'todayPage' : 'upcomingPage';
            const page = urlObj.searchParams.get(pageParam) || 1;

            console.log('Detected type:', type);
            console.log('Page parameter:', pageParam);
            console.log('Extracted page:', page);

            loadAppointments(type, page);
        } catch (error) {
            console.error('Error in click handler:', error);
        }
    });

    // Initial debug info
    $(document).ready(function() {
        console.log('Document ready - Pagination system initialized');
    });
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
