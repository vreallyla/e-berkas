<!DOCTYPE HTML>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Website Template by FreeHTML5.co"/>
    <meta name="keywords"
          content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive"/>
    <meta name="author" content="FreeHTML5.co"/>

    <!-- Facebook and Twitter integration -->
    <meta property="og:title" content=""/>
    <meta property="og:image" content=""/>
    <meta property="og:url" content=""/>
    <meta property="og:site_name" content=""/>
    <meta property="og:description" content=""/>
    <meta name="twitter:title" content=""/>
    <meta name="twitter:image" content=""/>
    <meta name="twitter:url" content=""/>
    <meta name="twitter:card" content=""/>

    <link href="https://fonts.googleapis.com/css?family=Work+Sans:300,400,500,700,800" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="{{asset('images/logo-sby.png')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{ asset('/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('/dataTables/css/dataTables.bootstrap.min.css') }}">

    <!-- Animate.css -->
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/w3.css')}}">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="{{asset('css/icomoon.css')}}">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <link rel="stylesheet" href="{{asset('bootstrap-toggle/css/bootstrap-toggle.css')}}">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">

    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <!-- Flexslider  -->
    <link rel="stylesheet" href="{{asset('css/flexslider.css')}}">

    <!-- Theme style  -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('datepicker/jquery-ui.css')}}">

    <!-- Modernizr JS -->
    <script src="{{asset('js/modernizr-2.6.2.min.js')}}"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="{{asset('js/respond.min.js')}}"></script>
    <![endif]-->

    <script src="{{ asset('sweetalert2/baru/sweetalert2.all.js') }}"></script>
    <script src="{{ asset('sweetalert2/baru/core.js') }}"></script>
    {{--<link rel="stylesheet" href="{{ asset('/sweetalert2/sweetalert2.min.css') }}">--}}
    <script src="{{ asset('js/bootstrap.js') }}"></script>

    <style>

        .image-upload > input {
            display: none;
        }

        .image-upload label {
            cursor: pointer;
        }

        /* --------------------------------

    Basic Style

    -------------------------------- */
        .cd-breadcrumb, .cd-multi-steps {
            width: 90%;
            max-width: 100%;
            padding: 0.5em 1em;
            margin: 1em auto;
            background-color: #edeff0;
            border-radius: .25em;
        }

        .cd-breadcrumb:after, .cd-multi-steps:after {
            content: "";
            display: table;
            clear: both;
        }

        .cd-breadcrumb li, .cd-multi-steps li {
            display: inline-block;
            float: left;
            margin: 0.5em 0;
        }

        .cd-breadcrumb li::after, .cd-multi-steps li::after {
            /* this is the separator between items */
            display: inline-block;
            content: '\00bb';
            margin: 0 .6em;
            color: #959fa5;
        }

        .cd-breadcrumb li:last-of-type::after, .cd-multi-steps li:last-of-type::after {
            /* hide separator after the last item */
            display: none;
        }

        .cd-breadcrumb li > *, .cd-multi-steps li > * {
            /* single step */
            display: inline-block;
            font-size: 1.4rem;
            color: #2c3f4c;
        }

        .cd-breadcrumb li.current > *, .cd-multi-steps li.current > * {
            /* selected step */
            color: #f85858;
        }

        .no-touch .cd-breadcrumb a:hover, .no-touch .cd-multi-steps a:hover {
            /* steps already visited */
            color: #f85858;
        }

        .cd-breadcrumb.custom-separator li::after, .cd-multi-steps.custom-separator li::after {
            /* replace the default arrow separator with a custom icon */
            content: '';
            height: 16px;
            width: 16px;
            background: url({{asset('breadcrumb/img/cd-custom-separator.svg')}}) no-repeat center center;
            vertical-align: middle;
        }

        .cd-breadcrumb.custom-icons li > *::before, .cd-multi-steps.custom-icons li > *::before {
            /* add a custom icon before each item */
            content: '';
            display: inline-block;
            height: 20px;
            width: 20px;
            margin-right: .4em;
            margin-top: -2px;
            background: url({{asset('breadcrumb/img/cd-custom-icons-01.svg')}}) no-repeat 0 0;
            vertical-align: middle;
        }

        .cd-breadcrumb.custom-icons li:not(.current):nth-of-type(2) > *::before, .cd-multi-steps.custom-icons li:not(.current):nth-of-type(2) > *::before {
            /* change custom icon using image sprites */
            background-position: -20px 0;
        }

        .cd-breadcrumb.custom-icons li:not(.current):nth-of-type(3) > *::before, .cd-multi-steps.custom-icons li:not(.current):nth-of-type(3) > *::before {
            background-position: -40px 0;
        }

        .cd-breadcrumb.custom-icons li:not(.current):nth-of-type(4) > *::before, .cd-multi-steps.custom-icons li:not(.current):nth-of-type(4) > *::before {
            background-position: -60px 0;
        }

        .cd-breadcrumb.custom-icons li.current:first-of-type > *::before, .cd-multi-steps.custom-icons li.current:first-of-type > *::before {
            /* change custom icon for the current item */
            background-position: 0 -20px;
        }

        .cd-breadcrumb.custom-icons li.current:nth-of-type(2) > *::before, .cd-multi-steps.custom-icons li.current:nth-of-type(2) > *::before {
            background-position: -20px -20px;
        }

        .cd-breadcrumb.custom-icons li.current:nth-of-type(3) > *::before, .cd-multi-steps.custom-icons li.current:nth-of-type(3) > *::before {
            background-position: -40px -20px;
        }

        .cd-breadcrumb.custom-icons li.current:nth-of-type(4) > *::before, .cd-multi-steps.custom-icons li.current:nth-of-type(4) > *::before {
            background-position: -60px -20px;
        }

        @media only screen and (min-width: 768px) {
            .cd-breadcrumb, .cd-multi-steps {
                padding: 0 1.2em;
            }

            .cd-breadcrumb li, .cd-multi-steps li {
                margin: 1.2em 0;
            }

            .cd-breadcrumb li::after, .cd-multi-steps li::after {
                margin: 0 1em;
            }

            .cd-breadcrumb li > *, .cd-multi-steps li > * {
                font-size: 1.6rem;
            }
        }

        /* --------------------------------

        Triangle breadcrumb

        -------------------------------- */
        @media only screen and (min-width: 768px) {
            .cd-breadcrumb.triangle {
                /* reset basic style */
                background-color: transparent;
                padding: 0;
            }

            .cd-breadcrumb.triangle li {
                position: relative;
                padding: 0;
                margin: 4px 4px 4px 0;
            }

            .cd-breadcrumb.triangle li:last-of-type {
                margin-right: 0;
            }

            .cd-breadcrumb.triangle li > * {
                position: relative;
                padding: 1em .8em 1em 2.5em;
                color: #2c3f4c;
                background-color: #edeff0;
                /* the border color is used to style its ::after pseudo-element */
                border-color: #edeff0;
            }

            .cd-breadcrumb.triangle li.current > * {
                /* selected step */
                color: #ffffff;
                background-color: #f85858;
                border-color: #f85858;
            }

            .cd-breadcrumb.triangle li:first-of-type > * {
                padding-left: 1.6em;
                border-radius: .25em 0 0 .25em;
            }

            .cd-breadcrumb.triangle li:last-of-type > * {
                padding-right: 1.6em;
                border-radius: 0 .25em .25em 0;
            }

            .no-touch .cd-breadcrumb.triangle a:hover {
                /* steps already visited */
                color: #ffffff;
                background-color: #2c3f4c;
                border-color: #2c3f4c;
            }

            .cd-breadcrumb.triangle li::after, .cd-breadcrumb.triangle li > *::after {
                /*
                    li > *::after is the colored triangle after each item
                    li::after is the white separator between two items
                */
                content: '';
                position: absolute;
                top: 0;
                left: 100%;
                content: '';
                height: 0;
                width: 0;
                /* 48px is the height of the <a> element */
                border: 24px solid transparent;
                border-right-width: 0;
                border-left-width: 20px;
            }

            .cd-breadcrumb.triangle li::after {
                /* this is the white separator between two items */
                z-index: 1;
                -webkit-transform: translateX(4px);
                -moz-transform: translateX(4px);
                -ms-transform: translateX(4px);
                -o-transform: translateX(4px);
                transform: translateX(4px);
                border-left-color: #ffffff;
                /* reset style */
                margin: 0;
            }

            .cd-breadcrumb.triangle li > *::after {
                /* this is the colored triangle after each element */
                z-index: 2;
                border-left-color: inherit;
            }

            .cd-breadcrumb.triangle li:last-of-type::after, .cd-breadcrumb.triangle li:last-of-type > *::after {
                /* hide the triangle after the last step */
                display: none;
            }

            .cd-breadcrumb.triangle.custom-separator li::after {
                /* reset style */
                background-image: none;
            }

            .cd-breadcrumb.triangle.custom-icons li::after, .cd-breadcrumb.triangle.custom-icons li > *::after {
                /* 50px is the height of the <a> element */
                border-top-width: 25px;
                border-bottom-width: 25px;
            }

            @-moz-document url-prefix() {
                .cd-breadcrumb.triangle li::after,
                .cd-breadcrumb.triangle li > *::after {
                    /* fix a bug on Firefix - tooth edge on css triangle */
                    border-left-style: dashed;
                }
            }
        }

        /* --------------------------------

        Custom icons hover effects - breadcrumb and multi-steps

        -------------------------------- */
        @media only screen and (min-width: 768px) {
            .no-touch .cd-breadcrumb.triangle.custom-icons li:first-of-type a:hover::before, .cd-breadcrumb.triangle.custom-icons li.current:first-of-type em::before, .no-touch .cd-multi-steps.text-center.custom-icons li:first-of-type a:hover::before, .cd-multi-steps.text-center.custom-icons li.current:first-of-type em::before {
                /* change custom icon using image sprites - hover effect or current item */
                background-position: 0 -40px;
            }

            .no-touch .cd-breadcrumb.triangle.custom-icons li:nth-of-type(2) a:hover::before, .cd-breadcrumb.triangle.custom-icons li.current:nth-of-type(2) em::before, .no-touch .cd-multi-steps.text-center.custom-icons li:nth-of-type(2) a:hover::before, .cd-multi-steps.text-center.custom-icons li.current:nth-of-type(2) em::before {
                background-position: -20px -40px;
            }

            .no-touch .cd-breadcrumb.triangle.custom-icons li:nth-of-type(3) a:hover::before, .cd-breadcrumb.triangle.custom-icons li.current:nth-of-type(3) em::before, .no-touch .cd-multi-steps.text-center.custom-icons li:nth-of-type(3) a:hover::before, .cd-multi-steps.text-center.custom-icons li.current:nth-of-type(3) em::before {
                background-position: -40px -40px;
            }

            .no-touch .cd-breadcrumb.triangle.custom-icons li:nth-of-type(4) a:hover::before, .cd-breadcrumb.triangle.custom-icons li.current:nth-of-type(4) em::before, .no-touch .cd-multi-steps.text-center.custom-icons li:nth-of-type(4) a:hover::before, .cd-multi-steps.text-center.custom-icons li.current:nth-of-type(4) em::before {
                background-position: -60px -40px;
            }
        }

        /* --------------------------------

        Multi steps indicator

        -------------------------------- */
        @media only screen and (min-width: 768px) {
            .cd-multi-steps {
                /* reset style */
                background-color: transparent;
                padding: 0;
                text-align: center;
            }

            .cd-multi-steps li {
                position: relative;
                float: none;
                margin: 0.4em 40px 0.4em 0;
            }

            .cd-multi-steps li:last-of-type {
                margin-right: 0;
            }

            .cd-multi-steps li::after {
                /* this is the line connecting 2 adjacent items */
                position: absolute;
                content: '';
                height: 4px;
                background: #edeff0;
                /* reset style */
                margin: 0;
            }

            .cd-multi-steps li.visited::after {
                background-color: #f85858;
            }

            .cd-multi-steps li > *, .cd-multi-steps li.current > * {
                position: relative;
                color: #2c3f4c;
            }

            .cd-multi-steps.custom-separator li::after {
                /* reset style */
                height: 4px;
                background: #edeff0;
            }

            .cd-multi-steps.text-center li::after {
                width: 100%;
                top: 50%;
                left: 100%;
                -webkit-transform: translateY(-50%) translateX(-1px);
                -moz-transform: translateY(-50%) translateX(-1px);
                -ms-transform: translateY(-50%) translateX(-1px);
                -o-transform: translateY(-50%) translateX(-1px);
                transform: translateY(-50%) translateX(-1px);
            }

            .cd-multi-steps.text-center li > * {
                z-index: 1;
                padding: .6em 1em;
                border-radius: .25em;
                background-color: #edeff0;
            }

            .no-touch .cd-multi-steps.text-center a:hover {
                background-color: #2c3f4c;
            }

            .cd-multi-steps.text-center li.current > *, .cd-multi-steps.text-center li.visited > * {
                color: #ffffff;
                background-color: #f85858;
            }

            .cd-multi-steps.text-center.custom-icons li.visited a::before {
                /* change the custom icon for the visited item - check icon */
                background-position: 0 -60px;
            }

            .cd-multi-steps.text-top li, .cd-multi-steps.text-bottom li {
                width: 80px;
                text-align: center;
            }

            .cd-multi-steps.text-top li::after, .cd-multi-steps.text-bottom li::after {
                /* this is the line connecting 2 adjacent items */
                position: absolute;
                left: 50%;
                /* 40px is the <li> right margin value */
                width: calc(100% + 40px);
            }

            .cd-multi-steps.text-top li > *::before, .cd-multi-steps.text-bottom li > *::before {
                /* this is the spot indicator */
                content: '';
                position: absolute;
                z-index: 1;
                left: 50%;
                right: auto;
                -webkit-transform: translateX(-50%);
                -moz-transform: translateX(-50%);
                -ms-transform: translateX(-50%);
                -o-transform: translateX(-50%);
                transform: translateX(-50%);
                height: 12px;
                width: 12px;
                border-radius: 50%;
                background-color: #edeff0;
            }

            .cd-multi-steps.text-top li.visited > *::before,
            .cd-multi-steps.text-top li.current > *::before, .cd-multi-steps.text-bottom li.visited > *::before,
            .cd-multi-steps.text-bottom li.current > *::before {
                background-color: #f85858;
            }

            .no-touch .cd-multi-steps.text-top a:hover, .no-touch .cd-multi-steps.text-bottom a:hover {
                color: #f85858;
            }

            .no-touch .cd-multi-steps.text-top a:hover::before, .no-touch .cd-multi-steps.text-bottom a:hover::before {
                box-shadow: 0 0 0 3px rgba(192, 71, 71, 0.3);
            }

            .cd-multi-steps.text-top li::after {
                /* this is the line connecting 2 adjacent items */
                bottom: 4px;
            }

            .cd-multi-steps.text-top li > * {
                padding-bottom: 20px;
            }

            .cd-multi-steps.text-top li > *::before {
                /* this is the spot indicator */
                bottom: 0;
            }

            .cd-multi-steps.text-bottom li::after {
                /* this is the line connecting 2 adjacent items */
                top: 3px;
            }

            .cd-multi-steps.text-bottom li > * {
                padding-top: 20px;
            }

            .cd-multi-steps.text-bottom li > *::before {
                /* this is the spot indicator */
                top: 0;
            }
        }

        /* --------------------------------

        Add a counter to the multi-steps indicator

        -------------------------------- */
        .cd-multi-steps.count li {
            counter-increment: steps;
        }

        .cd-multi-steps.count li > *::before {
            content: counter(steps) " - ";
        }

        @media only screen and (min-width: 768px) {
            .cd-multi-steps.text-top.count li > *::before,
            .cd-multi-steps.text-bottom.count li > *::before {
                /* this is the spot indicator */
                content: counter(steps);
                height: 26px;
                width: 26px;
                line-height: 26px;
                font-size: 1.4rem;
                color: #ffffff;
            }

            .cd-multi-steps.text-top.count li:not(.current) em::before,
            .cd-multi-steps.text-bottom.count li:not(.current) em::before {
                /* steps not visited yet - counter color */
                color: #2c3f4c;
            }

            .cd-multi-steps.text-top.count li::after {
                bottom: 11px;
            }

            .cd-multi-steps.text-top.count li > * {
                padding-bottom: 34px;
            }

            .cd-multi-steps.text-bottom.count li::after {
                top: 11px;
            }

            .cd-multi-steps.text-bottom.count li > * {
                padding-top: 34px;
            }
        }

        .tgl {
            position: relative;
            outline: 0;
            display: inline-block;
            cursor: pointer;
            user-select: none;
            margin: 0 0 5px 0;
            width: 100%;
        }

        .tgl,
        .tgl:after,
        .tgl:before,
        .tgl *,
        .tgl *:after,
        .tgl *:before,
        .tgl + .tgl-btn {
            box-sizing: border-box;
        }

        .tgl::selection,
        .tgl:after::selection,
        .tgl:before::selection,
        .tgl *::selection,
        .tgl *:after::selection,
        .tgl *:before::selection,
        .tgl + .tgl-btn::selection {
            background: none;
        }

        .tgl span {
            position: relative;
            display: block;
            height: 1.8em;
            line-height: 1.2em;
            overflow: hidden;
            font-weight: normal;
            text-align: center;
            border-radius: 2em;
            padding: 0.2em 1em;
            border: 1px solid #fafafa;
            box-shadow: inset 0 2px 0 rgba(0, 0, 0, 0.2), 0 2px 0 rgba(255, 255, 255, 0.7);
            transition: color 0.3s ease, padding 0.3s ease-in-out, background 0.3s ease-in-out;
        }

        .tgl span:before {
            position: relative;
            display: block;
            line-height: 1.3em;
            padding: 0 0.2em;
            font-size: 1em;
        }

        .tgl span:after {
            position: absolute;
            display: block;
            content: '';
            border-radius: 2em;
            width: 1.3em;
            height: 1.3em;
            margin-left: -1.45em;
            top: 0.2em;
            background: #FFFFFF;
            transition: left 0.3s cubic-bezier(0.175, 0.885, 0.32, 0.97), background 0.3s ease-in-out;
        }

        .tgl input[type="checkbox"] {
            display: none !important;
        }

        .tgl input[type="checkbox"]:not(:checked) + span {
            background: #7ba9d0;
            color: #FFFFFF;
            padding-left: 1.6em;
            padding-right: 0.4em;
        }

        .tgl input[type="checkbox"]:not(:checked) + span:before {
            content: attr(data-off);
            color: #FFFFFF;
        }

        .tgl input[type="checkbox"]:not(:checked) + span:after {
            background: #FFFFFF;
            left: 1.6em;
        }

        .tgl input[type="checkbox"]:checked + span {
            background: #f85858;
            color: #FFFFFF;
            padding-left: 0.4em;
            padding-right: 1.6em;
        }

        .tgl input[type="checkbox"]:checked + span:before {
            content: attr(data-on);
        }

        .tgl input[type="checkbox"]:checked + span:after {
            background: #FFFFFF;
            left: 100%;
        }

        .tgl input[type="checkbox"]:disabled,
        .tgl input[type="checkbox"]:disabled + span,
        .tgl input[type="checkbox"]:read-only,
        .tgl input[type="checkbox"]:read-only + span {
            cursor: not-allowed;
        }

        .tgl-gray input[type="checkbox"]:not(:checked) + span {
            background: #dbdbdb;
            color: #999999;
        }

        .tgl-gray input[type="checkbox"]:not(:checked) + span:before {
            color: #999999;
        }

        .tgl-gray input[type="checkbox"]:not(:checked) + span:after {
            background: #ffffff;
        }

        .tgl-inline {
            display: inline-block !important;
            vertical-align: top;
        }

        .tgl-inline.tgl {
            font-size: 16px;
        }

        .tgl-inline.tgl span {
            min-width: 50px;
        }

        .tgl-inline.tgl span:before {
            line-height: 1.4em;
            padding-left: 0.4em;
            padding-right: 0.4em;
        }

        .tgl-inline-label {
            display: inline-block !important;
            vertical-align: top;
            line-height: 26px;
        }

    </style>
    @yield('style')

    <script src='https://www.google.com/recaptcha/api.js'></script>
