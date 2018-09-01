<!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free HTML5 Template by FreeHTML5.co"/>
    <meta name="keywords" content="free html5, free template, free bootstrap, html5, css3, mobile first, responsive"/>
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

    <!-- Place favicon.ico and apple-touch-icon.png in the root directory -->
    <link rel="shortcut icon" href="{{asset('favicon.ico')}}">

    <!-- <link href='https://fonts.googleapis.com/css?family=PT+Sans:400,700,400italic,700italic' rel='stylesheet' type='text/css'>

    <!-- Animate.css -->
    <link rel="stylesheet" href="{{asset('css/animate.css')}}">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="{{asset('css/icomoon.css')}}">
    <!-- Simple Line Icons -->
    <link rel="stylesheet" href="{{asset('css/simple-line-icons.css')}}">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="{{asset('css/bootstrap.css')}}">
    <!-- Owl Carousel  -->
    <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
    <!-- Style -->
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    <link rel="stylesheet" href="{{asset('css/myBtn-myInput.css')}}">
    <link rel="stylesheet" href="{{asset('css/card.css')}}">
    <link rel="stylesheet" href="{{asset('css/carousel.css')}}">
    <link rel="stylesheet" href="{{asset('css/scroll-to-top.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('fonts/fontawesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/font-awesome.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('fonts/fa-brands.min.css')}}">

    <link rel="stylesheet" href="{{asset('css/responsive-list.css')}}">

    <script src="{{ asset('sweetalert2/sweetalert2.min.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('sweetalert2/sweetalert2.min.css') }}">

    <script src="{{ asset('js/modal.js') }}"></script>
    <link rel="stylesheet" href="{{ asset('css/modal.css') }}">

    <!-- Modernizr JS -->
    <script src="{{asset('js/modernizr-2.6.2.min.js')}}"></script>
    <!-- FOR IE9 below -->
    <!--[if lt IE 9]>
    <script src="{{asset('js/respond.min.js')}}"></script>
    <![endif]-->

    <style>
        {{--FAQ custom--}}
        #list-ads {
            text-shadow: -3px 3px 4px #000000;
        }

        #list-ads li {
            color: #fff;
            list-style-image: url({{asset('images/check.png')}});
        }

        {{--FAQ custom--}}
        #faq-a a, #faq-s a {
            color: #555555;
        }

        #faq-nav-tabs > #faq-s.active > a, #faq-nav-tabs > #faq-s.active >
        a:hover, #faq-nav-tabs > #faq-s.active > a:focus {
            color: #FA5555;
        }

        #faq-nav-tabs > #faq-a.active > a, #faq-nav-tabs > #faq-a.active >
        a:hover, #faq-nav-tabs > #faq-a.active > a:focus {
            color: #00ADB5;
        }

        {{--Accordion--}}
        #accordion-2a .panel-heading,
        #accordion-2b .panel-heading,
        #accordion-2c .panel-heading,
        #accordion-2d .panel-heading {
            cursor: pointer;
        }

        {{--Footer download button--}}
        .zoom {
            transition: transform .3s;
        }
        .zoom:hover {
            -ms-transform: scale(1.3); /* IE 9 */
            -webkit-transform: scale(1.3); /* Safari 3-8 */
            transform: scale(1.3);
        }
    </style>
</head>
<body>
<a href="#" onclick="scrollToTop()" title="Go to top"><strong class="to-top" style="color: #fff">TOP</strong></a>

