<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dest') }} @yield('title')</title>

    <!-- plugins:css -->
    <link rel="stylesheet" href="{{ asset('purpleadmin/iconfonts/mdi/css/materialdesignicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('purpleadmin/css/vendor.bundle.base.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/selectjs-4.0.7/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/mdi/css/materialdesignicons.css') }}">

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link rel="shortcut icon" href="{{ asset('images/dest-logos/favicon.png') }}" />
</head>
<body>
    <div class="container-scroller">
            <!-- partial:partials/_navbar -->
            @include('partials._navbar')
            <!-- partial -->
            <div class="container-fluid page-body-wrapper">
                <!-- partial:partials/_sidebar -->
                @include('partials._sidebar')

                <!-- partial -->
                <div class="main-panel">
                    <div class="content-wrapper">
                    @yield('content')
                    </div>
                    <!-- content-wrapper ends -->
                    <!-- partial:partials/_footer -->
                    @include('partials._footer')
                    <!-- partial -->
                </div>
                <!-- main-panel ends -->
            </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->


<!-- Scripts -->
<script src="{{ asset('js/jquery-3.4.1.js') }}"></script>
<!-- plugins:js -->
<script src="{{ asset('purpleadmin/js/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('purpleadmin/js/vendor.bundle.addons.js') }}"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{ asset('js/off-canvas.js') }}"></script>
<script src="{{ asset('js/misc.js') }}"></script>

<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{ asset('js/dashboard.js') }}"></script>
<script src="{{ asset('js/sweetalert.min.js') }}"></script>

@yield('scripts')
<script type="text/javascript">
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>
<!-- End custom js for this page-->
</body>

</html>