</head>
<body>
{{--@if(session('status'))
    <script>
        alert("{{session('status')}}");
    </script>
@endif--}}
<div id="page">
    <nav class="fh5co-nav" role="navigation">
        <div class="top-menu">
            <div class="container">
                <div class="row">
                    <div class="col-xs-1">
                        <div id="fh5co-logo">
                            <a href="{{route('dashboard')}}"><span><img src="{{asset('images/aaak.jpg')}}"
                                                                        alt="re:eBerkas"
                                                                        width="120px"></span></a>
                        </div>
                    </div>
                    <div class="col-xs-11 text-right menu-1">
                        <ul>
                            @yield('nav')
                            @if(!\Illuminate\Support\Facades\Auth::guest())
                                <li class="has-dropdown">
                                    <a href="#" class="myBtn" id="userfill"><span>{{Auth::user()->name}}</span></a>
                                    <ul class="dropdown">
                                        @if(!\Illuminate\Support\Facades\Auth::guest())
                                            <?php $ceko = \Illuminate\Support\Facades\Auth::user()->role->name; ?>
                                            {{--@if ($ceko=='Pengurus'||$ceko=='Admin')--}}
                                                {{--<li><a href="{{route('user.pengurus')}}#fh5co-set"><i--}}
                                                                {{--class="fa fa-stack-overflow"></i>--}}
                                                        {{--Halaman Pengurus</a></li>--}}
                                            {{--@endif--}}
                                        @endif
                                        <li><a href="{{url('user/update')}}"><i
                                                        class="fa fa-edit"></i> Edit
                                                Profile</a></li>
                                        <li>
                                            <a href="{{ route('logout') }}"
                                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                                <i class="fa fa-sign-out"></i> Logout
                                            </a>

                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                  style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </li>
                                    </ul>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </nav>
    @yield('content')
    @if(\Illuminate\Support\Facades\Auth::guest())
    @else
        <div id="fh5co-started" style="background-image:url({{asset('images/legal.jpeg')}});">
            <div class="overlay"></div>
            <div class="container">

                <div class="row animate-box">
                    <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                        <h2>Legal Advice</h2>
                        <p>Kami ada untuk memudahkan Anda melakukan proses permohonan Surat Izin Apotek, Penyelenggaraan
                            Depo Air Minum, dan Operasional Perusahaan Pengendalian Hama.</p>
                    </div>
                </div>

                <div class="row animate-box">
                    <div class="col-md-8 col-md-offset-2 text-center">
                        <p>
                            <a href="{{url('home/')}}#fh5co-practice" class="btn btn-default btn-lg">TAMBAH BERKAS
                                SEKARANG</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <footer id="fh5co-footer" role="contentinfo">
        <div class="container">
            <div class="row row-pb-md">
                <div class="col-md-3 fh5co-widget">
                    <h4><a href="https://twitter.com/ditjenpajakri?lang=en">"ISOK REK"</a></h4>
                    <p style="text-transform: uppercase">"<span style="color: #f55b57 ">I</span>NOVASI,
                        <span style="color: #f55b57 ">SO</span>LUSI, <span style="color: #f55b57 ">K</span>REDIBEL,
                        <span style="color: #f55b57 ">R</span>ESPONSIF, <span style="color: #f55b57 ">E</span>LABORASI,
                        <span style="color: #f55b57 ">K</span>EMITRAAN"</p>
                </div>
                <div class="col-md-3 col-md-push-1">
                    <h4>Navigation</h4>
                    <ul class="fh5co-footer-links">

                        @if(Auth::guest())
                            <li><a href="{{route('login')}}">Login</a></li>
                            <li><a href="{{route('login')}}">Contact</a></li>
                            {{--<li><a href="{{route('register')}}">Register</a></li>--}}
                        @else
                            <li><a href="">Home</a></li>
                            <li><a href="">Data Pegawai</a></li>
                            <li><a href="{{--{{route('dashboard.contact')}}--}}">Berkas</a></li>
                            <li><a href="{{--{{route('dashboard.contact')}}--}}">Contact</a></li>
                        @endif
                    </ul>
                </div>

                <div class="col-md-3 col-md-push-1">
                    <h4>Contact Information</h4>
                    <ul class="fh5co-footer-links">

                        <li>Jl. Jagir Wonokromo No.104, Jagir, Wonokromo,<br>Surabaya, Jawa Timur, 60244</li>
                        <li>Telp. : <a href="tel://+62318439473">+6231-8497200</a></li>
                        {{--<li>Dian : <a href="tel://+6281939100249">+6281-93910-0249</a></li>--}}
                        {{--<li><a href="mailto:dinkes.surabaya@gmail.com">dinkes.surabaya@gmail.com</a></li>--}}
                    </ul>
                </div>

                <div class="col-md-3 col-md-push-1">
                    <h4>Opening Hours</h4>
                    <ul class="fh5co-footer-links">
                        <li>Mon - Fri: 8 AM - 5 PM</li>
                        <li>Sat - Sun: Closed</li>
                    </ul>
                </div>

            </div>

            <div class="row copyright">
                <div class="col-md-12 text-center">
                    <p>
                        <small class="block">Copyright &copy; 2017 KPP MADYA re:eBerkas. All Rights Reserved.</small>
                        <small class="block">Designed by <a href="http://rabbit-media.net/" target="_blank">Rabbit
                                Media</a>
                            &mdash; System by <a href="https://github.com/vreallyla" target="_blank">Fahmi Rizky</a>
                        </small>
                    </p>
                    <p>
                    <ul class="fh5co-social-icons">
                        <li>
                            <a href="https://www.facebook.com/KPPMadyasurabaya/"><i class="icon-facebook"></i></a>
                        </li>
                        <li><a href="https://twitter.com/Madya631"><i class="icon-twitter"></i></a></li>
                        <li>
                            <a href="https://www.instagram.com/kppmadyasurabaya/"><i class="icon-instagram"></i></a>
                        </li>
                        <li>
                            <a href="https://www.youtube.com/watch?v=kee98xLA_OQ"><i
                                        class="icon-youtube"></i></a>
                        </li>
                    </ul>
                    </p>
                </div>
            </div>

        </div>
    </footer>