<header role="banner" id="fh5co-header">
    <div class="fluid-container">
        <nav class="navbar navbar-default" id="first-navbar">
            <div class="navbar-header">
                <!-- Mobile Toggle Menu Button -->
                <a href="#" class="js-fh5co-nav-toggle fh5co-nav-toggle" data-toggle="collapse"
                   data-target="#navbar" aria-expanded="false" aria-controls="navbar"><i></i></a>
                <a class="navbar-brand" href="{{--{{route('home-seeker')}}--}}">SISKA</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                @if(\Illuminate\Support\Facades\Request::is('/*'))
                    <div class="col-lg-4 col-md-4 col-sm-12">
                        <form class="navbar-form search-form" role="search">
                            <div id="custom-search-input">
                                <div class="input-group col-md-12">
                                    <div class="input-group-btn dropdown">
                                        <button id="lokasi" type="button" class="btn btn-default dropdown-toggle"
                                                data-toggle="dropdown" aria-expanded="false">
                                           filter&nbsp;<span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu scrollable-menu" id="list-lokasi">
                                            <li data-value="Jakarta"><a href="javascript:void(0)">Jakarta</a></li>
                                            <li data-value="Bandung"><a href="javascript:void(0)">Bandung</a></li>
                                            <li data-value="Surabaya"><a href="javascript:void(0)">Surabaya</a></li>
                                            <li data-value="Sidoarjo"><a href="javascript:void(0)">Sidoarjo</a></li>
                                        </ul>
                                    </div>
                                    <input type="text" class="form-control myInput input-lg"
                                           placeholder="Cari lowongan kerja&hellip;">
                                    <span class="input-group-btn">
                                        <button id="cari" class="btn btn-info btn-lg" type="button">
                                            <i class="glyphicon glyphicon-search"></i>
                                        </button>
                                    </span>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
                <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="#" data-nav-section="home"><span>Home</span></a></li>
                    @if(\Illuminate\Support\Facades\Request::is('/*'))
                        <li><a href="#" data-nav-section="services"><span>Vacancies</span></a></li>
                        <li><a href="#" data-nav-section="explore"><span>Industries</span></a></li>
                        <li><a href="#" data-nav-section="team"><span>Team</span></a></li>
                        <li><a href="#" data-nav-section="blog"><span>Blog</span></a></li>
                        <li><a href="#" data-nav-section="faq"><span>FAQ</span></a></li>
                        <li class="call-to-action">
                            <a id="external" class="sign-up" data-toggle="modal"
                               href="javascript:void(0)" onclick="openRegisterModal();"><span>Sign Up</span></a></li>
                        <li class="call-to-action">
                            <a id="external" class="log-in" href="{{--{{route('home-agency')}}--}}">
                                <span>Job Agency</span></a></li>
                    @elseif(\Illuminate\Support\Facades\Request::is('agency*'))
                        <li><a href="#" data-nav-section="services"><span>Features</span></a></li>
                        <li><a href="#" data-nav-section="pricing"><span>Pricing</span></a></li>
                        <li><a href="#" data-nav-section="faq"><span>FAQ</span></a></li>
                        <li class="call-to-action">
                            <a id="external" class="log-in" data-toggle="modal"
                               href="javascript:void(0)" onclick="openRegisterModal();"><span>Sign Up</span></a></li>
                        <li class="call-to-action">
                            <a id="external" class="sign-up" href="{{--{{route('home-seeker')}}--}}">
                                <span>Job Seeker</span></a></li>
                    @endif
                </ul>
            </div>
        </nav>
    </div>
</header>

