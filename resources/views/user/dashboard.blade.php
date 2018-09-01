@extends('layouts.user.mst_user_relog')
@section('title', 're:eBerkas KPP MADYA | Home')
@section('nav')
    <li class="active"><a href="{{url('home#fh5co-practices')}}">Home</a></li>
    <li><a href="{{url('profile')}}">Profil</a></li>
    <li><a href="{{url('employes')}}">Daftar Pegawai</a></li>
    <li><a href="{{url('eBerkas')}}">eBerkas</a></li>
@endsection
@section('content')
    <div class="fh5co-loader"></div>

    <aside id="fh5co-hero" class="js-fullheight">
        <div class="flexslider js-fullheight">
            <ul class="slides" id="listslide">
                @foreach($carousel as $row)
                    <li style="background-image: url({{asset($row['img'])}});">
                        <div class="overlay-gradient"></div>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-8 col-md-offset-2 text-center js-fullheight slider-text">
                                    <div class="slider-text-inner">
                                        <h1>{{$row['title']}} </h1>
                                        <h2>{{$row['desc']}}</h2>
                                        <p><a class="btn btn-primary btn-lg"
                                              href="{{$row['url']}}">
                                                {{$row['button']}}</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                @endforeach
            </ul>
        </div>
    </aside>

    <div id="fh5co-counter" class="fh5co-counters fh5co-bg-section">
        <div class="container">
            <div id="fh5co-practices">
                <div class="row animate-box">
                    <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                        <h2>Jumlah Berkas Surat Terupload</h2>
                    </div>
                </div>

                <div class="row" id="data8">
                    @foreach($jobdesc as $row)
                        @if($row->name=='Admin')
                        @else
                            <div class="col-md-4 text-center animate-box" data-toggle="tooltip" title="{{$row->desc}}">
                        <span class="icon"><i><img width="50%" style="margin: 0 auto;color:#0d3625  "
                                                   src="{{asset($row->icon)}}" alt="" class="img-responsive"></i></span>
                                <?php $data = 0?>
                                @foreach($jumlah as $row3)
                                    @if($row->id == $row3->job_id)
                                        <?php $data = $data + 1 ?>
                                    @endif
                                @endforeach
                                <span class="fh5co-counter js-counter" data-from="0" data-to="{{$data}}"
                                      data-speed="3000"
                                      data-refresh-interval="50"></span>
                                <span class="fh5co-counter-label">{{$row->name}}</span>
                            </div>
                        @endif
                    @endforeach

                </div>
            </div>
        </div>
    </div>

    <div id="fh5co-practice" class="fh5co-bg-section">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                    <h2>re:eBerkas</h2>
                    <p> re:eBerkas merupakan pengarsipan data melalui media online, yang menyediakan Daftar Pegawai dan
                        pengarsipan surat </p>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 text-center animate-box">
                    <a href="{{url('eBerkas#fh5co-eberkas')}}">
                        <div class="services">
                            <span class="icon">
                                <i class="fa fa-send-o"></i>
                            </span>
                            <div class="desc">
                                <h3><a href="{{url('eBerkas#fh5co-eberkas')}}">eBerkas</a></h3>
                                <p>Apakah Anda ingin mengajukan permohonan Surat Izin Apotek?
                                    Kami {{config('app.name')}} akan membantu dan memudahkan Anda untuk mendapatkan
                                    surat izin tersebut.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 text-center animate-box">
                    <a href="{{url('employes#fh5co-about')}}">
                        <div class="services">
                            <span class="icon">
                                <i class="fa fa-users"></i>
                            </span>
                            <div class="desc">
                                <h3><a href="{{url('employes#fh5co-about')}}">Daftar Pegawai</a></h3>
                                <p>Apakah Anda ingin mengajukan perizinan Penyelenggaraan Depo Air Minum?
                                    Kami {{config('app.name')}} akan membantu dan memudahkan Anda untuk mendapatkan
                                    surat
                                    izin tersebut.</p>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-4 text-center animate-box">
                    <a href="{{--{{route('hama.dashboard')}}--}}">
                        <div class="services">
                            <span class="icon">
                                <i class="fa fa-building"></i>
                            </span>
                            <div class="desc">
                                <h3><a href="{{--{{route('hama.dashboard')}}--}}">Profile</a></h3>
                                <p>Apakah Anda ingin mengajukan perizinan Perusahaan Pengendalian Hama?
                                    Kami {{config('app.name')}} akan membantu dan memudahkan Anda untuk mendapatkan
                                    surat
                                    izin tersebut.</p>
                            </div>
                        </div>
                    </a>
                </div>
                {{--<div class="col-md-12 text-center animate-box">
                    <p><a class="btn btn-primary btn-lg btn-learn" href="#">View More</a></p>
                </div>--}}
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            setInterval(function () {
                getRealData()
            }, 1000);//request every x seconds

            function getRealData() {
                $.ajax({
                    type: 'get',
                    url: '{{route('get')}}',
                    success: function (data) {
                        if (data.status == 1) {
                            $taruh = '';
                            for ($i = 0; $i < (data.mstdata.length); $i++) {
                                $taruh += '<div class="col-md-4 text-center" data-toggle="tooltip" title="' + data.mstdata[$i].desc + '">\n' +
                                    '<span class="icon"><i><img width="50%" style="margin: 0 auto;color:#0d3625" src="' + data.mstdata[$i].icon + '" alt="darto"\n' +
                                    'class="img-responsive"></i></span>\n' +
                                    '\n' +
                                    '    <span class="fh5co-counter">'+ data.mstdata[$i].jumlah +'</span>\n' +
                                    '    <span class="fh5co-counter-label">'+ data.mstdata[$i].name +'</span>\n' +
                                    '</div>';
                            }
                            $('#data8').empty().append($taruh);
                        }
//                        if (data.status2 == 1) {
//                            console.log(data);
//                            $taruh2 = '';
//                            for ($i = 0; $i < (data.carousel2.length); $i++) {
//                                $taruh2 += '<li style="background-image: url('+data.carousel2[$i].img+');">\n' +
//                                    '    <div class="overlay-gradient"></div>\n' +
//                                    '    <div class="container">\n' +
//                                    '        <div class="row">\n' +
//                                    '            <div class="col-md-8 col-md-offset-2 text-center js-fullheight slider-text">\n' +
//                                    '                <div class="slider-text-inner">\n' +
//                                    '                    <h1>'+data.carousel2[$i].title+'</h1>\n' +
//                                    '                    <h2>'+data.carousel2[$i].desc+'</h2>\n' +
//                                    '                    <p><a class="btn btn-primary btn-lg"\n' +
//                                    '                          href="'+data.carousel2[$i].url+'">\n' +
//                                    data.carousel2[$i].button+'</a></p>\n' +
//                                    '                </div>\n' +
//                                    '            </div>\n' +
//                                    '        </div>\n' +
//                                    '    </div>\n' +
//                                    '</li>\n';
//                            }
//                            console.log($taruh2);
//                            $('#listslide').empty().append($taruh2);
//                        }

                    },
                    error: function () {
                        swal({
                            title: 'Oops...',
                            text: 'something wrong!',
                            type: 'error',
                            timer: '1500'
                        })
                    }
                });

            }
        });
    </script>

@endsection