</div>

<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-arrow-up"></i></a>
</div>

<!-- jQuery -->
{{--<script src="{{asset('js/jquery.min.js')}}"></script>--}}
<script src="{{asset('dataTables/new/jQuery-3.2.1/jquery-3.2.1.min.js')}}"></script>
<script src="{{asset('datepicker/jquery-ui.js')}}"></script>
<script src="{{asset('datepicker/id.js')}}"></script>
<!-- jQuery Easing -->
<script src="{{asset('js/jquery.easing.1.3.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<script src="{{asset('bootstrap-toggle/js/bootstrap-toggle.js')}}"></script>
<!-- Waypoints -->
<script src="{{asset('js/jquery.waypoints.min.js')}}"></script>
<!-- Stellar Parallax -->
<script src="{{asset('js/jquery.stellar.min.js')}}"></script>
<!-- Carousel -->
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<!-- Flexslider -->
<script src="{{asset('js/jquery.flexslider-min.js')}}"></script>
<!-- countTo -->
<script src="{{asset('js/jquery.countTo.js')}}"></script>
<!-- Magnific Popup -->
<script src="{{asset('js/jquery.magnific-popup.min.js')}}"></script>
<script src="{{asset('js/magnific-popup-options.js')}}"></script>
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCefOgb1ZWqYtj7raVSmN4PL2WkTrc-KyA&sensor=false"></script>
<script src="{{asset('js/google_map.js')}}"></script>
<!-- Main -->
<script src="{{asset('js/main.js')}}"></script>
<script src="{{ asset('dataTables/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('dataTables/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('js/validator.min.js') }}"></script>
<script>
    $(document).ready(function () {
        $('[data-toggle="tooltip"]').tooltip();
    });

    function hanyaAngka(e, decimal) {
        var key;
        var keychar;
        if (window.event) {
            key = window.event.keyCode;
        } else if (e) {
            key = e.which;
        } else return true;
        keychar = String.fromCharCode(key);
        if ((key == null) || (key == 0) || (key == 8) || (key == 9) || (key == 13) || (key == 27)) {
            return true;
        } else if ((("0123456789").indexOf(keychar) > -1)) {
            return true;
        } else if (decimal && (keychar == ".")) {
            return true;
        } else return false;
    }
</script>
<script>
    var title = document.getElementsByTagName("title")[0].innerHTML;
    (function titleScroller(text) {
        document.title = text;
        setTimeout(function () {
            titleScroller(text.substr(1) + text.substr(0, 1));
        }, 500);
    }(title + " ~ "));
</script>
@yield('script')

</body>
</html>

