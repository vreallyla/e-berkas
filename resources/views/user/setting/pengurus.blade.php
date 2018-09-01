@extends('layouts.user.mst_user_relog')
@section('title', 'eBerkas KPP MADYA | Berkas Data')
@section('nav')
    <li><a href="{{url('home')}}">Home</a></li>
@endsection
@section('style')
    <style>

        a {
            text-decoration: none;
            color: maroon;
            -webkit-transition: .5s ease;
            transition: .5s ease;
        }

        a:hover {
            color: red;
        }

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
            background-position:right center;
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

        h1 {
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
@endsection
@section('content')

    <div style="padding: 1em 0;" id="fh5co-contact">

        <div class="container">
            <div class="row">
                <div class="row animate-box">
                    <div class="col-lg-10 col-sm-offset-1  fh5co-set">

                        <div class="w3-panel w3-card">


                            <div style="padding-top: 2%" class="col-lg-12 text-center">
                                <div class="row animate-box">
                                    <h2 style="color:#7D7D7D;"><i style="color:#7D7D7D;"
                                                                  class="fa fa-stack-overflow"></i><em
                                                style="font-size: 25px"> Halaman Admin</em></h2>
                                </div>

                                <div class="form">
                                    <ul class="tab-group">
                                        <li class="tab active"><a href="#surat">Surat</a></li>
                                        <li class="tab"><a href="#user">User</a></li>
                                    </ul>

                                    <div class="tab-content2">
                                        <div id="surat">
                                            <ul class="nav nav-tabs">
                                                <li class="active"><a data-toggle="tab" href="#data"
                                                                      title="Klik tab untuk menambahkan data berkas surat">Tambah
                                                        Jenis Surat</a>
                                                </li>
                                                <li><a data-toggle="tab" href="#daftar"
                                                       title="Klik tab untuk melihat semua berkas surat">Daftar Jenis
                                                        Surat</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content" style="margin-top: 1em">
                                                <div id="data" class="tab-pane fade in active text-center"><br>
                                                    <div class="row form-group">
                                                                    <span class="help-block" id="bantu">
                                                                    </span>
                                                    </div>
                                                    <div class="row form-group">
                                                        <div class="col-md-12">
                                                            <select class="form-control category_id" name="jumlah"
                                                                    id="jumlah"
                                                                    required>
                                                                <option value="1" selected="tr">---- 1 Data ----
                                                                </option>
                                                                @for($i=2;$i<=10;$i++)
                                                                    <option value="{{$i}}">---- {{$i}} Data ----
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div id="jadi-data">
                                                        <form action="" method="post" enctype="multipart/form-data"
                                                              class="form-horizontal"
                                                        >

                                                            {{ csrf_field() }} {{ method_field('post') }}
                                                            <div id="ulang">
                                                                <div class="row form-group has-feedback">
                                                                    <div class="col-md-4">
                                                                        <input placeholder="Nama Jenis Surat"
                                                                               data-tabe="name2"
                                                                               data-id="1"
                                                                               class="form-control name2"
                                                                               id="name[]"
                                                                               name="name[]" required autofocus>

                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <input placeholder="Singkatan Jenis Surat"
                                                                               data-tabe="singkatan2"
                                                                               data-id="2"
                                                                               class="form-control singkatan2"
                                                                               id="singkatan[]"
                                                                               name="singkatan[]" required autofocus>


                                                                    </div>
                                                                    <div class="col-md-4">
                                                                    <textarea placeholder="Detail" style="height: 54px"
                                                                              class="form-control text1"
                                                                              id="desc[]"
                                                                              name="desc[]" required
                                                                              autofocus></textarea>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row form-group">
                                                                <div class="col-lg-12">
                                                                    <button type="submit" id="subm" value="SUBMIT"
                                                                            class="btn btn-primary btn-block">
                                                                        <div id="berubah1">SUBMIT</div>
                                                                        <i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"
                                                                           id="loading1"></i>
                                                                        <span class="sr-only">Loading...</span></button>

                                                                </div>
                                                            </div>
                                                        </form>
                                                    </div>

                                                </div>
                                                <div id="daftar" class="tab-pane fade in text-center"><br>
                                                    <table class="table table-responsive table-bordered table-hover" width="100%"
                                                           id="example1" cellspacing="0">
                                                        <thead>
                                                        <tr>

                                                            <th>
                                                                <center>Nama Jenis Surat</center>
                                                            </th>
                                                            <th>
                                                                <center>Singkatan Jenis Surat</center>
                                                            </th>
                                                            <th>
                                                                <center>Dibuat Tanggal</center>
                                                            </th>
                                                            {{--<th></th>--}}
                                                        </tr>
                                                        </thead>
                                                        <tbody>

                                                        </tbody>

                                                    </table>

                                                </div>
                                            </div>


                                        </div>

                                        <div id="user">
                                            <h1>Welcome Back!</h1>


                                        </div>

                                    </div><!-- tab-content -->

                                </div> <!-- /form -->


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('script')
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
    <script>
        $(document).ready(function () {
            var url1=[];
            url1.push("{{route('user.data')}}");
            $('#loading1').hide();
            $('#bantu').hide();
            $('#example' + 1).DataTable({
                "language": {
                    "lengthMenu": "Menampilkan _MENU_ baris per halaman",
                    "zeroRecords": "Data tidak ditemukan",
                    "info": "Menampilkan halaman ke _PAGE_ dari _PAGES_ halaman",
                    "infoEmpty": "data kosong",
                    "infoFiltered": "(disaring dari _MAX_ berkas)",
                    "search": "Cari:",
                    "paginate": {
                        "previous": "Sebelumnya",
                        "next": "Selanjutnya"
                    }
                },
                processing: true,
                serverSide: true,
                ajax: url1[0],
                columns: [
                    {data: 'name', name: 'name'},
                    {data: 'singkatan', name: 'singkatan'},
                    {data: 'dibuat', name: 'dibuat'}/*,
                    {data: 'action', name: 'action', orderable: false, searchable: false}*/]
            });
            $(document).on('change', '#jumlah', function () {
                var isi = '';
                var deng = $(this).val();

                isi = '';
                for (var i = 1; i <= deng; i++) {
                    if (deng == 1) {
                        isi += '<div class="row form-group has-feedback">\n' +
                            '                                                                    <div class="col-md-4">\n' +
                            '                                                                        <input placeholder="Nama Jenis Surat"\n' +
                            '                                                                               data-tabe="name1"\n' +
                            '                                                                               data-id="1" type="text" \n' +
                            '                                                                               class="form-control name1"\n' +
                            '                                                                               id="name[]"\n' +
                            '                                                                               name="name[]" required autofocus>\n' +
                            '\n' +
                            '                                                                    </div>\n' +
                            '                                                                    <div class="col-md-4">\n' +
                            '                                                                        <input placeholder="Singkatan Jenis Surat"\n' +
                            '                                                                               data-tabe="singkatan1"\n' +
                            '                                                                               data-id="2" type="text" \n' +
                            '                                                                               class="form-control singkatan1"\n' +
                            '                                                                               id="singkatan[]"\n' +
                            '                                                                               name="singkatan[]" required autofocus>\n' +
                            '\n' +
                            '\n' +
                            '                                                                    </div>\n' +
                            '                                                                    <div class="col-md-4">\n' +
                            '                                                                    <textarea placeholder="Detail" style="height: 54px"\n' +
                            '                                                                              class="form-control text1"\n' +
                            '                                                                              id="desc[]"\n' +
                            '                                                                              name="desc[]" required\n' +
                            '                                                                              autofocus></textarea>\n' +
                            '                                                                    </div>\n' +
                            '                                                                </div>';
                    }
                    else {
                        isi += '<div class="row form-group has-feedback">\n' +
                            '                                                                    <div class="col-md-4">\n' +
                            '                                                                        <input placeholder="Nama Jenis Surat '+i+'"\n' +
                            '                                                                               data-tabe="name'+i+'"\n' +
                            '                                                                               data-id="1"\n' +
                            '                                                                               class="form-control name'+i+'"\n' +
                            '                                                                               id="name[]"\n' +
                            '                                                                               name="name[]" required autofocus>\n' +
                            '\n' +
                            '                                                                    </div>\n' +
                            '                                                                    <div class="col-md-4">\n' +
                            '                                                                        <input placeholder="Singkatan Jenis Surat '+i+'"\n' +
                            '                                                                               data-tabe="singkatan'+i+'"\n' +
                            '                                                                               data-id="2"\n' +
                            '                                                                               class="form-control singkatan'+i+'"\n' +
                            '                                                                               id="singkatan[]"\n' +
                            '                                                                               name="singkatan[]" required autofocus>\n' +
                            '\n' +
                            '\n' +
                            '                                                                    </div>\n' +
                            '                                                                    <div class="col-md-4">\n' +
                            '                                                                    <textarea placeholder="Detail '+i+'" style="height: 54px"\n' +
                            '                                                                              class="form-control text1"\n' +
                            '                                                                              id="desc[]"\n' +
                            '                                                                              name="desc[]" required\n' +
                            '                                                                              autofocus></textarea>\n' +
                            '                                                                    </div>\n' +
                            '                                                                </div>';
                    }
                }
                $('#ulang').empty().append(isi);

            });

        });
        var status1 = 0;
        var status2 = 0;
        var isicek1 = '', isicek2 = '';
        $('#ulang').html();
        $('#ulang').on('input',':text',  function (asd) {
            console.log(asd);
            var kodecek = asd.originalEvent.path[0].dataset.id;
            var urutancek = asd.originalEvent.path[0].dataset.tabe;
            var datacek = asd.originalEvent.path[0].value;
            $('.'+urutancek).addClass('loadinglah');

            $.ajax({
                url: "{{route('user.ceksurat')}}",
                type: "get",
                data: {'cek': datacek},
                success: function (data) {

                    if (data.status == 0) {
                        if (kodecek == 1) {
                            isicek1 += '<p>Nama Jenis Surat Sudah Terpakai</p>';
                            status1 = 1;
                        }
                        else {
                            isicek2 += '<p>Singkatan Jenis Surat Sudah Terpakai</p>';
                            status2 = 1;
                        }
                        $( '#jadi-data form input:not(.'+urutancek+')' ).prop('readonly', true);
                        $( '#jadi-data form .text1' ).prop('readonly', true);
                        $('#bantu').empty().append(isicek1 + isicek2);
                        $(':input[type="submit"]').prop('disabled', true);
                        $(':input[type="submit"]').prop('title', 'data sudah ada');
                        $('#bantu').show();

                    }
                    else {
                        if (kodecek == 1) {
                            isicek1 = '';
                            status1 = 0;
                        }
                        else {
                            isicek2 = '';
                            status2 = 0;
                        }
                    }
                    if (status1==0&&status2==0){
                        $( '#jadi-data form input:not(.'+urutancek+')' ).prop('readonly', false);
                        $( '#jadi-data form .text1' ).prop('readonly', false);
                        $(':input[type="submit"]').prop('disabled', false);
                        $(':input[type="submit"]').prop('title', null);
                        $('#bantu').hide();
                    }
                    $('.'+urutancek).removeClass('loadinglah');
                },
                error: function () {
                    $('#loading1').hide();
                    $('#berubah1').show();
                    $(':input[type="submit"]').prop('disabled', false);
                    swal({
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        type: 'error',
                        timer: '1500'
                    })
                }
            });

        });


        $(function () {
            $('#jadi-data form').on('submit', function (e) {
                if (!e.isDefaultPrevented()) {
                    $('#berubah1').hide();
                    $('#loading1').show();
                    $(':input[type="submit"]').prop('disabled', true);


                    $.ajax({
                        url: "{{route('user.suratplus')}}",
                        type: "post",
                        data: new FormData($('#jadi-data form')[0]),
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            console.log(data);
                            $('#jadi-data form')[0].reset();
                            $(':input[type="submit"]').prop('disabled', false);
                            $('#loading1').hide();
                            $('#berubah1').show();
                            if (data.status == 0) {
                                swal({
                                    title: 'Data Sudah Ada!',
                                    text: 'Jenis!',
                                    type: 'success',
                                    timer: '1500'
                                })
                            }
                            else {
                                swal({
                                    title: 'Berhasil!',
                                    text: 'Data berkas telah dibuat!',
                                    type: 'success',
                                    timer: '1500'
                                })
                            }
                        },
                        error: function () {
                            $('#loading1').hide();
                            $('#berubah1').show();
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
    </script>
@endsection