<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>{{ $title }}</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css">
    
    <!-- Volt CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/volt.css') }}">
    
    <!-- Custom Admin CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/admin-custom.css') }}">

    <!-- SweetAlert2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
</head>

<body>
    <div class="container-scroller">
        @include('layouts.admin.partials._navbar_admin')

        <div class="container-fluid page-body-wrapper">
            @include('layouts.admin.partials._sidebar_admin')
            <!-- Main Content -->
            <div class="main-panel">
                <div class="content-wrapper">
                    @yield('content')
                </div>
                <!-- Include Footer -->
                @include('layouts.admin.partials._footer_admin')
            </div>
        </div>
    </div>

    <!-- plugins:js -->
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/js/volt.js') }}"></script>

    <!-- SweetAlert2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- SweetAlert Components -->
    <x-sweet-alert />
    <x-sweet-alert-delete />

    <!-- Sidebar Toggle Script -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle sidebar on mobile
            const toggler = document.querySelector('.navbar-toggler[data-toggle="offcanvas"]');
            const sidebar = document.querySelector('.sidebar');
            
            if (toggler && sidebar) {
                toggler.addEventListener('click', function() {
                    sidebar.classList.toggle('active');
                });
            }

            // Minimize sidebar on desktop
            const minimizeToggler = document.querySelector('.navbar-toggler[data-toggle="minimize"]');
            const body = document.querySelector('body');
            
            if (minimizeToggler) {
                minimizeToggler.addEventListener('click', function() {
                    body.classList.toggle('sidebar-icon-only');
                });
            }
        });
    </script>

    @stack('scripts')
</body>
</html>
