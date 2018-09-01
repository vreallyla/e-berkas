@extends('layouts.admin.admin_mst_dashboard')
@section('title', 'eBerkas KPP MADYA | Table Pengguna')
@section('sidenav')
    <ul class="sidebar-menu" data-widget="tree">
        <li class="header">Navigasi Admin</li>


        <li>
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
        <li class="treeview active menu-open">
            <a href="#">
                <i class="fa fa-table"></i>
                <span>Tabel Pengurus</span>
                <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
            </a>
            <ul class="treeview-menu">
                <li
                        class="tab tab-pinggir @if ($users=='user') active @endif "
                        data-id="0"
                ><a href="#user"><i class="fa fa-group"></i> Pengguna</a></li>
                <li
                        class="tab tab-pinggir @if ($users=='letter') active @endif "
                        data-id="1"
                ><a href="#surat"><i class="fa fa-envelope"></i>Jenis Surat</a></li>
            </ul>
        </li>
    </ul>

@endsection
@section('style')
    {{--hover table--}}

    {{--hover table--}}
    <style>

        /*a {*/
        /*text-decoration: none;*/
        /*color: maroon;*/
        /*-webkit-transition: .5s ease;*/
        /*transition: .5s ease;*/
        /*}*/

        /*a:hover {*/
        /*color: red;*/
        /*}*/

        .tab-group {
            list-style: none;
            padding: 0;
            margin: 0 0 40px 0;
        }

        .tab-group:after {
            content: "";
            display: table;
            clear: both;
        }

        .tab-group li a {
            display: block;
            text-decoration: none;
            padding: 15px;
            background: rgba(76, 0, 0, 0.25);
            color: maroon;
            font-size: 20px;
            float: left;
            width: 50%;
            text-align: center;
            cursor: pointer;
            -webkit-transition: .5s ease;
            transition: .5s ease;
        }

        .loadinglah {
            background-color: #ffffff;
            background-image: url("{{asset('images/loadingstyle/loadinginput2.gif')}}");
            background-size: 40px 40px;
            background-position: right center;
            background-repeat: no-repeat;
        }

        .loadinglah2 {
            background-color: #ffffff;
            background-image: url("{{asset('images/check.png')}}");
            background-size: 40px 40px;
            background-position: right center;
            background-repeat: no-repeat;
        }

        .tab-group li a:hover {
            background: #D25959;
            color: #ffffff;
        }

        .tab-group .active a {
            background: #f55b57;
            color: #ffffff;
        }

        .tab-content2 > div:last-child {
            display: none;
        }

        .sizefontlo {
            text-align: center;
            color: maroon;
            font-weight: 300;
            margin: 0 0 40px;
        }

        /*label {*/
        /*position: absolute;*/
        /*-webkit-transform: translateY(6px);*/
        /*transform: translateY(6px);*/
        /*left: 13px;*/
        /*color: rgba(76, 0, 0, 0.8);*/
        /*-webkit-transition: all 0.2s ease;*/
        /*transition: all 0.2s ease;*/
        /*-webkit-backface-visibility: hidden;*/
        /*pointer-events: none;*/
        /*font-size: 15px;*/
        /*}*/

        /*label .req {*/
        /*margin: 2px;*/
        /*color: maroon;*/
        /*}*/

        /*label.active {*/
        /*-webkit-transform: translateY(30px);*/
        /*transform: translateY(30px);*/
        /*left: 2px;*/
        /*font-size: 14px;*/
        /*}*/

        /*label.active .req {*/
        /*opacity: 0;*/
        /*}*/

        /*label.highlight {*/
        /*color: red;*/
        /*}*/

        /*.field-wrap {*/
        /*position: relative;*/
        /*margin-bottom: 40px;*/
        /*}*/
        /**/
        /*.top-row:after {*/
        /*content: "";*/
        /*display: table;*/
        /*clear: both;*/
        /*}*/

        /*.top-row > div {*/
        /*float: left;*/
        /*width: 48%;*/
        /*margin-right: 4%;*/
        /*}*/

        /*.top-row > div:last-child {*/
        /*margin: 0;*/
        /*}*/

        /*.button:hover, .button:focus {*/
        /*background: maroon;*/
        /*}*/

        /*.button-block {*/
        /*display: block;*/
        /*width: 100%;*/
        /*}*/

        /*.forgot {*/
        /*margin-top: -20px;*/
        /*text-align: right;*/
        /*}*/
    </style>
    <style>

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
    <style>
        select.disabled {
            background-color: #f2f2f2;
        }
    </style>
    <style>
        tr:hover {
            background-color: #dedfe0;
        }
    </style>
    <style>
        .loadinglah {
            background-color: #ffffff;
            background-image: url("{{asset('images/loadingstyle/loadinginput2.gif')}}");
            background-size: 40px 40px;
            background-position: right center;
            background-repeat: no-repeat;
        }
    </style>
    {{--sweetalert modify icon--}}
    <style>
{{--        {{asset('images/loadingstyle/loadingimg.gif')}}--}}
        .swal-wide{
    width:850px !important;
    height:400px !important;
}
    </style>
    <script src="{{asset('bower_components/jquery/dist/jquery.min.js')}}"></script>
