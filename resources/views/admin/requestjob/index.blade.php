@extends('layouts.admin.admin_mst_dashboard')
@section('title', 'eBerkas KPP MADYA | Admin Dashboard')
@section('style')
    <style>
        tr:hover {
            background-color: #dedfe0;
        }
        .pagination {
            background: #f2f2f2;
            padding: 20px;
            margin-bottom: 20px;
        }

        .page {
            display: inline-block;
            padding: 0px 9px;
            margin-right: 4px;
            border-radius: 3px;
            border: solid 1px #c0c0c0;
            background: #e9e9e9;
            box-shadow: inset 0px 1px 0px rgba(255, 255, 255, .8), 0px 1px 3px rgba(0, 0, 0, .1);
            font-size: .875em;
            font-weight: bold;
            text-decoration: none;
            color: #717171;
            text-shadow: 0px 1px 0px rgba(255, 255, 255, 1);
        }

        .page:hover, .page.gradient:hover {
            background: #fefefe;
            background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#FEFEFE), to(#f0f0f0));
            background: -moz-linear-gradient(0% 0% 270deg, #FEFEFE, #f0f0f0);
        }

        .page.active {
            border: none;
            background: #616161;
            box-shadow: inset 0px 0px 8px rgba(0, 0, 0, .5), 0px 1px 0px rgba(255, 255, 255, .8);
            color: #f0f0f0;
            text-shadow: 0px 0px 3px rgba(0, 0, 0, .5);
        }

        .page.gradient {
            background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#f8f8f8), to(#e9e9e9));
            background: -moz-linear-gradient(0% 0% 270deg, #f8f8f8, #e9e9e9);
        }

        .pagination.dark {
            background: #414449;
            color: #feffff;
        }

        .page.dark {
            border: solid 1px #32373b;
            background: #3e4347;
            box-shadow: inset 0px 1px 1px rgba(255, 255, 255, .1), 0px 1px 3px rgba(0, 0, 0, .1);
            color: #feffff;
            text-shadow: 0px 1px 0px rgba(0, 0, 0, .5);
        }

        .page.dark:hover, .page.dark.gradient:hover {
            background: #3d4f5d;
            background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#547085), to(#3d4f5d));
            background: -moz-linear-gradient(0% 0% 270deg, #547085, #3d4f5d);
        }

        .page.dark.active {
            border: none;
            background: #2f3237;
            box-shadow: inset 0px 0px 8px rgba(0, 0, 0, .5), 0px 1px 0px rgba(255, 255, 255, .1);
        }

        .page.dark.gradient {
            background: -webkit-gradient(linear, 0% 0%, 0% 100%, from(#565b5f), to(#3e4347));
            background: -moz-linear-gradient(0% 0% 270deg, #565b5f, #3e4347);
        }
    </style>
@endsection
@section('sidenav')


    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Navigasi Admin</li>


        <li>
            <a href="{{route('admin.dashboard')}}">
                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </span>
            </a>
        </li>
        <li class="active">
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
    <script>
        var $jobId = [], $typejob = {}, prefix = 'request', prefix2 = 'pagination', $cek0 = [],$search='';
        var $select = 0;
        @foreach($jobType as $row)
        $jobId.push('{{$row->id}}');
        @endforeach
        $jobId.push('0');
        $typejob[prefix2 + '0'] = [];
        @for ($i=1;$i<=$entityPage;$i++)
            $typejob[prefix2 + '0'].push({{$i}});
        @endfor
    </script>
    <div class="content-wrapper">
        <section class="content-header">
            <h1>
                Permintaan Perubahan
                <small class="change">Semua Seksi</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="{{route('admin.dashboard')}}"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Permintaan</a></li>
                <li class="active change">Semua Seksi</li>
            </ol>
        </section>
        <section class="content">

            <div class="row">
                <div class="col-xs-12">
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Tabel Permintaan &nbsp;</h3>
                            {{--<div style="padding-left: 10px">--}}
                            <button class="btn btn-primary acceptall" data-toggle="tooltip" title="Pilih data terlebih dahulu">Terima</button>
                            <button class="btn btn-default denyall" data-toggle="tooltip" title="Pilih data terlebih dahulu">Tolak</button>
                            {{--</div>--}}

                            <div class="box-tools pull-right" style="margin: 5px">

                                <div class="input-group input-group-sm" style="width: 200px;">

                                    {{--<select type="checkbox" class="input-group-addon form-control" name="entityPage" id="entityPage">--}}
                                    {{--<option value="10">10 Data</option>--}}
                                    {{--<option value="20">20 Data</option>--}}
                                    {{--<option value="50">50 Data</option>--}}
                                    {{--<option value="100">100 Data</option>--}}

                                    {{--</select>--}}
                                    <input type="text" name="table_search" id="table_search"
                                           class="form-control pull-right"
                                           placeholder="Search">

                                    <div class="input-group-btn">
                                        <button type="submit" class="btn btn-default" id="searchBtn"><i class="fa fa-search"></i>
                                            <i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw" style="display: none"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.box-header -->
                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#request0" data-change="Semua Seksi"
                                                  data-id="0" onclick="changeTitle(this)"
                                                  title="Klik tab untuk menambahkan data berkas surat">Semua</a>
                            @foreach($jobType as $row)
                                <li><a data-toggle="tab" href="#request{{$row->id}}"
                                       data-change="{{$row->name}}" data-id="{{$row->id}}"
                                       onclick="changeTitle(this)"
                                       title="Klik tab untuk melihat {{$row->name}}">{{$row->name}}</a>
                                </li>
                            @endforeach

                        </ul>
                        <div class="tab-content">
                            <div id="request0" class="tab-pane fade in active text-center"><br>
                                <div class="box-body">

                                    <div class="table-responsive">
                                        <table class="table no-margin">
                                            <thead>
                                            <tr>
                                                <th style="width:40px ; text-align: center">#</th>
                                                <th style="text-align: center">Pengirim</th>
                                                <th style="text-align: center">Seksi</th>
                                                <th style="text-align: center">Perubahan</th>
                                                <th style="text-align: center">Dibuat</th>
                                                <th style="text-align: center"></th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($contentPage as $row)
                                                <tr data-id="{{$row->id}}">
                                                    <td style="width: 30px"><input type="checkbox"
                                                                                   class="cek @if($row->status==0)wait @elseif($row->status==1)accept @else deny @endif"
                                                                                   data-action="{{$row->status}}"
                                                                                   name="cek{{$row->id}}"
                                                                                   id="cek{{$row->id}}"
                                                                                   value="{{$row->id}}">
                                                    </td>
                                                    <td>{{$row->user->name}}</td>
                                                    <td>{{$row->oldposisition->name.' di '.$row->oldjob->name}}</td>
                                                    <td>{{$row->posisition->name.' di '.$row->job->name}}</td>
                                                    <td>
                                                        {{\Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $row->created_at)->formatLocalized('%A, %d %B %Y')}}
                                                    </td>
                                                    <td style="text-align: left" id="action{{$row->id}}">
                                                        <div class="input-group-btn">
                                                            @if($row->status==0)
                                                                <button type="button"
                                                                        class="btn btn-info dropdown-toggle"
                                                                        data-toggle="dropdown">Menunggu
                                                                    <span class="fa fa-caret-down"></span></button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="#" class="terima">Terima</a></li>
                                                                    <li><a href="#" class="tolak">Tolak</a></li>
                                                                </ul>
                                                            @elseif($row->status==1)
                                                                <button type="button"
                                                                        class="btn btn-success dropdown-toggle"
                                                                        data-toggle="dropdown">Diterima
                                                                    <span class="fa fa-caret-down"></span></button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="#" class="tolak">Tolak</a></li>
                                                                </ul>
                                                            @else
                                                                <button type="button"
                                                                        class="btn btn-danger dropdown-toggle"
                                                                        data-toggle="dropdown">Ditolak
                                                                    <span class="fa fa-caret-down"></span></button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a href="#" class="terima">Terima</a></li>
                                                                </ul>
                                                            @endif
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                    <!-- /.table-responsive -->
                                </div>

                            </div>
                            @foreach($jobType as $row)
                                <div id="request{{$row->id}}" class="tab-pane fade in text-center"><br>
                                    <div class="box-body">
                                        <div class="table-responsive">
                                            <table class="table no-margin">
                                                <thead>
                                                <tr>
                                                    <th style="width:40px ; text-align: center">#</th>
                                                    <th style="text-align: center">Pengirim</th>
                                                    <th style="text-align: center">Seksi</th>
                                                    <th style="text-align: center">Perubahan</th>
                                                    <th style="text-align: center">Dibuat</th>
                                                    <th style="text-align: center"></th>
                                                </tr>

                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td><a href="pages/examples/invoice.html">OR9842</a></td>
                                                    <td>Call of Duty IV</td>
                                                    <td><span class="label label-success">Shipped</span></td>
                                                    <td>
                                                        <div class="sparkbar" data-color="#00a65a" data-height="20">
                                                            <canvas width="34" height="20"
                                                                    style="display: inline-block; width: 34px; height: 20px; vertical-align: top;"></canvas>
                                                        </div>
                                                    </td>
                                                </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                        <!-- /.table-responsive -->
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- /.box-body -->
                        <div class="overlay" id="load">
                            <img src="{{asset('images/loadingstyle/loadingimg.gif')}}"
                                 style="width: 30%;height: auto; position: absolute; top: 0; bottom:0; left: 0; right:0; margin: auto;">
                        </div>
                        <div class="box-footer clearfix">
                            <center>
                                <div data-id="0" class="pagination0">
                                    <button href="javascript:void(0)" data-action="{{$entityPage}}"
                                            class="pagiPrevious btn page gradient"><span
                                                class="fa fa-caret-left"></span></button>
                                    <button href="javascript:void(0)" data-action="1" class="pagi1 btn page active"
                                            disabled="true">1
                                    </button>
                                    @if($statusPage==true)
                                        @for($i=2;$i<6;$i++)
                                            <button href="javascript:void(0)" data-action="{{$i}}"
                                                    class="pagi{{$i}} btn page gradient">{{$i}}</button>
                                        @endfor
                                        <button href="javascript:void(0)" data-action="6"
                                                class="pagiVar2 btn page gradient">..
                                        </button>
                                        <button href="javascript:void(0)" data-action="{{$entityPage}}"
                                                class="pagiLast btn page gradient">{{$entityPage}}</button>
                                    @else
                                        @for($i=2;$i<=$entityPage;$i++)
                                            <button href="javascript:void(0)" data-action="{{$i}}"
                                                    class="pagi{{$i}} btn page gradient">{{$i}}</button>
                                        @endfor
                                    @endif
                                    <button href="javascript:void(0)" data-action="2"
                                            class="pagiNext btn page gradient"><span class="fa fa-caret-right"></span>
                                    </button>
                                </div>
                                @foreach($jobType as $row)
                                    <div data-id="{{$row->id}}" class="pagination{{$row->id}}">
                                    </div>
                                @endforeach
                            </center>
                        </div>
                        <!-- /.box-footer -->
                    </div>
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
    </div>
@endsection

@section('script')
    <script>

        $(document).ready(function () {
            $('#load').hide();
            $jobId.forEach(function (index) {
                $('#request' + index).on('click', '.cek', function (asd) {
                    if ($cek0 == '') {
                        if ($(this).data('action') == 0) {
                            $('#request' + index + ' table tbody .deny').prop('disabled', true);
                            $('#request' + index + ' table tbody .accept').prop('disabled', true);
                        }
                        else if ($(this).data('action') == 1) {
                            console.log('1');
                            $('#request' + index + ' table tbody .deny').prop('disabled', true);
                            $('#request' + index + ' table tbody .wait').prop('disabled', true);
                            $('.acceptall').prop('disabled', true);


                        }
                        else {
                            $('#request' + index + ' table tbody .accept').prop('disabled', true);
                            $('#request' + index + ' table tbody .wait').prop('disabled', true);
                            $('.denyall').prop('disabled', true);

                        }
                    }
                    if ($(this).is(":checked")) {
                        $cek0.push($(this).val());
                        $(this).parents('tr').css('background-color', '#c8cace');
                    }
                    else {
                        $arraydelete = $cek0.indexOf($(this).val());
                        $cek0.splice($arraydelete, 1);
                        $(this).parents('tr').css('background-color', '');
                    }
                    if ($cek0 == '') {
                        $('#request' + index + ' table tbody .cek').prop('disabled', false);
                        $('.acceptall').prop('disabled', false);
                        $('.denyall').prop('disabled', false);
                    }
                    console.log($cek0);
                });
                $('.pagination' + index).on('click', '.page', function (asd) {
                    $cek0 = [];
                    $('#load').show();
                    $datapagi = $(this).data('action');
                    $('.acceptall').prop('disabled', false);
                    $('.denyall').prop('disabled', false);
                    $.ajax({
                        url: "{{route('admin.request.apiData')}}",
                        type: "get",
                        data: {'id': index, 'pagination': $datapagi,'search':$search},
                        success: function (data) {
                            console.log(data);
                            $datapagi = parseInt(data.pagination);
                            $pagi = $('.pagination' + index + ' .pagi' + $datapagi);
                            $arrayPagi = $typejob[prefix2 + index]=data.entity;
                            $trdata = '';
                            $.each(data['list'], function (key, value) {
                                if (value.status == 0) {
                                    $status = '<div class="input-group-btn"><button type="button"\n' +
                                        '                                                                        class="btn btn-info dropdown-toggle"\n' +
                                        '                                                                        data-toggle="dropdown">Menunggu\n' +
                                        '                                                                    <span class="fa fa-caret-down"></span></button>\n' +
                                        '                                                                <ul class="dropdown-menu">\n' +
                                        '                                                                    <li><a href="#" class="terima">Terima</a></li>\n' +
                                        '                                                                    <li><a href="#" class="tolak">Tolak</a></li>\n' +
                                        '                                                                </ul></div>';
                                } else if (value.status == 1) {
                                    $status = '<div class="input-group-btn"><button type="button"\n' +
                                        '                                                                        class="btn btn-success dropdown-toggle"\n' +
                                        '                                                                        data-toggle="dropdown">Diterima\n' +
                                        '                                                                    <span class="fa fa-caret-down"></span></button>\n' +
                                        '                                                                <ul class="dropdown-menu">\n' +
                                        '                                                                    <li><a href="#tolak" class="">Tolak</a></li>\n' +
                                        '                                                                </ul></div>';
                                } else {
                                    $status = '<div class="input-group-btn"><button type="button"\n' +
                                        '                                                                        class="btn btn-danger dropdown-toggle"\n' +
                                        '                                                                        data-toggle="dropdown">Ditolak\n' +
                                        '                                                                    <span class="fa fa-caret-down"></span></button>\n' +
                                        '                                                                <ul class="dropdown-menu">\n' +
                                        '                                                                    <li><a href="#" class="terima">Terima</a></li>\n' +
                                        '                                                                </ul></div>';
                                }
                                $trdata += '<tr data-id=' + value.id + '>\n' +
                                    ' <td><input type="checkbox"\n' +
                                    '                                                                                   name="cek' + value.id + '"\n' +
                                    '                                                                                   data-action="' + value.status + '"\n' +
                                    'class="cek ' + value.class + '" id="cek' + value.id + '" value="' + value.id + '"></td>\n' +
                                    ' <td>' + value.user + '</td>\n' +
                                    ' <td>' + value.old + '</td>\n' +
                                    ' <td>' + value.new + '</td>\n' +
                                    ' <td>' + value.date + '</td>\n' +
                                    ' <td id="action' + value.id + '">' + $status + '</td>\n' +
                                    '</tr>';
                            });
                            $('#request' + index + ' table tbody').empty().append($trdata);
                            if ($datapagi == $arrayPagi.length) {
                                $('.pagination' + index + ' .pagiNext').data('action', 1);
                            }
                            else {
                                $('.pagination' + index + ' .pagiNext').data('action', (parseInt($datapagi) + 1));
                            }
                            if ($datapagi == 1) {
                                $('.pagination' + index + ' .pagiPrevious').data('action', $arrayPagi.length);
                            }
                            else {
                                $('.pagination' + index + ' .pagiPrevious').data('action', (parseInt($datapagi) - 1));
                            }
                            if ($arrayPagi.length > 5) {
                                $paginext = $('.pagination' + index + ' .pagiNext').data('action');
                                $pagiprev = $('.pagination' + index + ' .pagiPrevious').data('action');

                                if ($datapagi > (parseInt($arrayPagi.length) - 3)) {
                                    $dataafter = '';
                                    for ($i = ($arrayPagi.length - 4); $i <= $arrayPagi.length; $i++) {
                                        $dataafter += '<button href="javascript:void(0)" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                                    }
                                    $('.pagination' + index).empty().append('<button href="javascript:void(0)" data-action="' + $pagiprev + '" class="pagiPrevious btn page gradient"><span class="fa fa-caret-left"></span></button>\n' +
                                        '<button href="javascript:void(0)" data-action="1" class="pagiLast btn page gradient">1</button>\n' +
                                        '<button href="javascript:void(0)" data-action="' + ($arrayPagi.length - 5) + '" class="pagiVar1 btn page gradient">..</button>\n' + $dataafter +

                                        '<button href="javascript:void(0)" data-action="' + $paginext + '" class="pagiNext btn page gradient"><span class="fa fa-caret-right"></span></button>'
                                    ).hide().fadeIn(200);
                                }
                                else if ($datapagi > 3) {
                                    $dataafter = '';
                                    for ($i = ($datapagi - 2); $i < ($datapagi + 3); $i++) {
                                        $dataafter += '<button href="javascript:void(0)" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                                    }
                                    $('.pagination' + index).empty().append('<button href="javascript:void(0)" data-action="' + $pagiprev + '" class="pagiPrevious btn page gradient"><span class="fa fa-caret-left"></span></button>\n' +
                                        '<button href="javascript:void(0)" data-action="1" class="pagiLast btn page gradient">1</button>\n' +
                                        '<button href="javascript:void(0)" data-action="' + ($datapagi - 3) + '" class="pagiVar1 btn page gradient">..</button>\n' + $dataafter +
                                        '<button href="javascript:void(0)" data-action="' + ($datapagi + 3) + '" class="pagiVar2 btn page gradient">..</button>\n' +
                                        '<button href="javascript:void(0)" data-action="' + $arrayPagi.length + '" class="pagiVar2 btn page gradient">' + $arrayPagi.length + '</button>\n' +
                                        '<button href="javascript:void(0)" data-action="' + $paginext + '" class="pagiNext btn page gradient"><span class="fa fa-caret-right"></span></button>'
                                    );
                                }
                                else {
                                    $dataafter = '';
                                    for ($i = 1; $i < 6; $i++) {
                                        $dataafter += '<button href="javascript:void(0)" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                                    }
                                    $('.pagination' + index).empty().append('<button href="javascript:void(0)" data-action="' + $pagiprev + '" class="pagiPrevious btn page gradient"><span class="fa fa-caret-left"></span></button>\n' +
                                        $dataafter +
                                        '<button href="javascript:void(0)" data-action="6" class="pagiVar2 btn page gradient">..</button>\n' +
                                        '<button href="javascript:void(0)" data-action="' + $arrayPagi.length + '" class="pagiVar2 btn page gradient">' + $arrayPagi.length + '</button>\n' +
                                        '<button href="javascript:void(0)" data-action="' + $paginext + '" class="pagiNext btn page gradient"><span class="fa fa-caret-right"></span></button>'
                                    );
                                }
                            }
                            $pagi2 = $('.pagination' + index + ' .pagi' + $datapagi);
                            $pagi2.removeClass('gradient');
                            $pagi2.addClass('active');
                            $pagi2.prop('disabled', true);
                            $pagi2.siblings().removeClass('active');
                            $pagi2.siblings().addClass('gradient');
                            $pagi2.siblings().prop('disabled', false);
                            console.log($('.pagination' + index + ' .pagi' + $datapagi).data('action'));
                            $('#load').fadeOut(1000);
                        },
                        error: function () {
                            $('#load').hide();

                            swal({
                                title: 'Oops...',
                                text: 'Something went wrong or data is empty!',
                                type: 'error',
                                timer: '1500'
                            })
                        }
                    });
                })
            });
        });

        function changeTitle(id) {
            $index = $(id).data('id');
            $('#request' + $index + ' table tbody').empty().append('<tr><td colspan="5">loading...</td></tr>');
            $cek0 = [];
            $('#load').fadeIn(500);
            $('.acceptall').prop('disabled', false);
            $('.denyall').prop('disabled', false);
            $('#table_search').val('');
            $search='';
            console.log($search);
            console.log($(id).data('change'));
            $('.content-wrapper .change').text($(id).data('change'));
            $('.pagination' + $index).siblings().hide();
//            $typejob[prefix + $(id).data('id')].ajax.reload();
            $.ajax({
                url: "{{route('admin.request.apiData')}}",
                type: "get",
                data: {'id': $index, 'pagination': 1,'search':$search},
                success: function (data) {
                    $select = $index;
                    $typejob[prefix2 + $index] = [];
                    console.log(data);
                    $typejob[prefix2 + $index] = $arrayPagi = data.entity;
                    if (data.entity.length <= 1) {

                    }
                    else if (data.entity.length > 5) {
                        $dataafter = '';
                        $dataafter += '<button href="javascript:void(0)" data-action="1" class="pagi1 btn page active">1</button>\n';
                        for ($i = 2; $i < 6; $i++) {
                            $dataafter += '<button href="javascript:void(0)" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                        }
                        $('.pagination' + $index).empty().append('<button href="javascript:void(0)" data-action="' + $arrayPagi.length + '" class="pagiPrevious btn page gradient"><span class="fa fa-caret-left"></span></button>\n' +
                            $dataafter +
                            '<button href="javascript:void(0)" data-action="6" class="pagiVar2 btn page gradient">..</button>\n' +
                            '<button href="javascript:void(0)" data-action="' + $arrayPagi.length + '" class="pagiVar2 btn page gradient">' + $arrayPagi.length + '</button>\n' +
                            '<button href="javascript:void(0)" data-action="2" class="pagiNext btn page gradient"><span class="fa fa-caret-right"></span></button>'
                        ).show();
                    }
                    else {
                        $dataafter = '';
                        $dataafter += '<button href="javascript:void(0)" data-action="1" class="pagi1 btn page active">1</button>\n';
                        for ($i = 2; $i <= $arrayPagi.length; $i++) {
                            $dataafter += '<button href="javascript:void(0)" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                        }
                        $('.pagination' + $index).empty().append('<button href="javascript:void(0)" data-action="' + $arrayPagi.length + '" class="pagiPrevious btn page gradient"><span class="fa fa-caret-left"></span></button>\n' +
                            $dataafter +
                            '<button href="javascript:void(0)" data-action="2" class="pagiNext btn page gradient"><span class="fa fa-caret-right"></span></button>'
                        ).show();
                    }

                    $trdata = '';
                    if (data['list'].length > 0) {
                        $.each(data['list'], function (key, value) {
                            if (value.status == 0) {
                                $status = '<div class="input-group-btn"><button type="button"\n' +
                                    '                                                                        class="btn btn-info dropdown-toggle"\n' +
                                    '                                                                        data-toggle="dropdown">Menunggu\n' +
                                    '                                                                    <span class="fa fa-caret-down"></span></button>\n' +
                                    '                                                                <ul class="dropdown-menu">\n' +
                                    '                                                                    <li><a href="#" class="terima">Terima</a></li>\n' +
                                    '                                                                    <li><a href="#" class="tolak">Tolak</a></li>\n' +
                                    '                                                                </ul></div>';
                            } else if (value.status == 1) {
                                $status = '<div class="input-group-btn"><button type="button"\n' +
                                    '                                                                        class="btn btn-success dropdown-toggle"\n' +
                                    '                                                                        data-toggle="dropdown">Diterima\n' +
                                    '                                                                    <span class="fa fa-caret-down"></span></button>\n' +
                                    '                                                                <ul class="dropdown-menu">\n' +
                                    '                                                                    <li><a href="#" class="tolak">Tolak</a></li>\n' +
                                    '                                                                </ul></div>';
                            } else {
                                $status = '<div class="input-group-btn"><button type="button"\n' +
                                    '                                                                        class="btn btn-danger dropdown-toggle"\n' +
                                    '                                                                        data-toggle="dropdown">Ditolak\n' +
                                    '                                                                    <span class="fa fa-caret-down"></span></button>\n' +
                                    '                                                                <ul class="dropdown-menu">\n' +
                                    '                                                                    <li><a href="#" class="terima">Terima</a></li>\n' +
                                    '                                                                </ul></div>';
                            }
                            $trdata += '<tr data-id="' + value.id + '">\n' +
                                ' <td><input type="checkbox"\n' +
                                '                                                                                   name="cek' + value.id + '"\n' +
                                '                                                                                   data-action="' + value.status + '"\n' +
                                'class="cek ' + value.class + '" id="cek' + value.id + '" value="' + value.id + '"></td>\n' +
                                ' <td>' + value.user + '</td>\n' +
                                ' <td>' + value.old + '</td>\n' +
                                ' <td>' + value.new + '</td>\n' +
                                ' <td>' + value.date + '</td>\n' +
                                ' <td id="action' + value.id + '">' + $status + '</td>\n' +
                                '</tr>';
                        });
                    }
                    else {
                        $trdata = '<tr><td colspan="5">Data Kosong</td></tr>';
                    }

                    $('#request' + $index + ' table tbody').empty().append($trdata).hide().fadeIn(500);

                    $('#load').fadeOut(1000);
                },
                error: function () {
                    $('#load').hide();

                    swal({
                        title: 'Oops...',
                        text: 'Something went wrong or data is empty!',
                        type: 'error',
                        timer: '1500'
                    })
                }
            });

        }

        $('.tab-content').on('click', '.terima', function (asd) {
            $('#load').hide();
            $dataId = $(this).parents('tr');
            console.log($dataId);
            $.ajax({
                url: "{{route('admin.request.accept')}}",
                type: "get",
                data: {'id': $dataId.data('id')},
                success: function (data) {
                    console.log(data);
                    $('#request' + $select + ' #action' + data).empty().append('<div class="input-group-btn">\n' +
                        '<button type="button"\n' +
                        '                                                                        class="btn btn-success dropdown-toggle"\n' +
                        '                                                                        data-toggle="dropdown">Diterima\n' +
                        '                                                                    <span class="fa fa-caret-down"></span></button>\n' +
                        '                                                                <ul class="dropdown-menu">\n' +
                        '                                                                    <li><a href="#" class="tolak">Tolak</a></li>\n' +
                        '                                                                </ul></div>');
                    $('#request'+$select+' #cek'+data).removeClass('deny');
                    $('#request'+$select+' #cek'+data).removeClass('wait');
                    $('#request'+$select+' #cek'+data).addClass('accept');
                    $('#request'+$select+' #cek'+data).data('action',1);
                    $('#request'+$select+' .cek').prop('disabled',false);
                    $('#request'+$select+' .cek').prop('checked',false);
                    $('#request'+$select+' .cek').parents('tr').css('background-color', '');
                    $('.acceptall').prop('disabled',false);
                    $('.denyall').prop('disabled',false);
                    $cek0=[];
                    $('#load').hide();
                    swal({
                        title: 'Berhasil...',
                        text: 'Perubahan Diterima',
                        type: 'success',
                        timer: '1500'
                    })

                },
                error: function () {
                    $('#load').hide();

                    swal({
                        title: 'Oops...',
                        text: 'Something went wrong or data is empty!',
                        type: 'error',
                        timer: '1500'
                    })
                }
            });


        });
        $('.tab-content').on('click', '.tolak', function (asd) {
            $('#load').show();
            $dataId = $(this).parents('tr');
            $.ajax({
                url: "{{route('admin.request.deny')}}",
                type: "get",
                data: {'id': $dataId.data('id')},
                success: function (data) {
                    console.log(data);
                    $('#request'+$select+' #action' + data).empty().append('<div class="input-group-btn">\n' +
                        '<button type="button"\n' +
                        '                                                                        class="btn btn-danger dropdown-toggle"\n' +
                        '                                                                        data-toggle="dropdown">Ditolak\n' +
                        '                                                                    <span class="fa fa-caret-down"></span></button>\n' +
                        '                                                                <ul class="dropdown-menu">\n' +
                        '                                                                    <li><a href="#" class="terima">Terima</a></li>\n' +
                        '                                                                </ul></div>');
                    $('#request'+$select+' #cek'+data).removeClass('accept');
                    $('#request'+$select+' #cek'+data).removeClass('wait');
                    $('#request'+$select+' #cek'+data).addClass('deny');
                    $('#request'+$select+' #cek'+data).data('action',2);
                    $('#request'+$select+' .cek').prop('disabled',false);
                    $('#request'+$select+' .cek').prop('checked',false);
                    $('#request'+$select+' .cek').parents('tr').css('background-color', '');
                    $('.acceptall').prop('disabled',false);
                    $('.denyall').prop('disabled',false);
                    $cek0=[];
                    swal({
                        title: 'Berhasil...',
                        text: 'Perubahan Ditolak',
                        type: 'success',
                        timer: '1500'
                    })
                    $('#load').hide();

                },
                error: function () {
                    $('#load').hide();
                    swal({
                        title: 'Oops...',
                        text: 'Something went wrong or data is empty!',
                        type: 'error',
                        timer: '1500'
                    })
                }
            });
        });
        $('.acceptall').on('click', function (asd) {
            $('#load').show();
            if ($cek0.length==0){
                $('#load').hide();
                swal({
                    title: 'Data not selected!',
                    text: 'please select some checkbox...',
                    type: 'info',
                    timer: '1500'
                })
            }else {
                $.ajax({
                    url: "{{route('admin.request.accept')}}",
                    type: "get",
                    data: {'id': $cek0},
                    success: function (data) {
                        console.log(data);
                        data.forEach(function (index) {
                            $('#request' + $select + ' #action' + index).empty().append('<div class="input-group-btn">\n' +
                                '<button type="button"\n' +
                                '                                                                        class="btn btn-success dropdown-toggle"\n' +
                                '                                                                        data-toggle="dropdown">Diterima\n' +
                                '                                                                    <span class="fa fa-caret-down"></span></button>\n' +
                                '                                                                <ul class="dropdown-menu">\n' +
                                '                                                                    <li><a href="#" class="tolak">Tolak</a></li>\n' +
                                '                                                                </ul></div>');
                            $('#request' + $select + ' #cek' + index).removeClass('deny');
                            $('#request' + $select + ' #cek' + index).removeClass('wait');
                            $('#request' + $select + ' #cek' + index).addClass('accept');
                            $('#request' + $select + ' #cek' + index).data('action', 1);
                            $('#request' + $select + ' #cek' + index).parents('tr').css('background-color', '');
                        });
                        $('#request' + $select + ' .cek').prop('checked', false);
                        $('#request' + $select + ' .cek').prop('disabled', false);
                        $('.acceptall').prop('disabled', false);
                        $('.denyall').prop('disabled', false);
                        $cek0 = [];
                        swal({
                            title: 'Berhasil...',
                            text: 'Perubahan Ditolak',
                            type: 'success',
                            timer: '1500'
                        });
                        $('#load').hide();
                    },
                    error: function () {
                        $('#load').hide();

                        swal({
                            title: 'Oops...',
                            text: 'Something went wrong or data is empty!',
                            type: 'error',
                            timer: '1500'
                        })
                    }
                });
            }

        });
        $('.denyall').on('click', function (asd) {
            $('#load').show();
            if ($cek0.length==0){
                $('#load').hide();
                swal({
                    title: 'Data not selected!',
                    text: 'please select some checkbox...',
                    type: 'info',
                    timer: '1500'
                })
            }else {
                $.ajax({
                    url: "{{route('admin.request.deny')}}",
                    type: "get",
                    data: {'id': $cek0},
                    success: function (data) {
                        console.log(data);
                        data.forEach(function (index) {
                            $('#request' + $select + ' #action' + index).empty().append('<div class="input-group-btn">\n' +
                                '<button type="button"\n' +
                                '                                                                        class="btn btn-danger dropdown-toggle"\n' +
                                '                                                                        data-toggle="dropdown">Ditolak\n' +
                                '                                                                    <span class="fa fa-caret-down"></span></button>\n' +
                                '                                                                <ul class="dropdown-menu">\n' +
                                '                                                                    <li><a href="#" class="terima">Terima</a></li>\n' +
                                '                                                                </ul></div>');
                            $('#request' + $select + ' #cek' + index).removeClass('accept');
                            $('#request' + $select + ' #cek' + index).removeClass('wait');
                            $('#request' + $select + ' #cek' + index).addClass('deny');
                            $('#request' + $select + ' #cek' + index).data('action', 2);
                            $('#request' + $select + ' #cek' + index).parents('tr').css('background-color', '');
                        });
                        $('#request' + $select + ' .cek').prop('checked', false);
                        $('#request' + $select + ' .cek').prop('disabled', false);
                        $('.acceptall').prop('disabled', false);
                        $('.denyall').prop('disabled', false);
                        $cek0 = [];
                        swal({
                            title: 'Berhasil...',
                            text: 'Perubahan Ditolak',
                            type: 'success',
                            timer: '1500'
                        });
                        $('#load').hide();
                    },
                    error: function () {
                        $('#load').hide();

                        swal({
                            title: 'Oops...',
                            text: 'Something went wrong or data is empty!',
                            type: 'error',
                            timer: '1500'
                        })
                    }
                });
            }


        });
        $('#table_search').keypress(function (e) {
            if (e.which ==13) {
                $index = $select;
                $('#request' + $index + ' table tbody').empty().append('<tr><td colspan="5">loading...</td></tr>');
                $cek0 = [];
                $('#load').fadeIn(500);
                $('.acceptall').prop('disabled', false);
                $('.denyall').prop('disabled', false);
                $('#searchBtn .fa-search').hide();
                $('#searchBtn .fa-spin').show();
                $('#table_search').prop('readonly',true);
                $('#searchBtn').prop('disabled',true);
                $search=$('#table_search').val();
                $('.pagination' + $index).hide();
                $.ajax({
                    url: "{{route('admin.request.apiData')}}",
                    type: "get",
                    data: {'id': $select,'search':$search,'pagination':1},
                    success: function (data) {
                        console.log(data);
                        $select = $index;
                        $typejob[prefix2 + $index] = [];
                        console.log(data);
                        $typejob[prefix2 + $index] = $arrayPagi = data.entity;
                        if (data.entity.length <= 1) {

                        }
                        else if (data.entity.length > 5) {
                            $dataafter = '';
                            $dataafter += '<button href="javascript:void(0)" data-action="1" class="pagi1 btn page active">1</button>\n';
                            for ($i = 2; $i < 6; $i++) {
                                $dataafter += '<button href="javascript:void(0)" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                            }
                            $('.pagination' + $index).empty().append('<button href="javascript:void(0)" data-action="' + $arrayPagi.length + '" class="pagiPrevious btn page gradient"><span class="fa fa-caret-left"></span></button>\n' +
                                $dataafter +
                                '<button href="javascript:void(0)" data-action="6" class="pagiVar2 btn page gradient">..</button>\n' +
                                '<button href="javascript:void(0)" data-action="' + $arrayPagi.length + '" class="pagiVar2 btn page gradient">' + $arrayPagi.length + '</button>\n' +
                                '<button href="javascript:void(0)" data-action="2" class="pagiNext btn page gradient"><span class="fa fa-caret-right"></span></button>'
                            ).show();
                        }
                        else {
                            $dataafter = '';
                            $dataafter += '<button href="javascript:void(0)" data-action="1" class="pagi1 btn page active">1</button>\n';
                            for ($i = 2; $i <= $arrayPagi.length; $i++) {
                                $dataafter += '<button href="javascript:void(0)" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                            }
                            $('.pagination' + $index).empty().append('<button href="javascript:void(0)" data-action="' + $arrayPagi.length + '" class="pagiPrevious btn page gradient"><span class="fa fa-caret-left"></span></button>\n' +
                                $dataafter +
                                '<button href="javascript:void(0)" data-action="2" class="pagiNext btn page gradient"><span class="fa fa-caret-right"></span></button>'
                            ).show();
                        }

                        $trdata = '';
                        if (data['list'].length > 0) {
                            $.each(data['list'], function (key, value) {
                                if (value.status == 0) {
                                    $status = '<div class="input-group-btn"><button type="button"\n' +
                                        '                                                                        class="btn btn-info dropdown-toggle"\n' +
                                        '                                                                        data-toggle="dropdown">Menunggu\n' +
                                        '                                                                    <span class="fa fa-caret-down"></span></button>\n' +
                                        '                                                                <ul class="dropdown-menu">\n' +
                                        '                                                                    <li><a href="#" class="terima">Terima</a></li>\n' +
                                        '                                                                    <li><a href="#" class="tolak">Tolak</a></li>\n' +
                                        '                                                                </ul></div>';
                                } else if (value.status == 1) {
                                    $status = '<div class="input-group-btn"><button type="button"\n' +
                                        '                                                                        class="btn btn-success dropdown-toggle"\n' +
                                        '                                                                        data-toggle="dropdown">Diterima\n' +
                                        '                                                                    <span class="fa fa-caret-down"></span></button>\n' +
                                        '                                                                <ul class="dropdown-menu">\n' +
                                        '                                                                    <li><a href="#" class="tolak">Tolak</a></li>\n' +
                                        '                                                                </ul></div>';
                                } else {
                                    $status = '<div class="input-group-btn"><button type="button"\n' +
                                        '                                                                        class="btn btn-danger dropdown-toggle"\n' +
                                        '                                                                        data-toggle="dropdown">Ditolak\n' +
                                        '                                                                    <span class="fa fa-caret-down"></span></button>\n' +
                                        '                                                                <ul class="dropdown-menu">\n' +
                                        '                                                                    <li><a href="#" class="terima">Terima</a></li>\n' +
                                        '                                                                </ul></div>';
                                }
                                $trdata += '<tr data-id="' + value.id + '">\n' +
                                    ' <td><input type="checkbox"\n' +
                                    '                                                                                   name="cek' + value.id + '"\n' +
                                    '                                                                                   data-action="' + value.status + '"\n' +
                                    'class="cek ' + value.class + '" id="cek' + value.id + '" value="' + value.id + '"></td>\n' +
                                    ' <td>' + value.user + '</td>\n' +
                                    ' <td>' + value.old + '</td>\n' +
                                    ' <td>' + value.new + '</td>\n' +
                                    ' <td>' + value.date + '</td>\n' +
                                    ' <td id="action' + value.id + '">' + $status + '</td>\n' +
                                    '</tr>';
                            });
                        }
                        else {
                            $trdata = '<tr><td colspan="5">Data Kosong</td></tr>';
                        }

                        $('#request' + $index + ' table tbody').empty().append($trdata).hide().fadeIn(500);

                        $('#load').fadeOut(1000);
                        $('#searchBtn .fa-search').show();
                        $('#searchBtn .fa-spin').hide();
                        $('#table_search').prop('readonly',false);
                        $('#searchBtn').prop('disabled',false);
                        if(data.amount==0){
                            swal({
                                title: 'Berhasil...',
                                text: 'Tidak ditemukan data',
                                type: 'success',
                                timer: '1500'
                            });
                        }
                        else{
                            swal({
                                title: 'Berhasil...',
                                text: 'Ditemukan '+data.amount+' Data',
                                type: 'success',
                                timer: '1500'
                            });
                        }
                        $('#load').hide();
                    },
                    error: function () {
                        $('#load').hide();

                        swal({
                            title: 'Oops...',
                            text: 'Something went wrong or data is empty!',
                            type: 'error',
                            timer: '1500'
                        })
                    }
                });

            }
        });

        $('#searchBtn').on('click', function (asd){
           $e =$.Event("keypress",{which:13});
           $('#table_search').trigger($e);
        });

        //        $('#tbodysurat' + index).on('change', '.trsurat', function (asd) {
        //
        //        });

    </script>
@endsection