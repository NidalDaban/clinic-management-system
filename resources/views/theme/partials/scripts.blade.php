<!-- Main JS File -->
<script src="{{ asset('assets') }}/js/main.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    // Show chronic disease detail input if checkbox is checked
    document.getElementById('chronic_disease').addEventListener('change', function() {
        var chronicDetailDiv = document.getElementById('chronic_disease_detail');
        var chronicDetailInput = document.getElementById('chronic_disease_detail_input');

        if (this.checked) {
            chronicDetailDiv.style.display = 'block';
            chronicDetailInput.setAttribute('required', 'required'); // Make the input required
        } else {
            chronicDetailDiv.style.display = 'none';
            chronicDetailInput.removeAttribute('required'); // Remove the required attribute
        }
    });
</script>


<!-- JS to toggle chronic disease details -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const checkbox = document.getElementById('chronic_disease');
        const detailDiv = document.getElementById('chronic_disease_detail');
        const detailInput = document.getElementById('chronic_disease_detail_input');

        checkbox.addEventListener('change', function() {
            if (checkbox.checked) {
                detailDiv.style.display = 'block';
                detailInput.required = true;
            } else {
                detailDiv.style.display = 'none';
                detailInput.required = false;
                detailInput.value = '';
            }
        });
    });
</script>

<!-- SweetAlert for session messages -->
<script>
    document.addEventListener("DOMContentLoaded", function () {
        @if(session('success'))
            Swal.fire({
                title: 'Success!',
                text: '{{ session("success") }}',
                icon: 'success',
                confirmButtonColor: '#3085d6'
            });
        @endif

        @if(session('error'))
            Swal.fire({
                title: 'Error!',
                text: '{{ session("error") }}',
                icon: 'error',
                confirmButtonColor: '#d33'
            });
        @endif
    });
</script>