@endsection
@section('content')
    @include('admin.pengurus.form')
    {{--optionjob--}}
    <script>
        var $joboption1 = [];
        var $joboption2 = [];
        var selectsurat = [];
        var pagination = {};
        var prefix = 'surat';
        var search = {};
        var surat = 0;
        var pengguna = 0;
        var countSend = 3;
        @foreach($jobCategory as $row)
        $joboption1.push('{{$row->id}}');
        $joboption2.push('{{$row->name}}');
        pagination[prefix + '{{$row->id}}'] = 1;
        search[prefix + '{{$row->id}}'] = '';
                @endforeach

        var $index = '';
    </script>
    {{--optionjob--}}

    {{--multi function--}}
    {{--delete--}}
    <script>
        function multidelete(id) {
            if (selectsurat.length > 0) {
                hapussurat(selectsurat);
            }
            else {
                swal({
                    title: 'Alert!',
                    text: 'Select some data',
                    type: 'info',
                    timer: '1500'
                })
            }
        }

    </script>
    {{--delete--}}
    <script>
        function hapussurat($id) {
            $('#load').show();
            $('.content .row').css("opacity", 0.4);
            $.ajax({
                url: "{{route('admin.table.letter.cekhapus')}}",
                type: "get",
                data: {'id': $id},
                success: function (data) {
                    if (data.length > 0) {
                        $notice = 'there is a linked file, data will be deleted!';
                        $entity = data;
                    }
                    else {
                        $notice = 'You will not be able to recover this data!';
                        $entity = 'kosong';
                    }
                    console.log(data);
                    swal({
                        title: 'Are you sure?',
                        text: $notice,
                        type: 'warning',
                        showCancelButton: true,
                        confirmButtonText: 'Yes, delete it!',
                        cancelButtonText: 'No, keep it'
                    }).then(function (isConfirm) {
                        if (!$.trim(isConfirm.dismiss)) {
                            $.ajax({
                                url: "{{route('admin.table.letter.hapus')}}",
                                type: "get",
                                data: {'entity': $entity, 'id': $id},
                                success: function (data) {
                                    selectsurat = [];
                                    getData($index, pagination[prefix + $index]);
                                    // $(':button').prop('disabled', false);
                                    // $('li').prop('disabled', false);
                                    // $('a').prop('disabled', false);
                                    swal({
                                        title: 'Success!',
                                        text: 'data has been deleted!',
                                        type: 'success',
                                        timer: '1500'
                                    });

                                },
                                error: function () {

                                    // $(':button[type="submit"]').prop('disabled', false);
                                    swal({
                                        title: 'Oops...',
                                        text: 'Something went wrong!',
                                        type: 'error',
                                        timer: '1500'
                                    })
                                }
                            });
                        }

                        return false;
                    });
                },
                error: function () {
                    $('#load').hide(1000);
                    $('.content .row').css("opacity", 1);
                    swal({
                        title: 'Oops...',
                        text: 'Something went wrong or data is empty!',
                        type: 'error',
                        timer: '1500'
                    })
                }
            });
            $('#load').fadeOut(3000);
            $('.content .row').css("opacity", 1).fadeIn(3000);
        }
    </script>
    {{--function delete--}}
    {{--edit show--}}
    <script>
        // function declareEdit() {
        //     $labelmulti = $('#modal-form3 form').find('.loopmulti').clone().get(0);
        //     $id = $($labelmulti).find('.id');$name = $($labelmulti).find('.name');
        //     $span=$($labelmulti).find('span');
        //     $singkatan = $($labelmulti).find('.singkatan');
        //     $job_id = $($labelmulti).find('.job_id');
        //     $desc = $($labelmulti).find('.desc');
        //     $head='<div class="row container-fluid loopmulti">\n' +
        //         '<div class="row form-group has-feedback">';
        //     $col='<div class="col-md-3">';
        //     $tutup='</div>';
        //
        // }
        function multiedit(id) {
            if (selectsurat.length > 0) {
                $('#load').show();
                $('.content .row').css("opacity", 0.4);
                // declareEdit();

                $.ajax({
                    url: "{{route('admin.table.letter.lihat')}}",
                    type: "get",
                    data: {'id': selectsurat},
                    success: function (data) {
                        $labelmulti = $('#modal-form3 form').find('.loopmulti').clone().get(0).innerHTML;
                        $('#modal-form3 form #fill').empty();
                        $.each(data, function (key, value) {
                            $('#modal-form3 form #fill').append('<div class="row container-fluid loopmulti">' + $labelmulti + '</div>');
                            $changearray = $('#modal-form3 form').find('.loopmulti').get(key);
                            $($changearray).addClass('filledit' + key);
                            $('#modal-form3 form .filledit' + key + ' .name').val(value.name);
                            $('#modal-form3 form .filledit' + key + ' .singkatan').val(value.singkatan);
                            $('#modal-form3 form .filledit' + key + ' .desc').val(value.desc);
                            $('#modal-form3 form .filledit' + key + ' .id').val(value.id);
                            $job_id = '';
                            $job_id += '<option value="" disabled="true">Pilih Seksi</option>';
                            for ($x = 0, $y = value.ids.length; $x < $y; $x++) {
                                if (value.ids[$x] == value.select) {
                                    $job_id += '<option value="' + value.ids[$x] + '" selected>' + value.names[$x] + '</option>\n';
                                }
                                else {
                                    $job_id += '<option value="' + value.ids[$x] + '">' + value.names[$x] + '</option>\n';
                                }
                            }
                            $('#modal-form3 form .filledit' + key + ' .job_id').empty().append($job_id);
                        });

                        $('#load').hide();
                        $('.content .row').css("opacity", 1);
                        $('#modal-form3').modal('show');
                        $('#modal-form3 .modal-title').text('Multi Edit');
                    },
                    error: function () {
                        $('#load').hide();
                        $('.content .row').css("opacity", 1);
                        swal({
                            title: 'Oops...',
                            text: 'Something went wrong or data is empty!',
                            type: 'error',
                            timer: '1500'
                        })
                    }
                });
            }
            else {
                swal({
                    title: 'Alert!',
                    text: 'Select some data',
                    type: 'info',
                    timer: '1500'
                })
            }
        }
    </script>
    <script>
        function lihatsurat(asd) {
            $id = $(asd).data('id');
            $action = $(asd).data('action');
            $status = $(asd).data('status');
            console.log($id);
            $.ajax({
                url: "{{route('admin.table.letter.lihat')}}",
                type: "get",
                data: {'id': $id},
                success: function (data) {
                    $job_id = '';
                    if ($action == 'lihat') {
                        $('#modal-form2 .lihatsurat').removeAttr('data-id');
                        $('#modal-form2 .lihatsurat').attr('data-id',$id);
                        $('#modal-form2 #name').prop('disabled', true);
                        $('#modal-form2 #name').css('background-color', '#fcfdff');
                        $('#modal-form2 #singkatan').prop('disabled', true);
                        $('#modal-form2 #singkatan').css('background-color', '#fcfdff');
                        $('#modal-form2 #job_id').prop('disabled', true);
                        $('#modal-form2 #job_id').css('background-color', '#fcfdff');
                        $('#modal-form2 #desc').prop('disabled', true);
                        $('#modal-form2 #desc').css('background-color', '#fcfdff');
                        $('#modal-form2 #user_id').prop('disabled', true);
                        $('#modal-form2 #user_id').css('background-color', '#fcfdff');
                        $('#modal-form2 #job_id').addClass('disabled')  //disable class
                            .prop({disabled: true});
                        // $('.lihatsurat').data('id', data.id);
                        $('#modal-form2 #loading1').hide();
                        $('#modal-form2 .editform').hide();
                        $('#modal-form2 .lihatform').show();

                        $('#modal-form2 .hapussurat').attr('onclick', 'hapussurat(' + data.id + ')');
                        $('#berubah').show();
                    } else {
                        $('#modal-form2 #name').prop('disabled', false);
                        $('#modal-form2 #name').css('background-color', '#ffffff');
                        $('#modal-form2 #singkatan').prop('disabled', false);
                        $('#modal-form2 #singkatan').css('background-color', '#ffffff');
                        $('#modal-form2 #job_id').prop('disabled', false);
                        $('#modal-form2 #job_id').css('background-color', '#ffffff');
                        $('#modal-form2 #desc').prop('disabled', false);
                        $('#modal-form2 #desc').css('background-color', '#ffffff');
                        // $('#modal-form2 #user_id').prop('disabled',false);
                        // $('#modal-form2 #user_id').css('background-color', '#ffffff');
                        $('#loading1').hide();
                        $('.lihatform').hide();
                        $('.editform').show();
                        $('#modal-form2 #job_id').removeClass('disabled')  //disable class
                            .prop({disabled: false});
                    }
                    $job_id += '  <option value="" disabled="true">Pilih Seksi</option>';
                    for ($x = 0, $y = data.ids.length; $x < $y; $x++) {
                        if (data.ids[$x] == data.select) {
                            $job_id += '<option value="' + data.ids[$x] + '" selected>' + data.names[$x] + '</option>\n';
                        }
                        else {
                            $job_id += '<option value="' + data.ids[$x] + '">' + data.names[$x] + '</option>\n';
                        }
                    }

                    $('#modal-form2 #id').val(data.id);
                    $('#modal-form2 #name').val(data.name);
                    $('#modal-form2 #singkatan').val(data.singkatan);
                    $('#modal-form2 #job_id').val(data.job_id);
                    $('#modal-form2 #desc').val(data.desc);
                    $('#modal-form2 #user_id').val(data.user);
                    $('#modal-form2 #job_id').empty().append($job_id);
                    if ($status == 0) {
                        $('#modal-form2').modal('show');
                    }
                },
                error: function () {
                    $('#load').hide();
                    $('.content .row').css("opacity", 1);
                    swal({
                        title: 'Oops...',
                        text: 'Something went wrong or data is empty!',
                        type: 'error',
                        timer: '1500'
                    })
                }
            });


        }
    </script>
    {{--edit--}}
    {{--multi function--}}

    {{--calltab--}}

    {{--surat--}}
    <script>
        function changeTitle(id) {
            $index = $(id).data('id');
            $pagi = pagination[prefix + $index];
            $('#surat' + $index + ' table tbody').empty().append('<tr><td colspan="6">loading...</td></tr>');
            $('.content .row').css("opacity", 0.4);
            $('#load').fadeIn(500);
            // search = $('#inputsurat' + $index).val();
            $.ajax({
                url: "{{route('admin.table.surat.api')}}",
                type: "get",
                data: {'id': $index, 'pagination': pagination[prefix + $index], 'search': search[prefix + $index]},
                success: function (data) {
                    console.log(pagination[prefix + $index]);
                    $('.checkall').prop('checked', false);
                    selectsurat = [];
                    $('.box-footer').hide(500);
                    if (data.status == 0) {
                        $('#surat' + $index + ' table tbody').empty().append('<tr><td colspan="6">Data Kosong...</td></tr>').fadeIn(2000);
                        $('.box-footer').hide(500);
                        $('#surat' + $index + ' .checkall').attr("disabled", true);
                        surat = 0;
                    }
                    else {
                        $maxpage = data.pagination;
                        $('#surat' + $index + ' .checkall').removeAttr("disabled");
                        $dataloop = '';
                        console.log(data);
                        $.each(data.list, function (key, value) {
                            $dataloop += '<tr>\n' +
                                '                                                                    <td>\n' +
                                '                                                                        <input type="checkbox"\n' +
                                '                                                                               title="centang ' + value.name + '"\n' +
                                '                                                                               class="ceksurat"\n' +
                                '                                                                               data-id="' + value.id + '"\n' +
                                '                                                                               style="width: 30px">\n' +
                                '                                                                    </td>\n' +
                                '                                                                    <td>' + value.name + '</td>\n' +
                                '                                                                    <td>' + value.singkatan + '</td>\n' +
                                '                                                                    <td>' + value.maker + '</td>\n' +
                                '                                                                    <td>' + value.date + '</td>\n' +
                                '                                                                        <td>\n' +
                                '                                                                            <div class="btn-group">\n' +
                                '                                                                                <button type="button"\n' +
                                '                                                                                        class="btn btn-default lihatsurat"\n' +
                                '                                                                                        data-action="lihat"\n' +
                                '                                                                                        data-id="' + value.id + '"\n' +
                                '                                                                                        data-status="0"\n' +
                                '                                                                                        onclick="lihatsurat(this)">\n' +
                                '                                                                                    Lihat\n' +
                                '                                                                                </button>\n' +
                                '                                                                                <button type="button"\n' +
                                '                                                                                        class="btn btn-default dropdown-toggle"\n' +
                                '                                                                                        data-toggle="dropdown"\n' +
                                '                                                                                        aria-haspopup="true"\n' +
                                '                                                                                        aria-expanded="false">\n' +
                                '                                                                                    <span class="caret"></span>\n' +
                                '                                                                                    <span class="sr-only">Toggle Dropdown</span>\n' +
                                '                                                                                </button>\n' +
                                '                                                                                <ul class="dropdown-menu">\n' +
                                '                                                                                    <li><a href="javascript:void(0)"\n' +
                                '                                                                                           class="lihatsurat"\n' +
                                '                                                                                           data-action="edit"\n' +
                                '                                                                                           data-status="0"\n' +
                                '                                                                                           data-id="' + value.id + '"\n' +
                                '                                                                                           onclick="lihatsurat(this)">Rubah</a>\n' +
                                '                                                                                    </li>\n' +
                                '                                                                                    <li><a href="javascript:void(0)"\n' +
                                '                                                                                           onclick="hapussurat(' + value.id + ')">Hapus</a>\n' +
                                '                                                                                    </li>\n' +
                                '                                                                                </ul>\n' +
                                '                                                                            </div>\n' +
                                '                                                                        </td>\n' +
                                '                                                                </tr>';
                        });
                        // filltable
                        $('#surat' + $index + ' table tbody').empty().append($dataloop).show(1500);
                        // filltable
                        // pagination
                        $dataafter = '';
                        $databefore = '';
                        for ($i = 1; $i <= $maxpage; $i++) {
                            $dataafter += '<button href="javascript:void(0)" data-per="' + $index + '" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                        }
                        if ($maxpage > 5) {
                            if ($pagi > (parseInt($maxpage) - 3)) {
                                $dataafter = '';
                                $databefore = '';
                                for ($i = ($maxpage - 4); $i <= $maxpage; $i++) {
                                    $databefore += '<button href="javascript:void(0)" data-per="' + $index + '" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                                }
                                $dataafter = '<button href="javascript:void(0)" " data-per="' + $index + '" data-action="1" class="pagiLast btn page gradient">1</button>\n' +
                                    '<button href="javascript:void(0)" " data-per="' + $index + '" data-action="' + (parseInt($maxpage) - 5) + '" class="pagiVar1 btn page gradient">..</button>\n' + $databefore;
                            }
                            else if ($pagi > 3) {
                                $dataafter = '';
                                $databefore = '';
                                for ($i = (parseInt($pagi) - 2); $i <= ($pagi + 3); $i++) {
                                    $databefore += '<button href="javascript:void(0)" data-per="' + $index + '" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                                }
                                $dataafter = '<button href="javascript:void(0)" " data-per="' + $index + '" data-action="1" class="pagiLast btn page gradient">1</button>\n' +
                                    '<button href="javascript:void(0)" " data-per="' + $index + '" data-action="' + (parseInt($pagi) - 3) + '" class="pagiVar1 btn page gradient">..</button>\n' + $databefore +
                                    '<button href="javascript:void(0)" " data-per="' + $index + '" data-action="' + ($pagi + 3) + '" class="pagiVar2 btn page gradient">..</button>\n' +
                                    '<button href="javascript:void(0)" " data-per="' + $index + '" data-action="' + $maxpage + '" class="pagiVar2 btn page gradient">' + $maxpage + '</button>\n';
                            }

                            else {
                                $dataafter = '';
                                $databefore = '';
                                for ($i = 1; $i <= 5; $i++) {
                                    $databefore += '<button href="javascript:void(0)" data-per="' + $index + '" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                                }
                                $dataafter = $databefore +
                                    '<button href="javascript:void(0)" " data-per="' + $index + '" data-action="' + 6 + '" class="pagiVar2 btn page gradient">..</button>\n' +
                                    '<button href="javascript:void(0)" " data-per="' + $index + '" data-action="' + $maxpage + '" class="pagiVar2 btn page gradient">' + $maxpage + '</button>\n';
                            }

                        }


                        $('.box-footer').hide(500);
                        surat = 0;
                        if ($maxpage > 1) {
                            surat = 1;
                            $('.box-footer').show(500);
                            $('#pagiuser').hide(500);
                            $('#pagination').show(500);
                            $('#pagination').empty().append('<button href="javascript:void(0)" data-per="' + $index + '" data-action="' + (parseInt($pagi) - 1) + '"\n' +
                                '                                            class="pagiPrevious btn page gradient"><span\n' +
                                '                                                class="fa fa-caret-left"></span></button>\n' + $dataafter +
                                '<button href="javascript:void(0)" data-action="' + (parseInt($pagi) + 1) + '" data-per="' + $index + '" class="pagiNext btn page gradient"><span class="fa fa-caret-right"></span></button>');
                            // pagination
                        }
                        if ($pagi == $maxpage) {
                            $('#pagination .pagiNext').data('action', 1);
                        }
                        else {
                            $('#pagination .pagiNext').data('action', (parseInt($pagi) + 1));
                        }
                        if ($pagi == 1) {
                            $('#pagination .pagiPrevious').data('action', $maxpage);
                        }
                        else {
                            $('#pagination .pagiPrevious').data('action', (parseInt($pagi) - 1));
                        }

                        $pagi2 = $('#pagination .pagi' + $pagi);
                        $pagi2.removeClass('gradient').show(1500);
                        $pagi2.addClass('active').show(1500);
                        $pagi2.prop('disabled', true);
                        $pagi2.siblings().removeClass('active');
                        $pagi2.siblings().addClass('gradient');
                        $pagi2.siblings().prop('disabled', false);
                        // pagination

                    }
                    $('#load').fadeOut(1000);
                    $('.content .row').css("opacity", 1).fadeIn(1000);
                },
                error: function () {
                    $('#load').hide();
                    $('.content .row').css("opacity", 1);
                    swal({
                        title: 'Oops...',
                        text: 'Something went wrong or data is empty!',
                        type: 'error',
                        timer: '1500'
                    })
                }
            });


        }
    </script>
    {{--surat--}}

    {{--calltab--}}
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                Tabel Pengurus
                <small class="tittleopsi">Pengguna</small>
            </h1>
            <ol class="breadcrumb">
                <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                <li><a href="#">Tabel Pengurus</a></li>
                <li class="active tittleopsi">Pengguna</li>
            </ol>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="box" style="height: auto;">
                    {{--<div class="box-header">--}}
                    {{--<h3 class="box-title">Hover Data Table</h3>--}}
                    {{--</div>--}}
                    <!-- /.box-header -->
                        <div class="box-body">
                            <div class="form">
                                <ul class="tab-group">
                                    <li class="tab" id="surat1"><a href="#surat">Surat</a></li>
                                    <li class="tab" id="user1"><a href="#user">Pengguna</a></li>
                                </ul>

                                <div class="tab-content2">
                                    <div id="surat">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#data" id="add"
                                                                  title="Klik tab untuk menambahkan data berkas surat">Tambah
                                                    Jenis Surat</a>
                                            </li>
                                            @foreach($jobCategory as $row)
                                                <li><a data-toggle="tab" href="#surat{{$row->id}}"
                                                       id="lisurat{{$row->id}}"
                                                       data-change="{{$row->name}}" data-id="{{$row->id}}"
                                                       onclick="changeTitle(this)"
                                                       title="Klik tab untuk melihat semua berkas surat {{$row->name}}">{{$row->name}}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content" style="margin-top: 1em">
                                            <div id="data" class="tab-pane fade in active text-center"><br>
                                                <div class="box-header">
                                                    <h4 class="box-title" style="font-size: 20px">Tambah
                                                        Surat</h4>
                                                    <p><em style="font-size: 14px">Isi Formulir Untuk Menambah
                                                            Surat</em></p>
                                                    <div class="box-tools">
                                                        <div class="input-group input-group-sm"
                                                             style="width: 150px;">
                                                            <select placeholder="jumlah" id="jumlah2"
                                                                    class="form-control pull-right"
                                                                    name="jumlah2">
                                                                @for($i=1;$i<=10;$i++)
                                                                    @if($i==3)
                                                                        <option value="{{$i}}" selected> {{$i}} Data
                                                                        </option>
                                                                    @else
                                                                        <option value="{{$i}}"> {{$i}} Data</option>
                                                                    @endif
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <form method="post" class="form-horizontal">
                                                    {{ csrf_field() }} {{ method_field('post') }}
                                                    <div id="isiinputsurat" class="col-md-10 col-md-offset-1">
                                                        @for ($i=0;$i<3;$i++)
                                                            <div class="row form-group has-feedback">
                                                                <div class="col-md-3">
                                                                    <input placeholder="Nama Surat" id="name[]"
                                                                           type="text"
                                                                           class="form-control name"
                                                                           name="name[]"
                                                                           required autofocus>
                                                                </div>
                                                                <div class="col-md-3 ">
                                                                    <input placeholder="Singkatan" id="singkatan[]"
                                                                           type="text"
                                                                           class="form-control singkatan"
                                                                           name="singkatan[]"
                                                                           required autofocus>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <select placeholder="Pilih Seksi" id="job_id[]"
                                                                            class="form-control seksi" data-id="{{$i}}"
                                                                            name="job_id[]"
                                                                            required autofocus>
                                                                        <option value="" selected disabled> Pilih
                                                                            Seksi
                                                                        </option>
                                                                        @foreach($jobCategory as $job)
                                                                            <option value="{{$job->id}}">{{$job->name}}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <textarea placeholder="Detail" title="detail"
                                                                              id="desc[]"
                                                                              class="form-control desc"
                                                                              style="height: 33px"
                                                                              name="desc[]"
                                                                              required autofocus></textarea>
                                                                </div>

                                                            </div>
                                                        @endfor
                                                    </div>
                                                    <br>
                                                    <div class="col-md-10 col-md-offset-1">
                                                        <button type="submit" class="btn btn-block btn-info btn-lg"
                                                                style="margin-bottom: 30px"><em
                                                                    id="berubah">Submit</em>
                                                            <i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"
                                                               id="loading1"></i></button>

                                                    </div>
                                                </form>
                                            </div>

                                            @foreach($jobCategory as $row)
                                                <div id="surat{{$row->id}}" class="tab-pane fade in text-center"><br>

                                                    <div class="row container-fluid">
                                                        <div class="col-md-3">
                                                            <button class="btn btn-default" type="button"
                                                                    data-toggle="tooltip"
                                                                    onclick="multidelete({{$row->id}})"
                                                                    title="pilih data yang akan dihapus terlebih dahulu"
                                                                    readonly="true"><i
                                                                        class="fa fa-trash"></i> Hapus
                                                            </button> &nbsp;
                                                            <button class="btn btn-default" type="button"
                                                                    data-toggle="tooltip"
                                                                    onclick="multiedit({{$row->id}})"
                                                                    title="pilih data yang akan dihapus terlebih dahulu"
                                                                    readonly="true"><i
                                                                        class=" fa fa-edit"></i> Rubah
                                                            </button>
                                                        </div>
                                                        <div class="col-md-6 ">
                                                            <h4 style="font-size: 20px">Daftar
                                                                Jenis Surat</h4>
                                                            <p><em style="font-size: 14px">{{$row->name}}</em></p>
                                                        </div>
                                                        <div class="col-md-2 col-sm-offset-1">
                                                            <div class="input-group input-group-sm"
                                                                 style="width: 150px;">
                                                                <input type="text" name="inputsurat{{$row->id}}"
                                                                       id="inputsurat{{$row->id}}"
                                                                       class="form-control pull-right"
                                                                       placeholder="Cari">

                                                                <div class="input-group-btn">
                                                                    <button type="submit" id="submitsurat{{$row->id}}"
                                                                            class="btn btn-default cariBtn">
                                                                        <i class="fa fa-search"
                                                                           id="carisurat{{$row->id}}"></i>
                                                                        <i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"
                                                                           id="loadingsurat{{$row->id}}"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <br>

                                                    <div class="box-body">
                                                        <div class="table-responsive">
                                                            <table class="table no-margin">
                                                                <thead>
                                                                <tr>
                                                                    <th style="text-align:center"><input type="checkbox"
                                                                                                         data-toggle="tooltip"
                                                                                                         title="centang semua"
                                                                                                         data-id="{{$row->id}}"
                                                                                                         class="checkall"
                                                                                                         style="width: 30px">
                                                                    </th>
                                                                    <th style="text-align:center">Nama</th>
                                                                    <th style="text-align:center">Singkatan</th>
                                                                    <th style="text-align:center">Pembuat</th>
                                                                    <th style="text-align:center">Dibuat</th>
                                                                    <th style="width: 150px"></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!-- /.table-responsive -->
                                                    </div>
                                                </div>
                                        @endforeach
                                        <!-- /.box-body -->
                                            <div class="overlay" id="load" style="display: none">
                                                <img src="{{asset('images/loadingstyle/loadingimg.gif')}}"
                                                     style="width: 30%;height: auto; position: absolute; top: 0; bottom:0; left: 0; right:0; margin: auto;">
                                            </div>

                                        </div>
                                    </div>

                                    <div id="user">
                                        <ul class="nav nav-tabs">
                                            <li class="active"><a data-toggle="tab" href="#data2" data-id="0"
                                                                  onclick="changePenghuni(this)"
                                                                  title="Klik tab untuk menambahkan data Pengguna">Tambah
                                                    Pengguna</a>
                                            </li>
                                            @foreach($jobCategory as $row)
                                                <li><a data-toggle="tab" href="#job{{$row->id}}"
                                                       id="liUser{{$row->id}}"
                                                       data-change="{{$row->name}}" data-id="{{$row->id}}"
                                                       onclick="changePenghuni(this)"
                                                       title="Klik tab untuk melihat semua penghuni {{$row->name}}">{{$row->name}}</a>
                                                </li>
                                            @endforeach
                                            <li><a data-toggle="tab" href="#jobna" data-id="na"
                                                   onclick="changePenghuni(this)"
                                                   title="Klik tab untuk menambahkan data Pengguna">
                                                    Histori
                                                </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" style="margin-top: 1em">
                                            <div id="data2" class="tab-pane fade in active text-center">
                                                <div class="box-header">
                                                    <h4 class="box-title" style="font-size: 20px">Tambah
                                                        Pengguna</h4>
                                                    <p><em style="font-size: 14px">Isi Formulir Untuk Menambah
                                                            Pengguna</em></p>
                                                    <div class="box-tools">
                                                        <div class="input-group input-group-sm"
                                                             style="width: 150px;">
                                                            <select placeholder="jumlah" id="jumlah"
                                                                    class="form-control pull-right"
                                                                    name="jumlah">
                                                                @for($i=1;$i<=10;$i++)
                                                                    @if($i==3)
                                                                        <option value="{{$i}}" selected> {{$i}} Data
                                                                        </option>
                                                                    @else
                                                                        <option value="{{$i}}"> {{$i}} Data</option>
                                                                    @endif
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <form method="post" class="form-horizontal">
                                                    {{ csrf_field() }} {{ method_field('post') }}
                                                    <div id="isiinputuser">
                                                        @for ($i=0;$i<3;$i++)
                                                            <div class="row form-group has-feedback" data-no="{{$i}}">
                                                                <div class="col-md-2 ">
                                                                    <input placeholder="Masukkan NIP" id="nip[]"
                                                                           type="text" onkeypress='numbertok(event)'
                                                                           class="form-control nip"
                                                                           name="nip[]" data-no="{{$i}}"
                                                                           required autofocus>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input placeholder="Nama lengkap" id="name[]"
                                                                           type="text"
                                                                           class="form-control name"
                                                                           name="name[]"
                                                                           required autofocus>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input placeholder="Email" id="email[]"
                                                                           type="email"
                                                                           class="form-control email"
                                                                           name="email[]" data-no="{{$i}}"
                                                                           required autofocus>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <select placeholder="Pilih Seksi" id="job_id[]"
                                                                            class="form-control seksi" data-id="{{$i}}"
                                                                            name="job_id[]"
                                                                            required autofocus>
                                                                        <option value="" selected disabled> Pilih
                                                                            Seksi
                                                                        </option>
                                                                        @foreach(\App\trDataJobDesc::orderBy('name','asc')->get() as $job)
                                                                            <option value="{{$job->id}}">{{$job->name}}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <select placeholder="Pilih Jabatan"
                                                                            id="posisition_id[]"
                                                                            class="form-control opsi jabatan{{$i}}"
                                                                            name="posisition_id[]"
                                                                            required autofocus>
                                                                        <option value="" selected disabled> Pilih
                                                                            Seksi Terlebih Dahulu
                                                                        </option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <select placeholder="Pilih Hak Akses" id="role_id[]"
                                                                            class="form-control hak opsi"
                                                                            name="role_id[]"
                                                                            required autofocus>
                                                                        <option value="" selected disabled> Pilih Hak
                                                                            Akses
                                                                        </option>
                                                                        @foreach(\App\status::orderBy('name','asc')->get() as $status)
                                                                            <option value="{{$status->id}}">{{$status->name}}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        @endfor
                                                    </div>
                                                    <input type="hidden" name="entitySend" id="entitySend" value="3">
                                                    <button type="submit" class="btn btn-block btn-info btn-lg"
                                                            style="margin-bottom: 30px"><em
                                                                id="berubah">Submit</em>
                                                        <i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"
                                                           id="loading1"></i> <em id="progresssurat"></em></button>
                                                </form>
                                            </div>

                                            @foreach($jobCategory as $row)
                                                <div id="job{{$row->id}}" class="tab-pane fade in text-center">
                                                    <div class="row container-fluid">
                                                        <div class="col-md-3">
                                                            <button class="btn btn-default" type="button"
                                                                    data-toggle="tooltip"
                                                                    onclick="multidelete2({{$row->id}})"
                                                                    title="pilih data yang akan dihapus terlebih dahulu"
                                                                    readonly="true"><i
                                                                        class="fa fa-ban"></i> Bekukan
                                                            </button> &nbsp;
                                                            <button class="btn btn-default" type="button"
                                                                    data-toggle="tooltip"
                                                                    onclick="multiedit2({{$row->id}})"
                                                                    title="pilih data yang akan dihapus terlebih dahulu"
                                                                    readonly="true"><i
                                                                        class=" fa fa-edit"></i> Rubah
                                                            </button>
                                                        </div>
                                                        <div class="col-md-6 ">
                                                            <h4 style="font-size: 20px">Daftar
                                                                Jenis Surat</h4>
                                                            <p><em style="font-size: 14px">{{$row->name}}</em></p>
                                                        </div>
                                                        <div class="col-md-2 col-sm-offset-1">
                                                            <div class="input-group input-group-sm"
                                                                 style="width: 150px;">
                                                                <input type="text" name="inputuser{{$row->id}}"
                                                                       id="inputuser{{$row->id}}"
                                                                       class="form-control pull-right"
                                                                       placeholder="Cari">

                                                                <div class="input-group-btn">
                                                                    <button type="submit" id="submituser{{$row->id}}"
                                                                            class="btn btn-default cariBtn2">
                                                                        <i class="fa fa-search"
                                                                           id="cariuser{{$row->id}}"></i>
                                                                        <i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"
                                                                           id="loadinguser{{$row->id}}"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                    <br>

                                                    <div class="box-body">
                                                        <div class="table-responsive">
                                                            <table class="table no-margin">
                                                                <thead>
                                                                <tr>
                                                                    <th style="text-align:center"><input type="checkbox"
                                                                                                         data-toggle="tooltip"
                                                                                                         title="centang semua"
                                                                                                         data-id="{{$row->id}}"
                                                                                                         class="checkall"
                                                                                                         style="width: 30px">
                                                                    </th>
                                                                    <th style="text-align:center">NIP</th>
                                                                    <th style="text-align:center">Nama</th>
                                                                    <th style="text-align:center">Jobdesk</th>
                                                                    <th style="text-align:center">Hak Akses</th>
                                                                    <th style="width: 150px"></th>
                                                                </tr>
                                                                </thead>
                                                                <tbody>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <!-- /.table-responsive -->
                                                    </div>
                                                    <br>

                                                </div>
                                            @endforeach
                                            <div id="jobna" class="tab-pane fade in text-center">
                                                <div class="row container-fluid">
                                                    <div class="col-md-3">
                                                        <button class="btn btn-default" type="button"
                                                                data-toggle="tooltip"
                                                                onclick="resendEmail('na')"
                                                                title="Kirim Ulang ke Email Berdasarkan Pilihan"
                                                                readonly="true"><i
                                                                    class="fa fa-reply-all" data-method="1"></i> Resend
                                                        </button> &nbsp;
                                                        {{--<button class="btn btn-default" type="button"--}}
                                                        {{--data-toggle="tooltip"--}}
                                                        {{--onclick="multiedit2({{$row->id}})"--}}
                                                        {{--title="pilih data yang akan dihapus terlebih dahulu"--}}
                                                        {{--readonly="true"><i--}}
                                                        {{--class=" fa fa-edit"></i> Rubah--}}
                                                        {{--</button>--}}
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <h4 style="font-size: 20px">Daftar
                                                            Histori Pembuatan </h4>
                                                        <p><em style="font-size: 14px">Pengguna</em></p>
                                                    </div>
                                                    <div class="col-md-2 col-sm-offset-1">
                                                        <div class="input-group input-group-sm"
                                                             style="width: 150px;">
                                                            <input type="text" name="inputuserna"
                                                                   id="inputuserna"
                                                                   class="form-control pull-right"
                                                                   placeholder="Cari">

                                                            <div class="input-group-btn">
                                                                <button type="submit" id="submituserna"
                                                                        class="btn btn-default cariBtn2">
                                                                    <i class="fa fa-search"
                                                                       id="cariuserna"></i>
                                                                    <i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"
                                                                       id="loadinguserna"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                                <br>

                                                <div class="box-body">
                                                    <div class="table-responsive">
                                                        <table class="table no-margin">
                                                            <thead>
                                                            <tr>
                                                                <th style="text-align:center"><input type="checkbox"
                                                                                                     data-toggle="tooltip"
                                                                                                     title="centang semua"
                                                                                                     data-id="na"
                                                                                                     class="checkall"
                                                                                                     style="width: 30px">
                                                                </th>
                                                                <th style="text-align:center">NIP</th>
                                                                <th style="text-align:center">Nama</th>
                                                                <th style="text-align:center">Jobdesk</th>
                                                                <th style="text-align:center">Hak Akses</th>
                                                                <th style="text-align:center" >Status</th>
                                                                <th style="width: 150px"></th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <!-- /.table-responsive -->
                                                </div>
                                                <br>
                                            </div>
                                            <div class="overlay" id="load2" style="display: none">
                                                <img src="{{asset('images/loadingstyle/loadingimg.gif')}}"
                                                     style="width: 30%;height: auto; position: absolute; top: 0; bottom:0; left: 0; right:0; margin: auto;">
                                            </div>
                                        </div>
                                    </div>

                                </div><!-- tab-content -->

                            </div> <!-- /form -->
                            {{--tab opsi--}}
                            <script>
                                $cekmasuk = "{{$users}}";
                                // console.log($cekmasuk);
                                if ($cekmasuk == 'user') {
                                    $('#user').show();
                                    $('#surat').hide();
                                    $('#user1').addClass('active');
                                    $('.tittleopsi').text('Pengguna');

                                }
                                else {
                                    $('#user').hide();
                                    $('#surat').show();
                                    $('#surat1').addClass('active');
                                    $('.tittleopsi').text('Surat');
                                }

                                $('.tab-pinggir').on('click', function () {
                                    console.log($(this).data('id'));
                                    nilai_tab = $(this).data('id');
                                    if (nilai_tab == 0) {
                                        $('#user').show();
                                        $('#surat').hide();
                                        $('#user1').addClass('active');
                                        $('#surat1').removeClass('active');
                                        $('.tittleopsi').text('Pengguna');
                                        history.pushState(null, null, '/admin/table/user');

                                    }
                                    else {
                                        $('#user').hide();
                                        $('#surat').show();
                                        $('#surat1').addClass('active');
                                        $('#user1').removeClass('active');
                                        $('.tittleopsi').text('Surat');
                                        history.pushState(null, null, '/admin/table/letter');
                                    }

                                });
                                $('#user1').on('click', function () {
                                    $('.tittleopsi').text('Pengguna');
                                    console.log(pengguna);
                                    $('.fa-envelope').parents('li').removeClass('active');
                                    $('.fa-group').parents('li').addClass('active');
                                    history.pushState(null, null, '/admin/table/user');
                                    $('.pagiuser').hide(500);
                                    if (pengguna == 0) {
                                        $('.box-footer').hide(500);

                                    }
                                    else {
                                        $('.box-footer').show(500);
                                        $('#pagiuser').show(500);
                                        $('#pagination').hide(500);
                                    }
                                });
                                $('#surat1').on('click', function () {
                                    $('.tittleopsi').text('Surat');
                                    $('.fa-group').parents('li').removeClass('active');
                                    $('.fa-envelope').parents('li').addClass('active');

                                    console.log(surat);
                                    history.pushState(null, null, '/admin/table/letter');
                                    if (surat == 0) {
                                        $('.box-footer').hide(500);
                                    }
                                    else {
                                        $('.box-footer').show(500);
                                        $('#pagiuser').hide(500);
                                        $('#pagination').show(500);
                                    }
                                });

                            </script>
                            <br>
                        </div>
                        <script>
                            $('.fa-spin').hide();
                        </script>
                        <!-- /.box-body -->
                        <div class="box-footer clearfix">
                            <center>
                                <div class="pagination0" id="pagination">

                                </div>
                                <div class="pagination0" id="pagiuser">

                                </div>
                            </center>
                        </div>

                    </div>

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

@endsection
@section('script')
    {{--tab--}}
    <script>
        $('.form').find('input, textarea').on('keyup blur focus', function (e) {

            var $this = $(this),
                label = $this.prev('label');

            if (e.type === 'keyup') {
                if ($this.val() === '') {
                    label.removeClass('active highlight');
                } else {
                    label.addClass('active highlight');
                }
            } else if (e.type === 'blur') {
                if ($this.val() === '') {
                    label.removeClass('active highlight');
                } else {
                    label.removeClass('highlight');
                }
            } else if (e.type === 'focus') {

                if ($this.val() === '') {
                    label.removeClass('highlight');
                }
                else if ($this.val() !== '') {
                    label.addClass('highlight');
                }
            }

        });

        $('.tab a').on('click', function (e) {

            e.preventDefault();

            $(this).parent().addClass('active');
            $(this).parent().siblings().removeClass('active');

            target = $(this).attr('href');

            $('.tab-content2 > div').not(target).hide();

            $(target).fadeIn(600);

        });
    </script>
    {{--tab--}}
    {{--disableclickright--}}
    {{--<script>--}}
    {{--$('.content-wrapper li').bind("contextmenu", function (e) {--}}
    {{--return false;--}}
    {{--});--}}
    {{--$('.content-wrapper button').bind("contextmenu", function (e) {--}}
    {{--return false;--}}
    {{--});--}}
    {{--$('.content-wrapper .btn-group').bind("contextmenu", function (e) {--}}
    {{--return false;--}}
    {{--});--}}
    {{--$('.content-wrapper .btn').bind("contextmenu", function (e) {--}}
    {{--return false;--}}
    {{--});--}}
    {{--$('.content-wrapper a').bind("contextmenu", function (e) {--}}
    {{--return false;--}}
    {{--});--}}
    {{--</script>--}}
    {{--disableclickright--}}
    {{--calltab--}}
    {{--tambahsurat--}}
    <script>
        $('#add').on('click', function (asd) {
            $('.box-footer').hide()
        });
    </script>
    {{--tambahsurat--}}
    {{--calltab--}}
    {{--modalcek--}}
    <script>
        var $cekmodal = false;

        $('.modal').on('shown.bs.modal', function (e) {
            $(this).hide().show(300);
            $('.lihatsurat').attr('data-status', 1);

            $cekmodal = true;
        });
        $('.modal').on('hidden.bs.modal', function (e) {
            $cekmodal = false;
            $('.lihatsurat').attr('data-status', 0);

        });
    </script>
    {{--modalcek--}}
    {{--pagination--}}
    <script>
        $('#pagination').on('click', '.page', function (asd) {
            $pagi = $(this).data('action');
            $index = $(this).data('per');
            pagination[prefix + $index] = $pagi;
            getData($index, $pagi);
        });
    </script>
    {{--pagination--}}

    {{--checkall--}}
    <script>
        $('#surat').on('change', '.checkall', function (asd) {
            selectsurat = [];
            $id = $(this).data('id');
            var $InputElement = $("#surat" + $id).find(".ceksurat");
            if ($(this).is(':checked')) {
                for ($x = 0, $y = $InputElement.length; $x < $y; $x++) {
                    selectsurat.push($($InputElement[$x]).data('id'));
                }
                $InputElement.prop('checked', true);
                $InputElement.parents('tr').css('background-color', '#c8cace');
            }
            else {
                selectsurat = [];
                $InputElement.prop('checked', false);
                $InputElement.parents('tr').css('background-color', '#ffffff');
            }
        });
    </script>
    {{--checkall--}}

    {{--check some--}}
    <script>
        $('#surat').on('change', '.ceksurat', function (asd) {
            $id = $(this).data('id');
            if ($(this).is(':checked')) {
                selectsurat.push($id);
                $(this).parents('tr').css('background-color', '#c8cace');
            }
            else {
                var delarray = selectsurat.indexOf($id);
                selectsurat.splice(delarray, 1);
                $(this).parents('tr').css('background-color', '#ffffff');
            }

            console.log(selectsurat);
        });
    </script>
    {{--check some--}}


    {{--getdata pagination--}}
    <script>
        function getData($index, $pagi) {
            $('.content .row').css("opacity", 0.4);
            $('#load').fadeIn(500);
            $('#request' + $index + ' table tbody').empty().append('<tr><td colspan="5">loading...</td></tr>');
            $.ajax({
                url: "{{route('admin.table.surat.api')}}",
                type: "get",
                data: {'id': $index, 'pagination': $pagi, 'search': search[prefix + $index]},
                success: function (data) {
                    pagination[prefix + $index] = $pagi;
                    console.log("cobqa" + pagination[prefix + $index]);
                    $('.checkall').prop('checked', false);
                    selectsurat = [];
                    if (data.status == 0) {
                        $('#surat' + $index + ' table tbody').empty().append('<tr><td colspan="6">Data Kosong...</td></tr>').fadeIn(2000);
                        $('#surat' + $index + ' .checkall').attr("disabled", true);
                        surat = 0;
                        $('.box-footer').hide(500);
                    }
                    else {
                        $('#surat' + $index + ' .checkall').removeAttr("disabled");
                        $maxpage = data.pagination;

                        $dataloop = '';
                        console.log(data);
                        $.each(data.list, function (key, value) {
                            $dataloop += '<tr>\n' +
                                '                                                                    <td>\n' +
                                '                                                                        <input type="checkbox"\n' +
                                '                                                                               title="centang ' + value.name + '"\n' +
                                '                                                                               class="ceksurat"\n' +
                                '                                                                               data-id="' + value.id + '"\n' +
                                '                                                                               style="width: 30px">\n' +
                                '                                                                    </td>\n' +
                                '                                                                    <td>' + value.name + '</td>\n' +
                                '                                                                    <td>' + value.singkatan + '</td>\n' +
                                '                                                                    <td>' + value.maker + '</td>\n' +
                                '                                                                    <td>' + value.date + '</td>\n' +
                                '                                                                        <td>\n' +
                                '                                                                            <div class="btn-group">\n' +
                                '                                                                                <button type="button"\n' +
                                '                                                                                        class="btn btn-default lihatsurat"\n' +
                                '                                                                                        data-action="lihat"\n' +
                                '                                                                                        data-id="' + value.id + '"\n' +
                                '                                                                                        data-status="0"\n' +
                                '                                                                                        onclick="lihatsurat(this)">\n' +
                                '                                                                                    Lihat\n' +
                                '                                                                                </button>\n' +
                                '                                                                                <button type="button"\n' +
                                '                                                                                        class="btn btn-default dropdown-toggle"\n' +
                                '                                                                                        data-toggle="dropdown"\n' +
                                '                                                                                        aria-haspopup="true"\n' +
                                '                                                                                        aria-expanded="false">\n' +
                                '                                                                                    <span class="caret"></span>\n' +
                                '                                                                                    <span class="sr-only">Toggle Dropdown</span>\n' +
                                '                                                                                </button>\n' +
                                '                                                                                <ul class="dropdown-menu">\n' +
                                '                                                                                    <li><a href="javascript:void(0)"\n' +
                                '                                                                                           class="lihatsurat"\n' +
                                '                                                                                           data-action="edit"\n' +
                                '                                                                                           data-status="0"\n' +
                                '                                                                                           data-id="' + value.id + '"\n' +
                                '                                                                                           onclick="lihatsurat(this)">Rubah</a>\n' +
                                '                                                                                    </li>\n' +
                                '                                                                                    <li><a href="javascript:void(0)"\n' +
                                '                                                                                           onclick="hapussurat(' + value.id + ')">Hapus</a>\n' +
                                '                                                                                    </li>\n' +
                                '                                                                                </ul>\n' +
                                '                                                                            </div>\n' +
                                '                                                                        </td>\n' +
                                '                                                                </tr>';
                        });
                        // filltable
                        $('#surat' + $index + ' table tbody').empty().append($dataloop).show(1500);
                        // filltable
                        // pagination
                        $dataafter = '';
                        $databefore = '';
                        for ($i = 1; $i <= $maxpage; $i++) {
                            $dataafter += '<button href="javascript:void(0)" data-per="' + $index + '" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                        }
                        if ($maxpage > 5) {
                            if ($pagi > (parseInt($maxpage) - 3)) {
                                $dataafter = '';
                                $databefore = '';
                                for ($i = ($maxpage - 4); $i <= $maxpage; $i++) {
                                    $databefore += '<button href="javascript:void(0)" data-per="' + $index + '" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                                }
                                $dataafter = '<button href="javascript:void(0)" " data-per="' + $index + '" data-action="1" class="pagiLast btn page gradient">1</button>\n' +
                                    '<button href="javascript:void(0)" " data-per="' + $index + '" data-action="' + (parseInt($maxpage) - 5) + '" class="pagiVar1 btn page gradient">..</button>\n' + $databefore;
                            }
                            else if ($pagi > 3) {
                                $dataafter = '';
                                $databefore = '';
                                for ($i = (parseInt($pagi) - 2); $i <= ($pagi + 3); $i++) {
                                    $databefore += '<button href="javascript:void(0)" data-per="' + $index + '" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                                }
                                $dataafter = '<button href="javascript:void(0)" " data-per="' + $index + '" data-action="1" class="pagiLast btn page gradient">1</button>\n' +
                                    '<button href="javascript:void(0)" " data-per="' + $index + '" data-action="' + (parseInt($pagi) - 3) + '" class="pagiVar1 btn page gradient">..</button>\n' + $databefore +
                                    '<button href="javascript:void(0)" " data-per="' + $index + '" data-action="' + ($pagi + 3) + '" class="pagiVar2 btn page gradient">..</button>\n' +
                                    '<button href="javascript:void(0)" " data-per="' + $index + '" data-action="' + $maxpage + '" class="pagiVar2 btn page gradient">' + $maxpage + '</button>\n';
                            }

                            else {
                                $dataafter = '';
                                $databefore = '';
                                for ($i = 1; $i <= 5; $i++) {
                                    $databefore += '<button href="javascript:void(0)" data-per="' + $index + '" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                                }
                                $dataafter = $databefore +
                                    '<button href="javascript:void(0)" " data-per="' + $index + '" data-action="' + 6 + '" class="pagiVar2 btn page gradient">..</button>\n' +
                                    '<button href="javascript:void(0)" " data-per="' + $index + '" data-action="' + $maxpage + '" class="pagiVar2 btn page gradient">' + $maxpage + '</button>\n';
                            }

                        }


                        $('.box-footer').hide(500);
                        surat = 0;
                        if ($maxpage > 1) {
                            surat = 1;
                            $('.box-footer').show(500);
                            $('#pagiuser').hide(500);
                            $('#pagination').show(500);
                            $('#pagination').empty().append('<button href="javascript:void(0)" data-per="' + $index + '" data-action="' + (parseInt($pagi) - 1) + '"\n' +
                                '                                            class="pagiPrevious btn page gradient"><span\n' +
                                '                                                class="fa fa-caret-left"></span></button>\n' + $dataafter +
                                '<button href="javascript:void(0)" data-action="' + (parseInt($pagi) + 1) + '" data-per="' + $index + '" class="pagiNext btn page gradient"><span class="fa fa-caret-right"></span></button>');
                            // pagination
                        }
                        if ($pagi == $maxpage) {
                            $('#pagination .pagiNext').data('action', 1);
                        }
                        else {
                            $('#pagination .pagiNext').data('action', (parseInt($pagi) + 1));
                        }
                        if ($pagi == 1) {
                            $('#pagination .pagiPrevious').data('action', $maxpage);
                        }
                        else {
                            $('#pagination .pagiPrevious').data('action', (parseInt($pagi) - 1));
                        }

                        $pagi2 = $('#pagination .pagi' + $pagi);
                        $pagi2.removeClass('gradient').show(1500);
                        $pagi2.addClass('active').show(1500);
                        $pagi2.prop('disabled', true);
                        $pagi2.siblings().removeClass('active');
                        $pagi2.siblings().addClass('gradient');
                        $pagi2.siblings().prop('disabled', false);
                    }
                    $('#load').fadeOut(1000);
                    $('.content .row').css("opacity", 1).fadeIn(1000);


                },
                error: function () {
                    $('#load').hide();
                    $('.content .row').css("opacity", 1);
                    swal({
                        title: 'Oops...',
                        text: 'Something went wrong or data is empty!',
                        type: 'error',
                        timer: '1500'
                    })
                }
            });

        }
    </script>
    {{--saveedit?--}}
    <script>
        $('#modal-form2 form').on('submit', function (e) {
            $('#berubah').hide();
            $('#loading1').show();
            $('button').prop('disabled', true);
            $('#modal-form2 #name').prop('readonly', true);
            $('#modal-form2 #name').css('background-color', '#fcfdff');
            $('#modal-form2 #singkatan').prop('readonly', true);
            $('#modal-form2 #singkatan').css('background-color', '#fcfdff');
            $('#modal-form2 #job_id').prop('readonly', true);
            $('#modal-form2 #job_id').css('background-color', '#fcfdff');
            $('#modal-form2 #desc').prop('readonly', true);
            $('#modal-form2 #desc').css('background-color', '#fcfdff');
            $('#modal-form2 #user_id').prop('readonly', true);
            $('#modal-form2 #user_id').css('background-color', '#fcfdff');
            $('#modal-form2 form').append('<input type="hidden" value="' + $('#modal-form2 #job_id').val() + '" name="job_id"/>');
            $('#modal-form2 #job_id').addClass('disabled')  //disable class
                .prop({disabled: true, 'name': 'job_id1'});
            $.ajax({
                url: "{{route('admin.table.surat.edit')}}",
                type: "post",
                data: new FormData($('#modal-form2 form')[0]),
                contentType: false,
                processData: false,
                success: function (data) {
                    getData($index, pagination[prefix + $index]);
                    activeform2();
                    $('#modal-form2').modal('hide');
                    swal({
                        title: 'Berhasil!',
                        text: 'Data Jenis Surat Dibuat...',
                        type: 'success',
                        timer: '1500'
                    });

                },
                error: function () {
                    activeform2();
                    swal({
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        type: 'error',
                        timer: '1500'
                    });

                }
            });

            return false;
        });

        // activeall
        function activeform2() {
            $('button').prop('disabled', false);
            $('#modal-form2 #name').prop('readonly', false);
            $('#modal-form2 #name').css('background-color', '#ffffff');
            $('#modal-form2 #singkatan').prop('readonly', false);
            $('#modal-form2 #singkatan').css('background-color', '#ffffff');
            $('#modal-form2 #job_id').prop('readonly', false);
            $('#modal-form2 #job_id').css('background-color', '#ffffff');
            $('#modal-form2 #desc').prop('readonly', false);
            $('#modal-form2 #desc').css('background-color', '#ffffff');
            $('#modal-form2 #user_id').prop('readonly', false);
            $('#modal-form2 #user_id').css('background-color', '#ffffff');
            $('#modal-form2 form').find('input[type="hidden"][name="job_id"]').remove();
            $('#modal-form2 #job_id').removeClass('disabled')  //disable class
                .prop({'name': 'job_id', disabled: false});
            $('#modal-form2 #job_id').css('background-color', '#ffffff');
            $('#berubah').show();
            $('#loading1').hide();
        }

        // activeall
    </script>
    {{--saveedit?--}}

    {{--savemultiedit?--}}
    <script>
        $('#modal-form3 form').on('submit', function (e) {
            $('#berubah2').hide();
            $('#loading2').show();
            $('button').prop('disabled', true);
            $('#modal-form3 input').prop('readonly', true);
            $('#modal-form3 input').css('background-color', '#fcfdff');
            $('#modal-form3 .desc').prop('readonly', true);
            $('#modal-form3 .desc').css('background-color', '#fcfdff');
            $valuejob = $('#modal-form3 form').find('.job_id');
            for ($x = 0, $y = $valuejob.length; $x < $y; $x++) {
                $('#modal-form3 form').append('<input type="hidden" value="' + $($valuejob[$x]).val() + '" name="job_id[]" class="job_id1"/>');
            }
            $('#modal-form3 .job_id').addClass('disabled')  //disable class
                .prop({disabled: true, 'name': 'job_id1[]'});
            $.ajax({
                url: "{{route('admin.table.surat.edit')}}",
                type: "post",
                data: new FormData($('#modal-form3 form')[0]),
                contentType: false,
                processData: false,
                success: function (data) {
                    getData($index, pagination[prefix + $index]);
                    activeform21();
                    console.log(data);
                    $('#modal-form3').modal('hide');
                    swal({
                        title: 'Berhasil!',
                        text: 'Data Jenis Surat Dibuat...',
                        type: 'success',
                        timer: '1500'
                    });

                },
                error: function () {
                    activeform21();
                    swal({
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        type: 'error',
                        timer: '1500'
                    });

                }
            });

            return false;
        });

        // activeall

        function activeform21() {
            $('button').prop('disabled', false);
            $('#modal-form3 input').prop('readonly', false);
            $('#modal-form3 input').css('background-color', '#ffffff');
            $('#modal-form3 .desc').prop('readonly', false);
            $('#modal-form3 .desc').css('background-color', '#ffffff');
            $('#modal-form3 form .job_id1').remove();
            $('#modal-form3 .job_id').removeClass('disabled')  //disable class
                .prop({'name': 'job_id[]', disabled: false});
            $('#modal-form3 .job_id').css('background-color', '#ffffff');
            $('#berubah2').show();
            $('#loading2').hide();
        }

        // activeall
    </script>
    {{--savemultiedit?--}}
    {{--getdata--}}
    {{--tmbahdatasurat--}}
    <script>
        $('#data form').on('submit', function (e) {
            $('#data form #berubah').hide();
            $('#data form #loading1').show();
            $('#data form :input').prop('readonly', true);
            $('#data .seksi').addClass('disabled');
            $('#data .seksi option:not(:selected)').attr('disabled', 'disabled');
            $(':input[type="submit"]').prop('disabled', true);
            $.ajax({
                url: "{{route('admin.table.letter.storesuratplus')}}",
                type: "post",
                data: new FormData($('#data form')[0]),
                contentType: false,
                processData: false,
                success: function (data) {
                    // console.log(data);
                    swal({
                        title: 'Berhasil!',
                        text: 'Data Jenis Surat Dibuat...',
                        type: 'success',
                        timer: '1500'
                    });
                    $('#data form')[0].reset();
                    $('#data form #berubah').show();
                    $('#data form #loading1').hide();
                    $('#data form :input').prop('readonly', false);
                    $('#data .seksi option:not(:selected)').attr('disabled', false);
                    $('#data .seksi').removeClass('disabled');
                    $(':input[type="submit"]').prop('disabled', false);
                },
                error: function () {
                    $("div#divLoading").addClass('hide');
                    $('#loading1').hide();
                    $('#berubah').show();
                    $(':input[type="submit"]').prop('disabled', false);
                    swal({
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        type: 'error',
                        timer: '1500'
                    });

                }
            });

            return false;
        });
    </script>
    {{--tmbahdatasurat--}}
    {{--loop--}}
    {{--surat--}}
    <script>
        $(document).ready(function () {
            var $isiinputsurat = $('#isiinputsurat .row');
            $(document).on('change', '#data #jumlah2', function () {
                $ulang1 = $(this).val();
                $isi1 = '';
                // console.log();
                for ($i = 0; $i < $ulang1; $i++) {
                    $isi1 += '<div class="row form-group has-feedback">' + $isiinputsurat[0].innerHTML + '</div>';
                }
                $('#isiinputsurat').empty().append($isi1).hide().fadeIn('slow');
            });
        });
    </script>
    {{--user--}}
    <script>
        $(document).ready(function () {
            var $isiinputuser = $('#isiinputuser .row');
            var $isiinputuser2 = $('#isiinputuser .row .col-md-2');
//            console.log($isiinputuser.length);
            $(document).on('change', '#jumlah', function () {
                $nip = [];
                $email = [];
                $jabatan = [];
                $seksi = [];
                countSend = $ulang = $(this).val();
                $('#data2 form #entitySend').val($ulang);
                // $nip = '<div class="col-md-2">' + $isiinputuser2.get(0).innerHTML + '</div>';
                $name = '<div class="col-md-2">' + $isiinputuser2.get(1).innerHTML + '</div>';
                // $email = '<div class="col-md-2">' + $isiinputuser2.get(2).innerHTML + '</div>';
                $hak = '<div class="col-md-2">' + $isiinputuser2.get(5).innerHTML + '</div>';
                for ($i = 0; $i < $ulang; $i++) {
                    $nip.push('<div class="col-md-2"><input placeholder="Masukkan NIP" id="nip[]"\n' +
                        '                                                                           type="text" onkeypress=\'numbertok(event)\'\n' +
                        '                                                                           class="form-control nip"\n' +
                        '                                                                           name="nip[]"\n data-no="' + $i + '" ' +
                        '                                                                           required autofocus></div>');
                    $email.push('<div class="col-md-2"><input placeholder="Email" id="email[]"\n' +
                        '                                                                           type="email"\n' +
                        '                                                                           class="form-control email"\n' +
                        '                                                                           name="email[]" data-no="' + $i + '" \n' +
                        '                                                                           required autofocus></div>');
                    $seksi.push('<div class="col-md-2"><select placeholder="Pilih Seksi" id="job_id[]"\n' +
                        '                                                                            class="form-control seksi" data-id="' + $i + '"\n' +
                        '                                                                            name="job_id[]"\n' +
                        '                                                                            required autofocus>' +
                        $isiinputuser.find('.seksi').clone().attr('class', 'form-control seksi').attr('data-id', $i).get(0).innerHTML + '</select></div>');
                    $jabatan.push('<div class="col-md-2"><select placeholder="Pilih Jabatan" id="posisition_id[]"\n' +
                        '                                                                            class="form-control jabatan' + $i + '"\n' +
                        '                                                                            name="posisition_id[]"\n' +
                        '                                                                            required autofocus>' +
                        $isiinputuser.find('.jabatan0').clone().attr('class', 'form-control jabatan' + $i).get(0).innerHTML + '</select></div>');
                }

                $isi = '';
                for ($i = 0; $i < $ulang; $i++) {
                    $isi += '<div class="row form-group has-feedback" data-no="' + $i + '">' + $nip[$i] + $name + $email[$i] + $seksi[$i] + $jabatan[$i] + $hak + '</div>';
                }
                $('#isiinputuser').empty().append($isi).hide().fadeIn('slow');
            });
            $('#isiinputuser').html();
            $('#isiinputuser').on('change', '.seksi', function (asd) {
                $lock = $(this).data('id');
                $("div#divLoading").addClass('show');
                $.ajax({
                    type: 'get',
                    url: '{{route('admin.table.user.getPosisition')}}',
                    data: {'id': $(this).val()},
                    success: function (data) {
                        console.log(data);
                        posi = $('#data2 form .jabatan' + $lock);
                        if (!$.trim(data[0])) {
                            posi.empty().append('<option value="" selected>Data Belum Diisi</option>');
                        }
                        else {
                            posi.html('');
                            posi.append('<option value="" selected disabled>Pilih Jabatan</option>');
                            $.each(data, function (no, value) {
                                posi.append('<option value="' + value.id + '">' + value.name + '</option>');
                            });
                        }
                        posi.addClass('opsi');
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

            });
        });

    </script>
    {{--loop--}}

    {{--function delete--}}

    {{--search--}}
    <script>
        $('.cariBtn').on('click', function () {
            searchsurat();
        });

        function searchsurat() {
            $('#carisurat' + $index).hide();
            $('#loadingsurat' + $index).show();
            if (search[prefix + $index] !== $('#inputsurat' + $index).val()){
                pagination[prefix + $index]=1;
            }
            search[prefix + $index] = $('#inputsurat' + $index).val();
            getData($index, pagination[prefix + $index]);
            $('#loadingsurat' + $index).hide(2000);
            $('#carisurat' + $index).show(2000);
        }
    </script>
    {{--search--}}

    {{--keyup--}}
    <script>
        $(document).keyup(function (e) {
            if ($("#inputsurat" + $index + ":focus") && (e.keyCode === 13)) {
                searchsurat();
            }

        });
    </script>
    {{--keyup--}}
    @include('admin.pengurus.tabUser.table')
@endsection