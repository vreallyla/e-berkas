@extends('layouts.admin.admin_mst_dashboard')
@section('title', 'eBerkas KPP MADYA | Admin Dashboard')
@section('style')
    <style>

        .avatar-upload {
            position: relative;
            max-width: 100%;
            margin: 10px auto;
        }

        .avatar-upload .avatar-edit {
            position: absolute;
            right: 12px;
            z-index: 1;
            top: 10px;
        }

        .avatar-upload .avatar-edit input {
            display: none;
        }

        .avatar-upload .avatar-edit input + label {
            display: inline-block;
            width: 34px;
            height: 34px;
            margin-bottom: 0;
            border-radius: 100%;
            background: #FFFFFF;
            border: 1px solid transparent;
            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
            cursor: pointer;
            font-weight: normal;
            transition: all 0.2s ease-in-out;
        }

        .avatar-upload .avatar-edit input + label:hover {
            background: #f1f1f1;
            border-color: #d6d6d6;
        }

        .avatar-upload .avatar-edit input + label:after {
            content: "\f040";
            font-family: 'FontAwesome';
            color: #757575;
            position: absolute;
            top: 10px;
            left: 0;
            right: 0;
            text-align: center;
            margin: auto;
        }

        .avatar-upload .avatar-preview {
            width: 100%;
            height: 250px;
            position: relative;

        }

        .avatar-upload .avatar-preview > div {
            width: 100%;
            height: 100%;
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

    </style>
@endsection
@section('sidenav')


    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Navigasi Admin</li>


        <li class="active">
            <a href="{{route('admin.dashboard')}}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </span>
            </a>
        </li>
        <li>
            <a href="{{route('admin.request.index')}}">
                <i class="fa fa-file-text"></i> <span>Permintaan</span>
                </span>
            </a>
        </li>
        <li class="treeview">
            <a href="#">
                <i class="fa fa-table"></i>
                <span>Tabel Pengurus</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li><a href="{{route('admin.table.user')}}"><i class="fa fa-group"></i> Pengguna</a></li>
                <li><a href="{{route('admin.table.letter')}}"><i class="fa fa-envelope"></i>Jenis Surat</a></li>
            </ul>
        </li>
    </ul>
    @endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Dashboard
                <small>Control panel</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li class="active">Dashboard</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-aqua">
                        <div class="inner">
                            <h3 id="change">{{$change}}</h3>

                            <p>Perubahan Jabatan</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-clipboard"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-green">
                        <div class="inner">
                            <h3 id="surat">{{$surat}}{{--<sup style="font-size: 20px">%</sup>--}}</h3>
                            <p>Jumlah Surat</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-ios-email-outline"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-4 col-xs-6">
                    <!-- small box -->
                    <div class="small-box bg-yellow">
                        <div class="inner">
                            <h3 id="pengguna">{{$user}}</h3>

                            <p>Jumlah Pengguna</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-person-add"></i>
                        </div>
                        <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <!-- ./col -->
            </div>
            <!-- /.row -->
            <!-- Main row -->
            <div class="row">
                <!-- center col -->

                {{--<section class="col-lg-12 connectedSortable">--}}
                {{--<!-- solid sales graph -->--}}
                {{----}}
                {{--<!-- /.box -->--}}
                {{--</section>--}}
                {{--<!-- Left col -->--}}


                <section class="col-lg-7 connectedSortable">

                    <div class="box box-info">
                        {{--<button id="perco">dasdasd</button>--}}
                        <div class="box-header with-border">
                            <h3 class="box-title">Presentase Surat</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body border-radius-none">
                            <div class="row" id="presentase">
                                <?php $d = 0; ?>
                                @for($i=2;$i<=count($data);$i++)
                                    <?php $ent = (count($data[$i]) - 1) * 100 / $surat; $d++ ?>
                                    <a href="javascript:void(0)">
                                        <div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4"
                                             id="jumlahdata{{$i-2}}"
                                             data-toggle="tooltip" title="Total Surat : {{(count($data[$i]) - 1)}}">
                                                <input type="text" class="knob"
                                                       data-readonly="true"
                                                       name="persen{{$i-2}}"
                                                       id="persen{{$i-2}}"
                                                       value="{{substr($ent,0,2)}}"
                                                       data-width="80%"
                                                       data-height="80%"
                                                       data-fgColor="#39CCCC">


                                            <div class="knob-label" style="font-size: 20px">{{$data[$i][0]}}</div>
                                            @if($d==3)
                                                <br>
                                                <?php $d = 0; ?>
                                            @endif
                                        </div>
                                    </a>
                                @endfor


                            </div>

                        </div>
                        <!-- /.box-body -->
                        <div class="overlay" id="rekappersen">
                            <img src="{{asset('images/loadingstyle/loadingimg.gif')}}"
                                 style="width: 30%;height: auto; position: absolute; top: 0; bottom:0; left: 0; right:0; margin: auto;">
                        </div>
                    </div>
                    <!-- TABLE: LATEST ORDERS -->
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Permintaan Perubahan Jabatan</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th align="center">Nama</th>
                                        <th align="center">Pergantian</th>
                                        <th align="center">Status</th>
                                        <th align="center">Dibuat</th>
                                    </tr>
                                    </thead>
                                    <tbody id="isipermintaan">
                                    @if (count($gantijob)>0)
                                        @foreach($gantijob as $row)
                                            <?php $list2 = \App\User::findOrFail($row->user_id);
                                            $waktu = \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at);
                                            ?>
                                            <tr>
                                                <td>{{$list2->name}}</td>
                                                <td>
                                                    {{\App\trDataPosisition::findOrFail($list2->posisition_id)->name. ' di ' .\App\trDataJobDesc::findOrFail($list2->job_id)->name}}
                                                    <br>&rarr;
                                                    {{\App\trDataPosisition::findOrFail($row->changeposisition_id)->name. ' di ' .\App\trDataJobDesc::findOrFail($row->changejob_id)->name}}
                                                </td>
                                                <td>
                                                    @if($row->status==0)
                                                        <span class="label label-info" data-toggle="tooltip"
                                                              title="Menunggu Konfirmasi">Menunggu</span>
                                                    @elseif($row->status==1)
                                                        <span class="label label-success" data-toggle="tooltip"
                                                              title="Permintaan telah terkonfirmasi">Terkonfirmasi</span>
                                                    @else
                                                        <span class="label label-danger" data-toggle="tooltip"
                                                              title="Permintaan ditolak">Ditolak</span>

                                                    @endif
                                                </td>
                                                <td><span class="label label-default" data-toggle="tooltip"
                                                          title="{{$waktu->copy()->diffForHumans()}}">
                                                        {{$waktu->copy()->formatLocalized('%d %B %Y')}}
                                                    </span></td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="3" align="center">Data Kosong</td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                        <div class="overlay" id="rekapjabatan">
                            <img src="{{asset('images/loadingstyle/loadingimg.gif')}}"
                                 style="width: 30%;height: auto; position: absolute; top: 0; bottom:0; left: 0; right:0; margin: auto;">
                        </div>
                        <div class="box-footer clearfix">
                            <a href="javascript:void(0)" class="btn btn-sm btn-info btn-flat pull-left">Lihat Semua</a>
                            <a href="{{route('user.update')}}" class="btn btn-sm btn-default btn-flat pull-right">Ajukan Perubahan Jabatan</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!-- /.box -->
                    <!-- DIRECT CHAT -->
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">Surat Terakhir Ditambah</h3>

                            <div class="box-tools pull-right">
                                <span data-toggle="tooltip" title="3 New Messages"
                                      class="badge bg-yellow">{{$surat}}</span>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div class="table-responsive">
                                <table class="table no-margin">
                                    <thead>
                                    <tr>
                                        <th>Kode Surat</th>
                                        <th>Nama Surat</th>
                                        <th>Seksi</th>
                                        <th>Dibuat</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($suratfill6 as $row)
                                        <?php $waktu = \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at); ?>
                                        <tr>
                                            <td><a href="javascript:void(0)" onclick="mstdataShow({{$row->id}})">{{$row->kode}}</a></td>
                                            <td>{{$row->name}}</td>
                                            <td>
                                                <span class="label label-warning">{{\App\trDataJobDesc::findOrFail($row->job_id)->name}}</span>
                                            </td>
                                            <td><span class="label label-default" data-toggle="tooltip"
                                                      title="{{$waktu->copy()->diffForHumans()}}">
                                                        {{$waktu->copy()->formatLocalized('%d %B %Y')}}
                                                    </span></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                        </div>
                        <!-- /.box-body -->
                        <div class="overlay" id="rekapsurat">
                            <img src="{{asset('images/loadingstyle/loadingimg.gif')}}"
                                 style="width: 30%;height: auto; position: absolute; top: 0; bottom:0; left: 0; right:0; margin: auto;">
                        </div>
                        <div class="box-footer text-center">
                            <a href="{{route('eberkas.index')}}" class="uppercase">Buat Berkas Surat Baru</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>


                </section>
                <!-- /.Left col -->
                <!-- right col (We are only adding the ID to make the widgets sortable)-->
                <section class="col-lg-5 connectedSortable">
                    <!-- USERS LIST -->
                    <div class="box box-danger">
                        <div class="box-header with-border">
                            <h3 class="box-title">User Terakhir Ditambah</h3>

                            <div class="box-tools pull-right">
                                <span class="label label-danger"><em id="user1">{{$user}}</em> Pengguna</span>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i>
                                </button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body no-padding">
                            <ul class="users-list clearfix" id="userlist">
                                @foreach($user3 as $row)
                                    <?php $min = \Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at) ?>
                                    @if ($min->copy()->addDays(2)->gte(\Illuminate\Support\Carbon::now()))
                                        <?php $mins = $min->copy()->diffForHumans(); ?>
                                    @elseif ($min->copy()->addDay()->gte(\Illuminate\Support\Carbon::now()))
                                        <?php $mins = 'Kemarin'; ?>
                                    @else
                                        <?php $mins = $min->copy()->formatLocalized('%d %B %Y'); ?>
                                    @endif
                                    <li href="javascript:void(0)" onclick="showForm({{ $row->id }})">
                                        @if(is_null($row->ava))
                                            <a href="javascript:void(0)"><img src="{{asset('images/avatar.png')}}"
                                                                              alt="User Image"
                                                                              style="-webkit-filter: grayscale(100%); filter: grayscale(100%);"></a>
                                        @else
                                            <a href="javascript:void(0)"><img src="{{asset($row->ava)}}"
                                                                              alt="User Image"
                                                                              style="-webkit-filter: grayscale(100%); filter: grayscale(100%);"></a>
                                        @endif
                                        <a class="users-list-name" href="#">{{$row->name}}</a>
                                        <span class="users-list-date">
                                            {{$mins}}
                                        </span>
                                    </li>
                                @endforeach

                            </ul>
                            <!-- /.users-list -->
                        </div>
                        <!-- /.box-body -->
                        <div class="overlay" id="rekapuser">
                            <img src="{{asset('images/loadingstyle/loadingimg.gif')}}"
                                 style="width: 30%;height: auto; position: absolute; top: 0; bottom:0; left: 0; right:0; margin: auto;">
                        </div>
                        <div class="box-footer text-center">
                            <a href="{{route('admin.table.user')}}" class="uppercase">Lihat Semua Pengguna</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                    <!--/.box -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Slide</h3>

                            <div class="box-tools pull-right">
                                <span href="javascript:void(0)" id="slideplus" data-toggle="tooltip"
                                      title="Tambah Slide" class="btn btn-box-tool"><i class="fa fa-edit"></i></span>
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body">
                            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                                <ol class="carousel-indicators" id="nol">
                                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                                    @for($i=1;$i<count($carousel);$i++)
                                        <li data-target="#carousel-example-generic" data-slide-to="{{$i}}"
                                            class=""></li>
                                    @endfor
                                </ol>
                                <div class="carousel-inner" id="isi1">
                                    @for($i=0;$i<count($carousel);$i++)
                                        @if($i>0)
                                            <div class="item">
                                                @else
                                                    <div class="item active">
                                                        @endif
                                                        <img src="{{asset($carousel[$i]['img'])}}"
                                                             alt="{{$carousel[$i]['title']}}">

                                                        <div class="carousel-caption">
                                                            <a href="javascript:void(0)"><span
                                                                        class="label label-primary"
                                                                        data-toggle="tooltip"
                                                                        title="{{$carousel[$i]['desc']}}"
                                                                        onclick="carouselget({{$carousel[$i]['id']}})">
                                                                    {{$carousel[$i]['title']}}</span></a>
                                                        </div>
                                                        @if($i>0)
                                                    </div>
                                                    @else
                                            </div>
                                        @endif
                                    @endfor
                                </div>
                                <a class="left carousel-control" href="#carousel-example-generic"
                                   data-slide="prev">
                                    <span class="fa fa-angle-left"></span>
                                </a>
                                <a class="right carousel-control" href="#carousel-example-generic"
                                   data-slide="next">
                                    <span class="fa fa-angle-right"></span>
                                </a>
                            </div>
                        </div>
                        <!-- /.box-body -->
                        <div class="overlay" id="rekapslide">
                            <img src="{{asset('images/loadingstyle/loadingimg.gif')}}"
                                 style="width: 30%;height: auto; position: absolute; top: 0; bottom:0; left: 0; right:0; margin: auto;">
                        </div>

                        <!-- /.box-footer -->
                    </div>
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Kategori Surat Terakhir Ditambah</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i
                                            class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i
                                            class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" style="">
                            <ul class="products-list product-list-in-box">
                                @foreach($jenis as $row)
                                    <li class="item">
                                        <div class="product-info">
                                            <a href="javascript:void(0)" class="product-title" data-id="{{$row->id}}"
                                               onclick="suratShow(this)">{{$row->name}}</a>
                                            <span class="label label-info pull-right">{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s',$row->created_at)->formatLocalized('%d %B %Y')}}</span>
                                            <span class="product-description">
                          {{\App\trDataJobDesc::findOrFail($row->job_id)->name}}
                        </span>
                                        </div>
                                    </li>
                            @endforeach
                            <!-- /.item -->
                            </ul>
                        </div>
                        <!-- /.box-body -->
                        <div class="overlay" id="rekapkategori">
                            <img src="{{asset('images/loadingstyle/loadingimg.gif')}}"
                                 style="width: 30%;height: auto; position: absolute; top: 0; bottom:0; left: 0; right:0; margin: auto;">
                        </div>
                        <div class="box-footer text-center" style="">
                            <a href="{{url('admin/table/letter')}}" class="uppercase">Lihat Semua Kategori Surat</a>
                        </div>
                        <!-- /.box-footer -->
                    </div>

                </section>
                <!-- right col -->
            </div>
            <!-- /.row (main row) -->

        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
    @include('admin.form')

@endsection

@section('script')
    <script>
        $(document).ready(function () {

            $('.overlay').hide();
            $('#loading1').hide();
            $('.domain-em').hide();
            $(document).on('change', '#modal-form2 #domain', function () {
//                console.log('dasdas');
                if ($('#modal-form2 #domain').prop('checked')) {
                    $('#modal-form2 .domain-em').show();
                    $('#modal-form2 .domain-strike').hide();
                }
                else {
                    $('.domain-em').hide();
                    $('.domain-strike').show();
                }
            });
            $(document).on('change', '#modal-form3 #domainload #domain', function () {
//                console.log('aaaaaa');
                if ($('#modal-form3 #domainload #domain').prop('checked')) {
                    $('#modal-form3 .domain-em').show();
                    $('#modal-form3 .domain-strike').hide();
                }
                else {
                    $('.domain-em').hide();
                    $('.domain-strike').show();
                }
            });
            setInterval(function () {
                getRealData()
            }, 1000);//request every x seconds

            function getRealData() {
                $.ajax({
                    type: 'get',
                    url: '{{route('admin.dataget')}}',
                    success: function (data) {
//                        console.log(data);
                        $('#change').text(data.change);
                        $('#surat').text(data.surat);
                        $('#pengguna').text(data.user);
                        $('#user1').text(data.user);
                        if (data.status1 == 1) {
                            $('#rekapuser').show();
                            $ulang1 = '';
                            for ($i = 0; $i < data.pengguna12.length; $i++) {
                                $ulang1 += '<li href="javascript:void(0)" onclick="showForm(' + data.pengguna12[$i].id + ')">\n' +
                                    '    \n' +
                                    '<a href="javascript:void(0)"><img src="' + data.pengguna12[$i].ava1 + '" alt="User Image" style="-webkit-filter: grayscale(100%); filter: grayscale(100%);"></a>\n' +
                                    '    \n' +
                                    '    <a class="users-list-name" href="javascript:void(0)">' + data.pengguna12[$i].name1 + '</a>\n' +
                                    '    <span class="users-list-date">' + data.pengguna12[$i].tgl + '</span>\n' +
                                    '</li>'
                            }
                            $('#userlist').empty().append($ulang1);
                            $('#rekapuser').hide();

                        }
                        if (data.status2 == 1) {
                            $('#rekapslide').show();
                            $nolcarousel = '';
                            $isicarousel = '';
                            $isicarousel += '<div class="item active">\n' +
                                '<img src="' + data.carousel[0].img + '" alt="' + data.carousel[0].title + '">\n' +
                                '<div class="carousel-caption">' +
                                '<a href="javascript:void(0)">\n' +
                                '    <span class="label label-primary"\n' +
                                '            data-toggle="tooltip"\n' +
                                '            title="' + data.carousel[0].desc + '"\n' +
                                '            onclick="carouselget(' + data.carousel[0].id + ')">\n' + data.carousel[0].title +
                                '    </span>\n' +
                                '</a>' + '</div>\n' +
                                '</div>';
                            for ($b = 1; $b < data.carousel.length; $b++) {
                                $isicarousel += '<div class="item">\n' +
                                    '<img src="' + data.carousel[$b].img + '" alt="' + data.carousel[$b].title + '">\n' +
                                    '<div class="carousel-caption">' + '<a href="javascript:void(0)">\n' +
                                    '    <span class="label label-primary"\n' +
                                    '            data-toggle="tooltip"\n' +
                                    '            title="' + data.carousel[$b].desc + '"\n' +
                                    '            onclick="carouselget(' + data.carousel[$b].id + ')">\n' +
                                    data.carousel[$b].title + '    </span>\n' +
                                    '</a>' + '</div>\n' +
                                    '</div>';
                            }
                            $nolcarousel += '<li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>';
                            for ($i = 1; $i < data.carousel.length; $i++) {
                                $nolcarousel += '<li data-target="#carousel-example-generic" data-slide-to="' + $i + '" class=""></li>';
                            }
                            $('#nol').empty().append($nolcarousel);
                            $('#isi1').empty().append($isicarousel);
                            $('#rekapslide').hide();
                        }

                        for ($i = 0; $i < data.mstdata.length; $i++) {
                            $('#rekappersen').show();
                            if (data.mstdata[$i] == true) {
//                                console.log(data.mstdata2[$i].jumlah);
                                $('#jumlahdata' + $i).attr('data-original-title', 'Jumlah Surat : ' + data.mstdata2[$i].jumlah);
                                for ($b = 0; $b < data.mstdata.length; $b++) {
                                    $('#persen' + $b).val(data.mstdata2[$b].presentase);
                                    $('#persen' + $b).trigger('change');
                                }
                            }
                            $('#rekappersen').hide();
                        }

                        if (data.statusganti == true) {
                            $('#rekapjabatan').show();

                            $td = '';
                            for ($i = 0; $i < data.isiganti.length; $i++) {
                                $td += '<tr>\n';
                                $td += '<td>' + data.isiganti[$i].name + '</td>\n';
                                $td += '<td>'
                                    + data.isiganti[$i].posisition + ' di ' + data.isiganti[$i].job +
                                    '<br>&rarr;' + data.isiganti[$i].changeposisition + ' di ' + data.isiganti[$i].changejob +
                                    '</td>\n';
                                $td += '<td><span class="label label-' + data.isiganti[$i].label + '" data-toggle="tooltip" title="' + data.isiganti[$i].title + '">' + data.isiganti[$i].status + '</span></td>\n';
                                $td += '<td><span class="label label-default" data-toggle="tooltip" title="' + data.isiganti[$i].terlewat + '">\n ' + data.isiganti[$i].waktu + ' </span></td>';
                                $td += '</tr>\n';
                            }
                            $('#isipermintaan').empty().append($td);
                            $('#rekapjabatan').hide();
                        }
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
        $(function () {
            $('#slideplus').on('click', function (e) {
                $('#modal-form2 form')[0].reset();
                $('#modal-form2').modal('show');
            });
        });
        $(function () {
            $('#klik2').on('click', function (e) {
                $('#modal-form3 #loading1').hide();
                $('#modal-form3 #klik1').show();
                $('#modal-form3 #klik2').hide();
                $('#modal-form3 #klik3').hide();
                $('#modal-form3 .content1').prop('disabled', false);
                $('#modal-form3 #editimgca').show();
                $('#modal-form3 .modal-title').text('Edit Slide');
                $('#modal-form3 #domainload').show();

            });
        });

        function suratShow(id) {
            $("div#divLoading").addClass('show');
            $.ajax({
                type: 'get',
                url: '{{route('admin.suratshow')}}',
                data: {'id': $(id).data("id")},
                success: function (data) {
//                    console.log(data);
                    $('#modal-form4 #id').val(data.id);
                    $('#modal-form4 .modal-title').text('Detail Kategori Surat');
                    $('#modal-form4 #desc').val(data.desc);
                    $('#modal-form4 #name').val(data.name);
                    $('#modal-form4 #singkatan').val(data.singkatan);
                    $('#modal-form4 #user_id').val(data.user);
                    $('#modal-form4 #job_id').val(data.job);
                    $('#modal-form4').modal('show');

                    $("div#divLoading").addClass('hide');
                },
                error: function () {
                    $("div#divLoading").addClass('hide');
                    swal({
                        title: 'Oops...',
                        text: 'something wrong!',
                        type: 'error',
                        timer: '1500'
                    })
                }
            });

        }

        function showForm(id) {
            $("div#divLoading").addClass('show');
            $('#modal-form form')[0].reset();
            $('#modal-form #fill').empty();
            $.ajax({
                type: 'get',
                url: '{!!URL::to('employes/caridata/')!!}',
                data: {'id': id},
                success: function (data) {
                    $('#modal-form').modal('show');
                    $('.modal-title').text('Biodata Pegawai');
                    if (!$.trim(data.ava)) {
                        $('#ava').attr('src', '{!!URL::to('images/avatar.png')!!}');
                    }
                    else {
                        $('#ava').attr('src', '{!!URL::to('/')!!}' + '/' + data.ava);
                    }
                    trHTML = '';
                    trHTML += '<tr><td width="50px">NIP</td><td>:</td><td>' + data.nip + '</td></tr>';
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
                    trHTML += '<tr><td width="60px" valign="top">Deskripsi</td><td valign="top">:&nbsp;</td><td align="justify" >' + data.bio + '</td></tr>';
                    $('#location').empty().append(trHTML);
                    $("div#divLoading").addClass('hide');
                },
                error: function () {
                    $("div#divLoading").addClass('hide');
                    swal({
                        title: 'Oops...',
                        text: 'something wrong!',
                        type: 'error',
                        timer: '1500'
                    })
                }
            });

        }
        function mstdataShow(id) {
//            console.log(id);
            //            $("div#divLoading").addClass('show');
//            $('#modal-form form')[0].reset();
//            $('#modal-form #fill').empty();
            $.ajax({
                type: 'get',
                url: '{{route('admin.mstdatashow')}}',
                data: {'id': id},
                success: function (data) {
//                    console.log(data);
//                    console.log(data.name);
                    $('#modal-form5').modal('show');
                    $('#modal-form5 .modal-title').text('Detail Surat');
                    $('#modal-form5 #name').val(data.name);
                    $('#modal-form5 #kode').val(data.kode);
                    $('#modal-form5 #kode').val(data.kode);
                    $('#modal-form5 #category_id').val(data.category_id);
                    $('#modal-form5 #user_id').val(data.user_id);
                    $('#modal-form5 #category_id').val(data.category_id);
                    $('#modal-form5 #job_id').val(data.job_id);
                    $('#modal-form5 #created_at').val(data.created_at);
                    $('#modal-form5 #desc').text(data.desc);

                    $("div#divLoading").addClass('hide');
                },
                error: function () {
                    $("div#divLoading").addClass('hide');
                    swal({
                        title: 'Oops...',
                        text: 'something wrong!',
                        type: 'error',
                        timer: '1500'
                    })
                }
            });
        }
        function deleteSlide(id) {
            swal({
                title: 'Hapus Data?',
                text: "Data Akan Hilang!",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ya!'
            }).
            then(function (isConfirm) {
                if (!$.trim(isConfirm.dismiss)) {
                    $("div#divLoading").addClass('show');
//                    $(':button[type="submit"]').prop('disabled', true);
                    $('#modal-form3').modal('hide');
//                    console.log($(id).data("id"));
                    $.ajax({
                        url: "{{route('admin.carouseldelete')}}",
                        type: "GET",
                        data: {'id': $(id).data("id")},
                        success: function (data) {
                            $("div#divLoading").addClass('hide');
                            swal({
                                title: 'Data Terhapus!',
                                text: 'Data Dipindahkan ke Sampah!',
                                type: 'success',
                                timer: '1500'
                            })
                        },
                        error: function () {
                            $("div#divLoading").addClass('hide');
                            alert("Nothing Data");
                        }
                    });

                }
                return false;

            })

        }

        function carouselget(id) {
            $("div#divLoading").addClass('show');
            $.ajax({
                type: 'get',
                url: '{{route('admin.carouselget')}}',
                data: {'id': id},
                success: function (data) {
                    $('#modal-form3 form')[0].reset();
                    $('#modal-form3 .modal-title').text('Detail Slide');
                    if (data.domain == 0) {
                        $('#modal-form3 #domain').prop("checked", true);
                        $('.domain-em').show();
                        $('.domain-strike').hide();
                    }
                    else {
                        $('#modal-form3 #domain').prop("checked", false);
                        $('.domain-em').hide();
                        $('.domain-strike').show();
                    }
                    $('#modal-form3 #domainload').hide();
                    $('#modal-form3 #klik1').hide();
                    $('#modal-form3 #klik2').show();
                    $('#modal-form3 #klik3').show();
                    $('#modal-form3 #domainload').hide();
                    $('#modal-form3 #title').val(data.title);
                    $('#modal-form3 #button').val(data.button);
                    $('#modal-form3 #url').val(data.url);
                    $('#modal-form3 #id').val(data.id);
                    $('#modal-form3 #klik3').data("id",data.id);
                    $('#modal-form3 #desc').text(data.desc);
                    $('#modal-form3 .content1').prop('disabled', true);
                    $('#modal-form3 #editimgca').hide();
                    $('#modal-form3 #imagePreview').css('background-image', 'url(' + data.img + ')');
                    $("div#divLoading").addClass('hide');
                    $('#modal-form3').modal('show');


                },
                error: function () {
                    $("div#divLoading").addClass('hide');
                    swal({
                        title: 'Oops...',
                        text: 'something wrong!',
                        type: 'error',
                        timer: '1500'
                    })
                }
            });

        }

        $(function () {
            $('#perco').on('click', function (e) {
                $a = 20.6;
//                console.log($a);
                $('#persen2').val($a);
                $('#persen2').trigger('change');
//        $('#persen2').data('readonly', true);
            });
        });

        $(function () {
            $('#modal-form2 form').on('submit', function (e) {
                if (!e.isDefaultPrevented()) {
                    $('#berubah').hide();
                    $('#loading1').show();
                    $(':button').prop('readonly', true);
                    $('#modal-form2 :input').prop('readonly', true);
                    $('#modal-form2 #desc').prop('readonly', true);


                    $.ajax({
                        url: "{{route('admin.carouseladd')}}",
                        type: "post",
                        data: new FormData($('#modal-form2 form')[0]),
                        contentType: false,
                        processData: false,
                        success: function (data) {

                            $('#modal-form2 form')[0].reset();
                            $(':button').prop('readonly', false);
                            $('#modal-form2 :input').prop('readonly', false);
                            $('#modal-form2 #desc').prop('readonly', false);
                            $('#loading1').hide();
                            $('#berubah').show();
                            $('#modal-form2').modal('hide');

                            swal({
                                title: 'Berhasil!',
                                text: 'Data Slide Berhasil Dibuat!',
                                type: 'success',
                                timer: '1500'
                            })
                        },
                        error: function () {
                            $('#loading1').hide();
                            $('#berubah').show();
                            $(':input[type="submit"]').prop('disabled', false);
                            swal({
                                title: 'Oops...',
                                text: 'Something went wrong!',
                                type: 'error',
                                timer: '1500'
                            })
                        }
                    });

                    return false;
                }
            });
        });
        $(function () {
            $('#modal-form3 form').on('submit', function (e) {
                if (!e.isDefaultPrevented()) {
                    $('#modal-form3 #berubah').hide();
                    $('#modal-form3 #loading1').show();
                    $('#modal-form3 :button').prop('readonly', true);
                    $('#modal-form3 :input').prop('readonly', true);
                    $('#modal-form3 #desc').prop('readonly', true);


                    $.ajax({
                        url: "{{route('admin.carouseledit')}}",
                        type: "post",
                        data: new FormData($('#modal-form3 form')[0]),
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            console.log(data);
                            $('#modal-form3 #berubah').show();
                            $('#modal-form3 #loading1').hide();
                            $('#modal-form3 :button').prop('readonly', false);
                            $('#modal-form3 :input').prop('readonly', false);
                            $('#modal-form3 #desc').prop('readonly', false);
                            $('#modal-form3').modal('hide');

                            swal({
                                title: 'Berhasil!',
                                text: 'Data Slide Berhasil Dirubah!',
                                type: 'success',
                                timer: '1500'
                            })
                        },
                        error: function () {
                            $('#modal-form3 #berubah').show();
                            $('#modal-form3 #loading1').hide();
                            $('#modal-form3 :button').prop('readonly', false);
                            $('#modal-form3 :input').prop('readonly', false);
                            $('#modal-form3 #desc').prop('readonly', false);
                            swal({
                                title: 'Oops...',
                                text: 'Something went wrong!',
                                type: 'error',
                                timer: '1500'
                            })
                        }
                    });

                    return false;
                }
            });
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                    $('#imagePreview').css('background-image', 'url(' + e.target.result + ')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        $("#imageUpload").change(function () {
            readURL(this);
        });

    </script>
@endsection
