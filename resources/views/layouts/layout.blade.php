<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'পাতা') - জেলা প্রশাসন, ভোলা</title>

    <link rel="icon" type="image/x-icon" href="{{ asset('custom/img/bhola-favicon.ico') }}"/>
    <link href="{{ asset('layouts/vertical-light-menu/css/light/loader.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('layouts/vertical-light-menu/css/dark/loader.css') }}" rel="stylesheet" type="text/css" />
    <script src="{{ asset('layouts/vertical-light-menu/loader.js') }}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet"> --}}
    {{-- <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@400;600;700&display=swap" rel="stylesheet"> --}}

    <link href="{{ asset('src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('layouts/vertical-light-menu/css/light/plugins.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('layouts/vertical-light-menu/css/dark/plugins.css') }}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    @yield('page-level-custom-css')
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->

    <!-- BEGIN SWEET ALERT CSS -->
    <link rel="stylesheet" href="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.css') }}">
    <link href="{{ asset('src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('src/plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}" rel="stylesheet" type="text/css" />
    <!-- END SWEET ALERT CSS -->

    <!-- CUSTOM CSS -->
    <link rel="stylesheet" href="{{ asset('custom/style.css') }}">

</head>
<body class="layout-boxed">
    <!-- BEGIN LOADER -->
    <div id="load_screen"> <div class="loader"> <div class="loader-content">
        <div class="spinner-grow align-self-center"></div>
    </div></div></div>
    <!--  END LOADER -->

    
    <!--  BEGIN NAVBAR  -->
    @include('layouts.navbar')
    <!--  END NAVBAR  -->


    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        @include('layouts.sidebar')
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="middle-content container-xxl p-0">

                    <!--  BEGIN BREADCRUMBS  -->
                    @include('layouts.secondary-nav')
                    <!--  END BREADCRUMBS  -->
                    
                    @yield('content')

                </div>

            </div>
            <!--  BEGIN FOOTER  -->
            @include('layouts.footer')
            <!--  END FOOTER  -->
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->

    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/mousetrap/mousetrap.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/waves/waves.min.js') }}"></script>
    <script src="{{ asset('layouts/vertical-light-menu/app.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->

    <!-- BEGIN SWEET ALERT SCRIPTS -->
    <script src="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
    <script src="{{ asset('src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
    <!-- END SWEET ALERT SCRIPTS -->


    <!-- Custom Scripts from each page Starts-->
    @yield('scripts')
    <!-- Custom Scripts from each page Ends-->

    @if($message = session('success'))
        <script>
            Swal.fire({
                title: 'সাকসেস!',
                text: '{{ $message }}',
                icon: 'success',
                confirmButtonText: 'ওকে',
                timer: 2000,
                timerProgressBar: true,
            });
        </script>
    @endif

    @if($message = session('warning'))
        <script>
            Swal.fire({
                title: 'সতর্কতা!',
                text: '{{ $message }}',
                icon: 'warning',
                confirmButtonText: 'ওকে',
                timer: 2000,
                timerProgressBar: true,
            });
        </script>
    @endif
</body>
</html>