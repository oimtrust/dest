<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Dest') }} @yield('title')</title>
    <link rel="shortcut icon" href="{{ asset('images/dest-logos/favicon.png') }}" />

    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Fonts -->
    <link rel="stylesheet" href="{{ asset('fonts/fontawesome-5.10.2/css/all.css') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('stisla/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('stisla/assets/css/components.css') }}">
</head>
<body>
    <div id="app">
        <div class="main-wrapper">
            @include('partials._navbar')

            @include('partials._sidebar')

            @yield('content')

            @include('partials._footer')
        </div>
    </div>


<!-- Scripts -->
<!-- General JS Scripts -->
<script src="{{ asset('js/jquery-3.4.1.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
<script src="{{ asset('stisla/assets/js/stisla.js') }}"></script>

<!-- JS Libraies -->

<!-- Template JS File -->
<script src="{{ asset('stisla/assets/js/scripts.js') }}"></script>
<script src="{{ asset('stisla/assets/js/custom.js') }}"></script>

@yield('scripts')
<script type="text/javascript">
$(function () {
  $('[data-toggle="tooltip"]').tooltip()
})

</script>
<!-- End custom js for this page-->
</body>

</html>
