<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Панель Администратора</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap Styles-->
    <link href="{{asset('assets/css/bootstrap.css')}}" rel="stylesheet"/>
    <!-- FontAwesome Styles-->
    <link href="{{asset('assets/css/font-awesome.css')}}" rel="stylesheet"/>
    <!-- Custom Styles-->
    <link href="{{asset('assets/css/custom-styles.css')}}" rel="stylesheet"/>
    <!-- Google Fonts-->
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'/>
    <!-- TABLE STYLES-->
    <link href="{{asset('assets/js/dataTables/dataTables.bootstrap.css')}}" rel="stylesheet"/>


    <link rel="shortcut icon" href="{{asset('Images/icon/favicon.ico')}}" type="image/x-icon">

    <!-- Web Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Pacifico%7CSource+Sans+Pro:200,200i,300,300i,400,400i,600,600i,700,700i,900,900i&amp;amp;subset=latin-ext,vietnamese"
          rel="stylesheet">

    <!-- Vendor CSS-->

{{--    <link rel="stylesheet" type="text/css" href="{{ asset('libs/bootstrap/css/bootstrap.min.css')}}">--}}
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/font-awesome/css/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/animate/animated.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/owl.carousel.min/owl.carousel.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/jquery.mmenu.all/jquery.mmenu.all.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/pe-icon-7-stroke/css/pe-icon-7-stroke.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/direction/css/noJS.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/prettyphoto-master/css/prettyPhoto.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/slick-sider/slick.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('libs/countdown-timer/css/demo.css')}}">

    <!-- Template CSS-->
    <link rel="stylesheet" type="text/css" href="{{ asset('css/main.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/home.css')}}">

    <link rel="stylesheet" type="text/css" href="{{ asset('css/sadTest.css')}}">

</head>
<body>
<div id="wrapper">
    <x-admin-topbar></x-admin-topbar>

    <x-admin-sidebar></x-admin-sidebar>


    <div id="page-wrapper">
        <div id="page-inner">
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <div class="alert alert-danger">{{$error}}</div>
                @endforeach
            @endif
            @if(session()->has('error'))
                <div class="alert alert-danger">{{session()->get('error')}}</div>
            @endif
            @if(session()->has('success'))
                <div class="alert alert-success">{{session()->get('success')}}</div>
            @endif
            @yield('content')
        </div>
        <x-admin-footer></x-admin-footer>
    </div>
</div>


<!-- JS Scripts-->
<!-- jQuery Js -->
<script src="{{asset('assets/js/jquery-1.10.2.js')}}"></script>
<!-- Bootstrap Js -->
<script src="{{asset('assets/js/bootstrap.min.js')}}"></script>
<!-- Metis Menu Js -->
<script src="{{asset('assets/js/jquery.metisMenu.js')}}"></script>
<!-- DATA TABLE SCRIPTS -->
<script src="{{asset('assets/js/dataTables/jquery.dataTables.js')}}"></script>
<script src="{{asset('assets/js/dataTables/dataTables.bootstrap.js')}}"></script>

<!-- Custom Js -->
<script src="{{asset('assets/js/custom-scripts.js')}}"></script>
<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>


<!-- Custom scripts for all pages-->
<script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>
@stack('js')

<!-- Vendor jQuery-->
<script type="text/javascript" src="{{ asset('libs/jquery/jquery.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('libs/bootstrap/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('libs/animate/wow.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('libs/jquery.mmenu.all/jquery.mmenu.all.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('libs/countdown/jquery.countdown.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('libs/jquery-appear/jquery.appear.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('libs/jquery-countto/jquery.countTo.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('libs/direction/js/jquery.hoverdir.js')}}"></script>
<script type="text/javascript" src="{{ asset('libs/direction/js/modernizr.custom.97074.js')}}"></script>
<script type="text/javascript" src="{{ asset('libs/isotope/isotope.pkgd.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('libs/isotope/fit-columns.js')}}"></script>
<script type="text/javascript" src="{{ asset('libs/isotope/isotope-docs.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('libs/mansory/mansory.js')}}"></script>
<script type="text/javascript" src="{{ asset('libs/prettyphoto-master/js/jquery.prettyPhoto.js')}}"></script>
<script type="text/javascript" src="{{ asset('libs/slick-sider/slick.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('libs/countdown-timer/js/jquery.final-countdown.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('libs/countdown-timer/js/kinetic.js')}}"></script>
<script type="text/javascript" src="{{ asset('libs/owl.carousel.min/owl.carousel.min.js')}}"></script>
<script type="text/javascript" src="{{ asset('js/main.js')}}"></script>

<script type="text/javascript" src="{{ asset('js/sadTest.js')}}"></script>

</body>
</html>
