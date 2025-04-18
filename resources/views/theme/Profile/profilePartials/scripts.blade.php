<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"></script>

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

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const fileInput = document.querySelector('.account-settings-fileinput');

        if (fileInput) {
            fileInput.addEventListener('change', function(e) {
                const file = e.target.files[0];
                const allowedTypes = ['image/jpeg', 'image/png'];

                if (file && !allowedTypes.includes(file.type)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid File Type',
                        text: 'Only JPG and PNG images are allowed.',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });

                    // Reset the file input
                    fileInput.value = '';
                }
            });
        }
    });
</script>

<script>
    $(document).ready(function() {
        const fileInput = $('.account-settings-fileinput');
        const imagePreview = $('#profileImagePreview');

        // Store current image or fallback to gender icon
        const hasCustomImage = imagePreview.attr('src') !== imagePreview.data('default');
        const originalImageSrc = hasCustomImage ? imagePreview.attr('src') : imagePreview.data('default');

        fileInput.on('change', function() {
            const file = this.files[0];
            const allowedTypes = ['image/jpeg', 'image/png'];
            const maxSize = 2 * 1024 * 1024;

            if (file) {
                if (!allowedTypes.includes(file.type)) {
                    Swal.fire({
                        icon: 'error',
                        title: 'Invalid File Type',
                        text: 'Only JPG and PNG images are allowed.',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });

                    this.value = '';
                    imagePreview.attr('src', originalImageSrc);
                    return;
                }

                if (file.size > maxSize) {
                    Swal.fire({
                        icon: 'error',
                        title: 'File Too Large',
                        text: 'Maximum allowed size is 2MB.',
                        confirmButtonColor: '#d33',
                        confirmButtonText: 'OK'
                    });

                    this.value = '';
                    imagePreview.attr('src', originalImageSrc);
                    return;
                }

                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.attr('src', e.target.result);
                    $('#removeImageInput').val('0');
                };
                reader.readAsDataURL(file);
            }
        });

        $('#removeImageBtn').on('click', function() {
            const defaultSrc = imagePreview.data('default');
            imagePreview.attr('src', defaultSrc);
            $('#removeImageInput').val('1');
            fileInput.val('');
        });
    });
</script>
