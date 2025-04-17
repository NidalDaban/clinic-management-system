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
    document.addEventListener("DOMContentLoaded", function() {
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
    });
</script>

<script>
    const attendsSelect = document.getElementById('attends');
    const methodField = document.querySelector('[name="method"]');
    const amountField = document.querySelector('[name="total_amount"]');

    function togglePaymentRequired() {
        const isOnline = attendsSelect.value === 'online';
        methodField.required = isOnline;
        amountField.required = isOnline;
    }

    attendsSelect.addEventListener('change', togglePaymentRequired);

    // Run once on page load
    togglePaymentRequired();
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const serviceSelect = document.getElementById('service_id');
        const totalAmountInput = document.getElementById('total_amount');

        serviceSelect.addEventListener('change', function() {
            const selectedOption = this.options[this.selectedIndex];
            const price = selectedOption.getAttribute('data-price');
            totalAmountInput.value = price ? parseFloat(price).toFixed(2) : '';
        });
    });
</script>

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

@if ($errors->has('appointment_datetime'))
    <script>
        Swal.fire({
            icon: 'warning',
            title: 'Time Slot Unavailable',
            html: `<p style="font-size:16px;">The selected time slot is already booked with your chosen specialist.</p>
                   <p style="font-size:14px;">Please choose a different time that works best for you.</p>`,
            confirmButtonText: 'Got it',
            customClass: {
                popup: 'shadow-lg rounded-4',
                confirmButton: 'btn btn-primary px-4 py-2 rounded-pill'
            },
            buttonsStyling: false
        });
    </script>
@endif
