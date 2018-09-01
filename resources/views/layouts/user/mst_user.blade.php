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

    <!-- Animate.css -->
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('css/w3.css')}}">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="{{asset('css/icomoon.css')}}">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">

    <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('/sweetalert2/sweetalert2.min.css') }}">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="{{asset('css/magnific-popup.css')}}">

    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <!-- Flexslider  -->
    <link rel="stylesheet" href="{{asset('css/flexslider.css')}}">

    <!-- Theme style  -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

    <!-- Modernizr JS -->
    <script src="{{asset('js/modernizr-2.6.2.min.js')}}"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="{{asset('js/respond.min.js')}}"></script>
    <![endif]-->

</head>
<body>
<script>
    @if(session('success'))
        swal({
        title: '{{ session('success') }}',
        type: 'success',
        timer: '3500'
    });
    @elseif(session('warning'))
        swal({
        title: '{{ session('warning') }}',
        type: 'warning',
        timer: '3500'
    });
    @endif
</script>
<div id="page">
    <nav class="fh5co-nav" role="navigation">
        <div class="top-menu">
            <div class="container">
                <div class="row">
                    <div class="col-xs-1">
                        <div id="fh5co-logo">
                            <a href="{{--{{route('dashboard')}}--}}"><img src="{{asset('images/aaak.jpg')}}"
                                                                          alt="re:eBerkas" width="180%"></a>
                        </div>
                    </div>
                    <div class="col-xs-11 text-right menu-2">
                        <ul>
                            @yield('nav')

                                <li class="has-dropdown">
                                    <a href="#" class="myBtn"><span>{{Auth::user()->name}}</span></a>
                                    <ul class="dropdown">
                                        <li><a href="{{--{{url('/member/history')}}--}}"><i class="fa fa-history"></i> Riwayat
                                                Penambahan Berkas</a></li>
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
                            <a href="{{--{{route('dashboard')}}--}}#fh5co-practice" class="btn btn-default btn-lg">TAMBAH BERKAS
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
                            <li><a href="">Profil</a></li>
                            <li><a href="{{--{{route('dashboard.contact')}}--}}">Data Pegawai</a></li>
                            <li><a href="{{--{{route('dashboard.contact')}}--}}">eBerkas</a></li>
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
<script src="{{asset('js/jquery.min.js')}}"></script>
<!-- jQuery Easing -->
<script src="{{asset('js/jquery.easing.1.3.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
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
</body>
</html>