{{--modal sign up--}}
<div class="modal fade login" id="loginModal">
    <div class="modal-dialog login animated">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title">Login with</h4>
            </div>
            <div class="modal-body">
                <div class="box">
                    <div class="content">
                        <div class="social">
                            <a class="circle github" href="/auth/github">
                                <i class="fa fa-github fa-fw"></i>
                            </a>
                            <a id="facebook_login" class="circle facebook" href="/auth/facebook">
                                <i class="fa fa-facebook fa-fw"></i>
                            </a>
                            <a class="circle twitter" href="/auth/twitter">
                                <i class="fa fa-twitter fa-fw"></i>
                            </a>
                            <a id="google_login" class="circle google" href="/auth/google_oauth2">
                                <i class="fa fa-google-plus fa-fw"></i>
                            </a>
                        </div>
                        <div class="division">
                            <div class="line l"></div>
                            <span>or</span>
                            <div class="line r"></div>
                        </div>
                        <div class="error"></div>
                        <div class="form loginBox">
                            <form method="post" action="#" accept-charset="UTF-8">
                                <input class="form-control" type="text" placeholder="Email" name="email">
                                <input class="form-control" type="password" placeholder="Password" name="password">
                                <input class="btn btn-default btn-login" type="button" value="SIGN IN" onclick="loginAjax()" style="background: #00ADB5;border-color: #00ADB5">
                            </form>
                        </div>
                    </div>
                </div>
                <div class="box">
                    <div class="content registerBox" style="display:none;">
                        <div class="form">
                            <form method="post" html="{:multipart=>true}" data-remote="true" action="#" accept-charset="UTF-8">
                                <input class="form-control" type="text" placeholder="Email" name="email">
                                <input class="form-control" type="password" placeholder="Password" name="password">
                                <input class="form-control" type="password" placeholder="Repeat Password" name="password_confirmation">
                                <input class="btn btn-default btn-register" type="submit" value="CREATE ACCOUNT" name="commit" style="background: #FA5555;border-color: #FA5555">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div class="forgot login-footer">
                            <span>Looking to
                                 <a href="javascript: showRegisterForm();" style="color: #FA5555;">create an account</a>
                            ?</span>
                </div>
                <div class="forgot register-footer" style="display:none">
                    <span>Already have an account?</span>
                    <a href="javascript: showLoginForm();" style="color: #00ADB5">Sign In</a>
                </div>
            </div>
        </div>
    </div>
</div>

