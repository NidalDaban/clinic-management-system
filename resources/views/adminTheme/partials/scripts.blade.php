<script src="https://unpkg.com/feather-icons"></script>

<!-- Initialize Feather Icons -->
<script>
    feather.replace();
</script>

<script>
    document.addEventListener('DOMContentLoaded', function () {
    const sidebarToggle = document.querySelector('.sidebar-toggle');
    const sidebar = document.querySelector('#sidebar');

    if (sidebarToggle) {
        sidebarToggle.addEventListener('click', function () {
            sidebar.classList.toggle('collapse');
        });
    }
});

</script>

<!-- Custom CSS for alert indicator -->
<style>
    #alertsDropdown .indicator {
        position: absolute;
        top: -5px;
        right: -10px;
        background-color: red;
        color: white;
        font-size: 0.75rem;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        text-align: center;
        line-height: 18px;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
