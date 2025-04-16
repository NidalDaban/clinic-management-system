<!DOCTYPE html>
<html lang="en">

@include('theme.partials.head')

<body class="index-page">

    @include('theme.partials.header')

    <main class="main">

        @include('theme.partials.hero')

        @yield('content')

    </main>

    @include('theme.partials.footer')

    <!-- Scroll Top -->
    <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i
            class="bi bi-arrow-up-short"></i></a>

    <!-- Preloader -->
    <div id="preloader"></div>

    @include('theme.partials.vendors')

    @include('theme.partials.scripts')

</body>

</html>
