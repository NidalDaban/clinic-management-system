<!DOCTYPE html>
<html lang="en">

@include('adminTheme.partials.head')

<body>

    <div class="wrapper">
        @include('adminTheme.partials.sidebar')

        <div class="main">

            @include('adminTheme.partials.header')

            <main class="content">
                <div class="container-fluid p-0">

                    <h1 class="h3 mb-3">Blank Page</h1>
                    @yield('content')

                </div>
            </main>

            @include('adminTheme.partials.footer')

        </div>
    </div>

    @include('adminTheme.partials.scripts')

</body>

</html>
