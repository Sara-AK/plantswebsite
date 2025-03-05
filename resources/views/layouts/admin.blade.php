<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard')</title>

    <link rel="shortcut icon" href="{{ asset('assets/images/favicon.png') }}">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

    <!-- AdminLTE CSS -->
    <link rel="stylesheet" href="{{ asset('vendor/admin-lte/dist/css/adminlte.min.css') }}">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <!-- Additional Styles -->
    <link rel="stylesheet" href="{{ asset('assets/css/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <!-- Select2 CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" />

    @stack('styles')
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    @include('partials.preloader')
    @include('partials.header')
    @include('partials.sidebar')

    <main>
        @yield('content')
    </main>

    <!-- Back to Top Button -->
    <div class="scroll-up">
        <svg class="scroll-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>

    <!-- jQuery (Only Once) -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <!-- Bootstrap JS -->
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- AdminLTE -->
    <script src="{{ asset('vendor/admin-lte/dist/js/adminlte.min.js') }}"></script>

    <!-- Additional Scripts -->
    <script src="{{ asset('assets/js/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.waypoints.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>

    <!-- App Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <!-- Initialize Select2 with Correct Placeholders -->
    <script>
        $(document).ready(function() {
            $('#categories').select2({
                placeholder: "Select Categories",
                allowClear: true,
                width: '100%'
            });

            $('#regions').select2({
                placeholder: "Select Regions",
                allowClear: true,
                width: '100%'
            });
        });
    </script>

    <style>
        .bg-dark-green {
            background-color: #4baf47 !important;
            color: white !important;
        }

        .table-dark-green {
            border: 0.5px solid #04240c;
        }

        .btn-success {
            background-color: #2d6a32 !important;
            border-color: #4baf47 !important;
        }

        .btn-success:hover {
            background-color: #4baf47 !important;
        }

        .rounded {
            border-radius: 10px !important;
        }

        .rounded-pill {
            border-radius: 50px !important;
        }

        .img-thumbnail {
            border-radius: 50% !important;
            object-fit: cover;
        }
    </style>

    @stack('scripts')

</body>

</html>
