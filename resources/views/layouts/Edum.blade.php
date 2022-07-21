
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="keywords" content="" />
	<meta name="author" content="" />
	<meta name="robots" content="" />
	<meta name="description" content="Edumin - Bootstrap Admin Dashboard" />
	<meta property="og:title" content="Edumin - Bootstrap Admin Dashboard" />
	<meta property="og:description" content="Edumin - Bootstrap Admin Dashboard" />
	<meta property="og:image" content="https://edumin.dexignlab.com/xhtml/social-image.png" />
	<meta name="format-detection" content="telephone=no">

	<!-- FAVICONS ICON -->
	<link rel="icon" href="{{asset('uploads/logos/ZmlnAW2N0To93TQU4CZNqdPYorkDaVLgCsebsjLj.png')}}" type="image/x-icon" />
	<link rel="shortcut icon" type="image/x-icon" href="{{asset('uploads/logos/ZmlnAW2N0To93TQU4CZNqdPYorkDaVLgCsebsjLj.png')}}" />

	<!-- PAGE TITLE HERE -->
	<title> Faster Client - @yield('title' , 'Dashboard')</title>
	<!-- MOBILE SPECIFIC -->
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- STYLESHEETS -->
    <link rel="stylesheet" href="{{asset('EDUM/vendor/bootstrap-select/dist/css/bootstrap-select.min.css')}}">
    <link rel="stylesheet" href="{{asset('EDUM/css/style.css')}}">
	<link rel="stylesheet" href="{{asset('EDUM/css/skin.css')}}">
    <link rel="stylesheet" href="{{asset('EDUM/vendor/jquery-steps/css/jquery.steps.css')}}">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo&display=swap');
        *{
            font-family: 'Cairo', sans-serif;
        }
    </style>
    @livewireStyles
    {{-- @notifyCss --}}
@stack('styles')
</head>
<body>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="sk-three-bounce">
            <div class="sk-child sk-bounce1"></div>
            <div class="sk-child sk-bounce2"></div>
            <div class="sk-child sk-bounce3"></div>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">

        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header" style="background:#fff; height:60px">
            <a href="index.html" class="brand-logo">
                {{-- <img class="logo-abbr" src="images/logo-white-2.png" alt="">
                <img class="logo-compact" src="images/logo-text-white.png" alt="">
                <img class="brand-title" src="images/logo-text-white.png" alt=""> --}}
            <img src="{{asset('uploads/logos/ZmlnAW2N0To93TQU4CZNqdPYorkDaVLgCsebsjLj.png')}}"  width='30' alt="">
            </a>
            <div class="nav-control" style="background: #fff ; color:#000" >
                <div class="hamburger">
                    <span class="line"
                style="background: #000!important"
                    ></span><span class="line"
                    style="background: #000!important"
                    ></span><span class="line"
                    style="background: #000!important"
                    ></span>
                </div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        @include('layouts.Edum.includes.nav')
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->
        <!--**********************************
            Sidebar start
        ***********************************-->
            @include('layouts.Edum.includes.sidebar')
        <!--**********************************
            Sidebar end
        ***********************************-->
            {{-- Cojection Mohammed --}}
		<!--**********************************
            Content body start
        ***********************************-->
        <div class="content-body">
            <!-- row -->
            <div class="container-fluid">
                {{$slot ?? ''}}
                @yield('content')
            </div>
        </div>
        <!--**********************************
            Content body end
        ***********************************-->


        <!--**********************************
            Footer start
        ***********************************-->

        <!--**********************************
            Footer end
        ***********************************-->

    </div>
    <!--**********************************
        Main wrapper end
    ***********************************-->

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->

    @livewireScripts


    <script src="{{asset('EDUM/vendor/global/global.min.js') }}"></script>
	<script src="{{asset('EDUM/vendor/bootstrap-select/dist/js/bootstrap-select.min.js')}}"></script>
	<script src="{{asset('EDUM/js/custom.min.js')}}"></script>

    <!-- Chart Morris plugin files -->
    <script src="{{asset('EDUM/vendor/raphael/raphael.min.js')}}"></script>
    <script src="{{asset('EDUM/vendor/morris/morris.min.js') }}"></script>

	<!-- Chart piety plugin files -->
    <script src="{{asset('EDUM/vendor/peity/jquery.peity.min.js') }}"></script>

	<!-- Demo scripts -->
    <script src="{{asset('EDUM/js/dashboard/dashboard-2.js') }}"></script>

	<!-- Svganimation scripts -->
    <script src="{{asset('EDUM/vendor/svganimation/vivus.min.js') }}"></script>
    <script src="{{asset('EDUM/vendor/svganimation/svg.animation.js') }}"></script>
    @stack('script')
</body>
</html>