@yield('content')
<section id="fh5co-faq" class="fh5co-bg-color" data-section="faq">
    <div class="fh5co-faq">
        <div class="container">
            <div class="row">
                <div class="col-md-12 section-heading text-center">
                    <h2 class="to-animate"><span>Common Questions</span></h2>
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2 subtext">
                            <h3 class="to-animate">Segala sesuatu yang Anda harus ketahui sebelum menggunakan
                                aplikasi SISKA dan kami disini untuk membantu Anda!</h3>
                        </div>
                        <div class="col-md-12">
                            <ul class="nav nav-tabs" id="faq-nav-tabs">
                                <li class="{{ \Illuminate\Support\Facades\Request::is('/*') ? 'active' : '' }}"
                                    id="faq-s">
                                    <a data-toggle="tab" href="#seeker">
                                        FAQ Job Seeker</a></li>
                                <li class="{{ \Illuminate\Support\Facades\Request::is('agency*') ? 'active' : '' }}"
                                    id="faq-a">
                                    <a data-toggle="tab" href="#agency">
                                        FAQ Job Agency</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="tab-content">
                    <div id="seeker"
                         class="tab-pane fade in {{\Illuminate\Support\Facades\Request::is('/*') ? 'active' : ''}}">
                        <div class="col-md-6">
                            <div class="panel-group" id="accordion-2a">
                                <div class="panel panel-danger">
                                    <div class="panel-heading" data-toggle="collapse" data-parent=".accordion-2a"
                                         href="#a2-a01">
                                        <h4 class="panel-title">Memiliki masalah untuk login?
                                            <i class="fa fa-chevron-down pull-right"></i></h4>
                                    </div>
                                    <div id="a2-a01" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Jangan khawatir, ini terjadi pada semua orang. Jika Anda lupa
                                                password Anda, klik "Lupa?" di atas kotak sign in, kemudian
                                                masukkan alamat email yang Anda gunakan untuk akun SISKA Anda.
                                                Klik "Kirim" dan kami akan mengirimkan password Anda ke email
                                                Anda. Pastikan untuk memeriksa spam mail / junk Anda jika Anda
                                                tidak dapat menemukan email di kotak masuk Anda.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-danger">
                                    <div class="panel-heading" data-toggle="collapse" data-parent=".accordion-2a"
                                         href="#a2-a02">
                                        <h4 class="panel-title">Bagaimana caranya saya untuk mengubah password?
                                            <i class="fa fa-chevron-down pull-right"></i></h4>
                                    </div>
                                    <div id="a2-a02" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Pertama, masuk ke akun SISKA Anda. Pergi ke ikon profil Anda di
                                                bagian kanan atas halaman. Klik "Manage Account" yang berbentuk
                                                seperti simbol gerigi. Isi kolom dan simpang data Anda.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-danger">
                                    <div class="panel-heading" data-toggle="collapse" data-parent=".accordion-2a"
                                         href="#a2-a03">
                                        <h4 class="panel-title">Bagaimana caranya untuk membuat akun SISKA?
                                            <i class="fa fa-chevron-down pull-right"></i></h4>
                                    </div>
                                    <div id="a2-a03" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Pergi ke halaman utama <a href="http://karir.org">SISKA</a> dan
                                                mengisi kolom yang diperlukan dalam kotak sign up dan klik.
                                                Setelah Anda telah mengirimkan informasi, silahkan cek email Anda
                                                untuk mengaktifkan akun Anda. Pastikan untuk memeriksa spam mail
                                                / junk Anda jika Anda tidak dapat menemukan email konfirmasi di
                                                kotak masuk Anda.</p>

                                            <p>Setelah Anda telah mengaktifkan akun Anda , ketika Anda pertama
                                                kali masuk , silahkan mengisi informasi dasar yang diperlukan.
                                                Berikutnya, Anda dapat menulis resume Anda dengan mengisi
                                                kolom-kolom yang tersedia. Menulis resume Anda dengan lengkap
                                                sangat penting untuk meningkatkan kesempatan Anda untuk berkarir.
                                                Pastikan resume Anda lengkap dan selalu diperbarui.</p>

                                            <p>Cukup mencari jenis karir yang Anda inginkan dan pada setiap
                                                posting di <a href="http://karir.org">SISKA</a>, klik tombol
                                                "apply" untuk melamar. Setelah Anda menyelesaikan
                                                langkah-langkah, resume Anda akan dikirim ke Perusahaan. Anda
                                                akan melihat pada deskripsi karir, tombol "apply" akan berubah
                                                menjadi "applied".</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel-group" id="accordion-2b">
                                <div class="panel panel-danger">
                                    <div class="panel-heading" data-toggle="collapse" data-parent=".accordion-2b"
                                         href="#a2-b01">
                                        <h4 class="panel-title">Siapakah yang melihat resume saya?
                                            <i class="fa fa-chevron-down pull-right"></i></h4>
                                    </div>
                                    <div id="a2-b01" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Ketika Anda membuat resume Anda, semua Perusahaan akan dapat
                                                melihat resume Anda secara default. Namun, hanya perusahaan yang
                                                berprospektif sajalah yang bisa melihat kontak informasi Anda.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-danger">
                                    <div class="panel-heading" data-toggle="collapse" data-parent=".accordion-2b"
                                         href="#a2-b02">
                                        <h4 class="panel-title">Mengapa saya tidak mendapat respon
                                            setelah apply secara online?
                                            <i class="fa fa-chevron-down pull-right"></i></h4>
                                    </div>
                                    <div id="a2-b02" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Setiap Perusahaan memiliki metode sendiri untuk mengevaluasi resume.
                                                Beberapa Perusahaan dapat mengirimkan balasan email otomatis atau
                                                menghubungi Anda untuk merespon lamaran Anda. Namun, ada Perusahaan yang
                                                tidak akan menghubungi Anda kecuali mereka ingin memulai proses
                                                wawancara.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-danger">
                                    <div class="panel-heading" data-toggle="collapse" data-parent=".accordion-2b"
                                         href="#a2-b03">
                                        <h4 class="panel-title">Bagaimana caranya agar peluang saya untuk
                                            direkrut lebih besar?
                                            <i class="fa fa-chevron-down pull-right"></i></h4>
                                    </div>
                                    <div id="a2-b03" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Membuat resume yang benar-benar menonjol. Anda ingin menyoroti
                                                pengalaman spesifik dan peran Anda sehingga perusahaan tahu Anda
                                                akan cocok dengan kebutuhan mereka. Menambahkan lebih banyak
                                                pengalaman, pendidikan, sertifikasi dan keterampilan akan sangat
                                                membantu.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div id="agency"
                         class="tab-pane fade in {{\Illuminate\Support\Facades\Request::is('agency*') ? 'active' : ''}}">
                        <div class="col-md-6">
                            <div class="panel-group" id="accordion-2c">
                                <div class="panel panel-info to-animate-2">
                                    <div class="panel-heading" data-toggle="collapse" data-parent=".accordion-2a"
                                         href="#b2-a01">
                                        <h4 class="panel-title">Memiliki masalah untuk login?
                                            <i class="fa fa-chevron-down pull-right"></i>
                                        </h4>
                                    </div>
                                    <div id="b2-a01" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Jangan khawatir, ini terjadi pada semua orang. Jika Anda lupa
                                                password Anda, klik 'Lupa?' di atas kotak sign in, kemudian masukkan
                                                alamat email yang Anda gunakan untuk akun SISKA Anda. Klik 'Kirim'
                                                dan kami akan mengirimkan password Anda ke email Anda. Pastikan
                                                untuk memeriksa spam mail / junk Anda jika Anda tidak dapat
                                                menemukan email di kotak masuk Anda.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-info to-animate-2">
                                    <div class="panel-heading" data-toggle="collapse" data-parent=".accordion-2a"
                                         href="#b2-a02">
                                        <h4 class="panel-title">Bagaimana caranya saya untuk mengirimkan
                                            lowongan pekerjaan? <i class="fa fa-chevron-down pull-right"></i>
                                        </h4>
                                    </div>
                                    <div id="b2-a02" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Pertama, Anda akan perlu untuk mendaftar sebagai Employer. Karena
                                                kami saat ini sedang dalam proses untuk meningkatkan produk dan
                                                layanan kami, Konsultan Bisnis kami akan membantu Anda dalam posting
                                                peluang karir di website kami. Silahkan hubungi <a
                                                        href="tel:+628563094333">+62-85-6309 4333</a> untuk
                                                berbicara dengan Business Consultant kami.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-info to-animate-2">
                                    <div class="panel-heading" data-toggle="collapse" data-parent=".accordion-2b"
                                         href="#b2-a03">
                                        <h4 class="panel-title">Berapa harga untuk mengirimkan lowongan
                                            pekerjaan? <i class="fa fa-chevron-down pull-right"></i>
                                        </h4>
                                    </div>
                                    <div id="b2-a03" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Silahkan hubungi <a href="tel:+628563094333">+62-85-6309 4333</a>
                                                untuk berbicara dengan Business Consultant kami mengenai harga jasa
                                                kami.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel-group" id="accordion-2d">
                                <div class="panel panel-info to-animate-2">
                                    <div class="panel-heading" data-toggle="collapse" data-parent=".accordion-2b"
                                         href="#b2-b01">
                                        <h4 class="panel-title">Bagaimana caranya untuk membayar?
                                            <i class="fa fa-chevron-down pull-right"></i>
                                        </h4>
                                    </div>
                                    <div id="b2-b01" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Anda dapat menghubungi kami untuk mendiskusikan pilihan pembayaran
                                                dan paket produk yang Anda inginkan. Kami tidak menyediakan
                                                pembayaran online tapi dapat beberapa pilihan bagi Anda untuk
                                                melakukan pembayaran dengan mudah dan cepat.</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel panel-info to-animate-2">
                                    <div class="panel-heading" data-toggle="collapse" data-parent=".accordion-2b"
                                         href="#b2-b02">
                                        <h4 class="panel-title">
                                            Bagaimana caranya untuk menaikkan jumlah pelamar pekerjaan?
                                            <i class="fa fa-chevron-down pull-right"></i>
                                        </h4>
                                    </div>
                                    <div id="b2-b02" class="panel-collapse collapse">
                                        <div class="panel-body">
                                            <p>Buatlah deskripsi karir yang menarik. Anda juga dapat
                                                mempertimbangkan untuk memasukkan kisaran gaji sehingga pencari
                                                karir akan lebih tertarik ketika menemukan posting Anda.
                                                Akhirnya, pastikan bahwa deskripsi perusahaan Anda adalah akurat
                                                dan terkini.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<div class="getting-started getting-started-1">
    <div class="getting-grid" style="background-image:  url({{asset('images/ads.jpeg')}});">
        <div class="desc" id="list-ads">
            <h2>Mengapa beriklan di <span>SISKA ?</span></h2>
            <ul>
                <li>Iklan lowongan paling terjangkau.</li>
                <li>Online assessment yang dikembangkan institusi terpercaya.</li>
                <li>Kostumisasi rekrutmen dan program MT di kampus-kampus ternama.</li>
            </ul>
        </div>
    </div>
    <a href="#" class="getting-grid2">
        <div class="call-to-action text-center">
            <p href="#" class="sign-up">Pasang Iklan Sekarang <i class="fa fa-hand-point-right"></i></p>
        </div>
    </a>
