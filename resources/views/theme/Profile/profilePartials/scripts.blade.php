<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        
        $('.account-settings-fileinput').on('change', function() {
            const [file] = this.files;
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    $('#profileImagePreview').attr('src', e.target.result);
                };
                reader.readAsDataURL(file);
                $('#removeImageInput').val('0');
            }
        });

        $('#removeImageBtn').on('click', function() {
            const defaultSrc = $('#profileImagePreview').data('default');
            $('#profileImagePreview').attr('src', defaultSrc);
            $('#removeImageInput').val('1');
        });

        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}',
                timer: 2000,
                showConfirmButton: false
            });
        @endif

        @if ($errors->any())
            Swal.fire({
                icon: 'error',
                title: 'Update Failed',
                html: `{!! implode('<br>', $errors->all()) !!}`
            });
        @endif
    });
</script>
