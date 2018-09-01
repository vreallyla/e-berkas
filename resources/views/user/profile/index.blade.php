@extends('layouts.user.mst_user_relog')
@section('title', 're:eBerkas KPP MADYA | Profil')
@section('nav')
    <li><a href="{{url('home#fh5co-practices')}}">Home</a></li>
    <li class="active"><a href="{{url('profile')}}">Profil</a></li>
    <li><a href="{{url('employes')}}">Daftar Pegawai</a></li>
    <li><a href="{{url('eBerkas')}}">eBerkas</a></li>
@endsection
@section('content')
    <aside id="fh5co-hero" class="js-fullheight">
        <div class="flexslider js-fullheight">
            <ul class="slides">
                <li style="background-image: url({{asset('images/about.jpeg')}});">
                    <div class="overlay-gradient"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 text-center js-fullheight slider-text">
                                <div class="slider-text-inner">
                                    <h1>About Us</h1>
                                    <p class="fh5co-lead">Wanna know more about us? You're in the right place.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </aside>

    <div id="fh5co-content">
        <div class="video fh5co-video" style="background-image: url({{asset('images/22.jpg')}});">
            <a href="https://youtu.be/0-he-Xv4vJ0" class="popup-youtube"><i class="icon-video2"></i></a>
            <div class="overlay"></div>
        </div>
        <div class="choose animate-box">
            <div class="fh5co-heading">
                <h2>Visi </h2>
                <ol>
                    <li>
                        Menjadi institusi pemerintah penghimpunan pajak Negara yang terbaik ditingkat KPP Madya Direktorat Jenderal Pajak.

                    </li>
                </ol>

                <h2>Misi </h2>
                <ol>
                    <li>Menyelenggarakan fungsi administrasi perpajakan dengan menerapkan Undang-Undang Perpajakan secara adil dalam rangka mengamankan target  penerimaan pajak KPP Madya Surabaya.

                    </li>
                </ol>

            </div>
        </div>
    </div>

    <div id="fh5co-about">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <h2>Seksi-Seksi KPP Madya Surabaya</h2>
                    <p>Kantor Pelayanan Pajak Madya Surabaya terdiri dari beberapa seksi, yaitu :</p>
                </div>
            </div>
            <div class="row">
                @for($i=1;$i<count($data);$i++)
                    <div class="col-md-4 col-sm-2 text-center animate-box" data-animate-effect="fadeIn">
                        <div class="fh5co-staff">
                            <h3>{{$data[$i]->name}}</h3>
                            <strong class="role">{{$data[$i]->seksi}}</strong>
                            <p align="justify">
                                {{$data[$i]->desc}}
                            </p>
                        </div>

                    </div>
                @endfor
            </div>
        </div>
    </div>
@endsection