</div>

<div id="fh5co-footer" role="contentinfo">
    <div class="container">
        <div class="row">
            <div class="col-md-4 to-animate">
                <h3 class="section-title">Unduh Aplikasi Kami, Gratis!</h3>
                <div class="row">
                    <div class="col-lg-7 to-animate">
                        <img src="{{asset('images/phone.png')}}" style="width: 100%">
                    </div>
                    <div class="col-lg-5 to-animate">
                        <a href="https://play.google.com/store/apps/details?id=com.siska.mobile">
                            <img class="zoom" src="{{asset('images/GooglePlay.png')}}" style="width: 100%">
                            <hr>
                        </a>
                        <a href="https://itunes.apple.com/id/app/siska.com/id1143444473?mt=8">
                            <img class="zoom" src="{{asset('images/AppStore.png')}}" style="width: 100%">
                        </a>
                    </div>
                </div>
                <hr style="margin: 0">
                <p style="margin-top: 0;" class="copy-right">Copyright &copy; 2018 SISKA. All Rights Reserved. <br>
                    Designed by <a href="http://rabbit-media.net/" target="_blank">Rabbit Media</a>.
                </p>
            </div>

            <div class="col-md-4 to-animate">
                <h3 class="section-title">Lokasi Kami</h3>
                <ul class="contact-info">
                    <li><i class="icon-map-marker"></i>Ketintang, Gayungan, Ketintang, Gayungan, Surabaya, Jawa Timur
                        &mdash; 60231
                    </li>
                    <li><i class="icon-phone"></i><a href="tel:+628563094333">+62-85-6309 4333</a></li>
                    <li><i class="icon-envelope"></i><a href="mailto:info@karir.org">info@karir.org</a></li>
                    <li><i class="icon-globe2"></i><a href="htpp://karir.org" target="_blank">www.karir.org</a></li>
                </ul>
                <h3 class="section-title">Hubungkan dengan Kami</h3>
                <ul class="social-media">
                    <li><a href="https://fb.com/siskaku" class="facebook" target="_blank"><i class="icon-facebook"></i></a>
                    </li>
                    <li><a href="https://twitter.com/siskaku" class="twitter" target="_blank"><i
                                    class="icon-twitter"></i></a></li>
                    <li><a href="https://instagram.com/siskaku" class="instagram" target="_blank"><i
                                    class="icon-instagram"></i></a></li>
                    <li><a href="https://github.com/Fq2124/siska" class="github" target="_blank"><i
                                    class="icon-github"></i></a></li>
                </ul>
            </div>
            <div class="col-md-4 to-animate">
                <h3 class="section-title">Tinggalkan Kami Pesan</h3>
                <form class="contact-form" method="post" action="{{--{{route('contact.submit')}}--}}">
                    {{csrf_field()}}
                    <div class="form-group">
                        <label for="name" class="sr-only">Name</label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="Name" required>
                    </div>
                    <div class="form-group">
                        <label for="email" class="sr-only">Email</label>
                        <input name="email" type="email" class="form-control" id="email" placeholder="Email"
                               required>
                    </div>
                    <div class="form-group">
                        <label for="subject" class="sr-only">Subject</label>
                        <input name="subject" type="text" class="form-control" id="subject" placeholder="Subject">
                    </div>
                    <div class="form-group">
                        <label for="message" class="sr-only">Message</label>
                        <textarea name="message" class="form-control" id="message" rows="5" placeholder="Message"
                                  required></textarea>
                    </div>
                    <div class="form-group">
                        <button type="submit" id="btn-submit" class="btn btn-send-message btn-md">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<div id="map" class="fh5co-map"></div>

