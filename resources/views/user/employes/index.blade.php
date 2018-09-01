@extends('layouts.user.mst_user_relog')
@section('title', 're:eBerkas KPP Madya | Daftar Pegawai')
@section('nav')
    <li><a href="{{url('home')}}">Home</a></li>
    <li><a href="{{url('profile')}}">Profil</a></li>
    <li class="active"><a href="#fh5co-about">Daftar Pegawai</a></li>
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
                                    <h1>Employees</h1>
                                    <p class="fh5co-lead">Wanna know more our's people? You're in the right place.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </aside>

    <div id="fh5co-about">
        <div class="container">
            <div class="row animate-box">
                <div class="col-md-8 col-md-offset-2 text-center fh5co-heading" style="margin-bottom: 3em">
                    <h2><i class="fa fa-history"></i> Daftar Pegawai</h2>
                </div>
            </div>
            <div class="row animate-box">
                <ul class="nav nav-tabs">
                    @foreach(\App\trDataJobDesc::all() as $row)
                        @if($row->name=='Admin')
                            <li class="active"><a data-toggle="tab" href="#{{$row->id}}"
                                                  title="Klik tab untuk melihat {{$row->desc}}">{{$row->name}}</a></li>
                        @else
                            <li><a data-toggle="tab" href="#{{$row->id}}"
                                   title="Klik tab untuk melihat {{$row->desc}}">{{$row->name}}</a></li>
                        @endif
                    @endforeach

                </ul>
                <div class="tab-content" style="margin-top: 1em">
                    @foreach(\App\trDataJobDesc::all() as $row)
                        @if($row->name=='Admin')
                            <div id="{{$row->id}}" class="tab-pane fade in active text-center"><br>
                                @else
                                    <div id="{{$row->id}}" class="tab-pane text-center animate-box"
                                         data-animate-effect="flash"><br>
                                        @endif

                                        <div class="row">
                                            <?php $data = null?>
                                            @foreach($user as $row2)
                                                @if($row2->job_id==$row->id)
                                                    <?php $data = true?>
                                                    <?php $id = $row2->id ?>
                                                    <div class="
                                                     @if(count($user)==1)
                                                            col-md-12 col-sm-12
@elseif(count($user)==2)
                                                            col-md-6 col-sm-6
@elseif(count($user)==3)
                                                            col-md-4 col-sm-4
@elseif(count($user)==4)
                                                            col-md-3 col-sm-3
@elseif(count($user)<=6)
                                                            col-md-4 col-sm-4
@elseif(count($user)<=8)
                                                            col-md-3 col-sm-3
@elseif(count($user)==9)
                                                            col-md-4 col-sm-4
@else
                                                            col-md-3 col-sm-3
@endif
                                                            text-center animate-box"
                                                         data-animate-effect="fadeIn">
                                                        <?php
                                                        $name = $row2->name;
                                                        $cek = strlen($name);
                                                        if ($cek>13){
                                                            $name = substr($name, 0, 13) . '...';
                                                        }
                                                        ?>

                                                        <a href="javascript:void(0)" onclick="showForm({{ $id }})">
                                                            <div class="fh5co-staff">

                                                                <img style="-webkit-filter: grayscale(100%); filter: grayscale(100%);"
                                                                     @if(is_null($row2->ava))
                                                                     src="{{asset('images/avatar.png')}}"
                                                                     alt="{{$name}}">
                                                                @else
                                                                    src="{{asset($row2->ava)}}"
                                                                    alt="{{$name}}
                                                                    ">
                                                                @endif
                                                                <a onclick="showForm({{ $id }})">
                                                                    <h3>{{$name}}</h3></a>
                                                                <a onclick="showForm({{ $id }})"><strong
                                                                            class="role">{{\App\trDataJobDesc::findOrFail($row2->job_id)->name}}</strong></a>
                                                                {{--<p>20th years old student, an Informatics Engineering student in--}}
                                                                {{--UNESA (State--}}
                                                                {{--University--}}
                                                                {{--of--}}
                                                                {{--Surabaya). He plays role as a <em>front-end developer</em>--}}
                                                                {{--since--}}
                                                                {{--2015.</p>--}}
                                                            </div>
                                                        </a>
                                                    </div>

                                                @endif
                                            @endforeach

                                            @if(is_null($data))
                                                <div class="col-md-12 col-sm-12
                                                    text-center animate-box"
                                                     data-animate-effect="fadeIn">
                                                    <div class="fh5co-staff">
                                                        <img style="-webkit-filter: grayscale(100%); filter: grayscale(100%);"

                                                             src="{{asset('images/icons-sad-clipart-9.png')}}"
                                                             alt="Data Empty">

                                                        <h2>Data Kosong</h2>
                                                        <strong class="role">Untuk sekarang belum
                                                            tersedia</strong>

                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    @endforeach
                            </div>
                </div>
            </div>
        </div>
    </div>
    @include('user.employes.form')
@endsection
@section('script')
    <script>
        var trHTML = '';

        function showForm(id) {
            $('#modal-form form')[0].reset();
            $.ajax({
                type: 'get',
                url: '{!!URL::to('employes/caridata/')!!}',
                data: {'id': id},
                success: function (data) {
                    console.log('success');
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Biodata Pegawai');
                    if (!$.trim(data.ava)) {
                        $('#ava').attr('src', '{!!URL::to('images/avatar.png')!!}');
                    }
                    else {
                        $('#ava').attr('src', '{!!URL::to('/')!!}' + '/' + data.ava);
                    }
                    trHTML = '';
                    trHTML += '<tr><td width="100px">NIP</td><td>:</td><td>' + data.nip + '</td></tr>';
                    trHTML += '<tr><td width="60px">Nama</td><td>:&nbsp;</td><td>' + data.name + '</td></tr>';
                    trHTML += '<tr><td width="60px">TTL</td><td>:&nbsp;</td><td>' + data.ttl + '</td></tr>';
                    trHTML += '<tr><td width="60px">Email</td><td>:&nbsp;</td><td><a href="mailto:' + data.email + '">' + data.email + '</a></td></tr>';
                    trHTML += '<tr><td width="60px">Telp</td><td>:&nbsp;</td><td><a href="tel://' + data.phone + '">' + data.phone + '</a></td></tr>';
                    if (!$.trim(data.category)) {
                        trHTML += '<tr><td width="60px">Seksi</td><td>:&nbsp;</td><td>' + data.job.name + '</td></tr>';
                    }
                    else {
                        trHTML += '<tr><td width="60px">Jabatan</td><td>:&nbsp;</td><td>' + data.category.name + ' di ' + data.job.name + '</td></tr>';
                    }
                    if (data.softdel==0) {
                        trHTML += '<tr><td width="60px">Status Akun</td><td>:&nbsp;</td><td>Aktif</td></tr>';
                    }
                    else{
                        trHTML += '<tr><td width="60px">Status Akun</td><td>:&nbsp;</td><td>Nonaktif Sejak '+data.softdel+'</td></tr>';
                    }
                    trHTML += '<tr><td width="60px" valign="top">Deskripsi</td><td valign="top">:&nbsp;</td><td align="justify" >' + data.bio + '</td></tr>';
                    $('#location').empty().append(trHTML);

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
    </script>
@endsection