<!-- jQuery -->
<script src="{{asset('js/jquery-3-1.min.js')}}"></script>
{{--<script src="{{asset('js/jquery.min.js')}}"></script>--}}
<!-- jQuery Easing -->
<script src="{{asset('js/jquery.easing.1.3.js')}}"></script>
<!-- Bootstrap -->
<script src="{{asset('js/bootstrap.min.js')}}"></script>
<!-- Waypoints -->
<script src="{{asset('js/jquery.waypoints.min.js')}}"></script>
<!-- Stellar Parallax -->
<script src="{{asset('js/jquery.stellar.min.js')}}"></script>
<!-- Owl Carousel -->
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<!-- Counters -->
<script src="{{asset('js/jquery.countTo.js')}}"></script>
<!-- Google Map -->
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBIljHbKjgtTrpZhEiHum734tF1tolxI68&sensor=false"></script>
<script src="{{asset('js/google_map.js')}}"></script>
<!-- Main JS (Do not remove) -->
<script src="{{asset('js/main.js')}}"></script>

<script>
    $("#list-lokasi li").click(function(){
        var lokasi = $(this).attr('data-value');
        // var test = document.createElement("span");
        // console.log(test);
        // $(test).addClass("caret");
        $('#lokasi').text(lokasi);
    });

    $('.carousel').carousel();

    var title = document.getElementsByTagName("title")[0].innerHTML;
    (function titleScroller(text) {
        document.title = text;
        setTimeout(function () {
            titleScroller(text.substr(1) + text.substr(0, 1));
        }, 500);
    }(title + " ~ "));

    /*Scroll to top button*/
    window.onscroll = function () {
        scrollFunction()
    };

    function scrollFunction() {
        if ($(this).scrollTop() > 100) {
            $('.to-top').addClass('show-to-top');
        } else {
            $('.to-top').removeClass('show-to-top');
        }
    }

    function scrollToTop(callback) {
        if ($('html').scrollTop()) {
            $('html').animate({scrollTop: 0}, callback);
            return;
        }
        if ($('body').scrollTop()) {
            $('body').animate({scrollTop: 0}, callback);
            return;
        }
        callback();
    }

    /*end:Scroll to top button*/

    $("figure").mouseleave(
        function () {
            $(this).removeClass("hover");
        }
    );

    @if(session('contact'))
    swal({
        title: 'Successfully sent a message!',
        text: '{{ session('contact') }}',
        type: 'success',
        timer: '5500'
    });
    @endif
</script>
</body>
</html>

