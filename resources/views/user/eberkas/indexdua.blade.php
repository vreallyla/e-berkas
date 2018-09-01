@extends('layouts.user.mst_user_relog')
@section('title', 'eBerkas KPP MADYA | Berkas Data')
@section('nav')
    <li><a href="{{url('home')}}">Home</a></li>
    <li><a href="{{url('profile')}}">Profil</a></li>
    <li><a href="{{url('employes')}}">Daftar Pegawai</a></li>
    <li class="active"><a href="{{url('eBerkas#fh5co-eberkas')}}">eBerkas</a></li>
@endsection
@section('style')
    <style>
        select.disabled {
            background-color: #eae5f2;
        }
    </style>
    <style>
        th.dt-center, td.dt-center {
            text-align: center;
            vertical-align: center;
        }

        p {
            margin: 40px 0 10px;
        }

        .btn-flex {
            display: flex;
            align-items: stretch;
            align-content: stretch;
        }

        .btn-flex .btn:first-child {
            flex-grow: 1;
            text-align: left;
        }

    </style>

    {{--according modify--}}
    <style>


        .set {
            position: relative;
            width: 100%;
            height: auto;
            background-color: #ffffff;
        }

        .set > a {
            display: block;
            padding: 10px 15px;
            text-decoration: none;
            color: #555;
            font-weight: 600;
            border-bottom: 1px solid #ddd;
            -webkit-transition: all 0.2s linear;
            -moz-transition: all 0.2s linear;
            transition: all 0.2s linear;
        }

        .set > a i {
            float: right;
            margin-top: 2px;
        }

        .set > a.active {
            background-color: #f95959;
            color: #fff;
        }
        .set > a:hover {
            background-color: rgba(249, 89, 89, 0.45);
            color: #fff;
        }

        .content {
            background-color: #fff;
            border-bottom: 1px solid #ddd;
            display: none;
        }

        .content p {
            padding: 10px 15px;
            margin: 0;
            color: #333;
            /*}.content tr {*/
            /*padding: 10px 15px;*/
            /*margin: 0;*/
            /*color: #333;*/
            /*}.content a {*/
            /*padding: 10px 15px;*/
            /*margin: 0;*/
            /*!*color: #333;*!*/
        }
    </style>
    {{--according modify--}}

    {{--pagination--}}
    <style>

        .pagination {
            padding: 15px 0;
        }

        .pagination ul {
            margin: 0;
            padding: 0;
            list-style-type: none;
        }

        .pagination a {
            display: inline-block;
            padding: 10px 18px;
            color: #222;
        }

        .p8 a {
            background-color: #f95959;
            margin: auto 5px;
            color: #fff;
            font-weight: bold;
            border: 3px solid #f95959;
        }

        .p8 a:hover {
            background-color: rgba(249, 89, 89, 0.45);
            margin: auto 5px;
            color: #fff;
            font-weight: bold;
            border: 3px solid rgba(249, 89, 89, 0.45);
        }

        .p8 .is-active {
            background-color: #fff;
            color: #f95959;
        }

    </style>
    {{--pagination--}}
@endsection
@section('content')
    {{--initialization--}}
    <script>
        var pagination = {};
        var search = {};
        var page = {};
        var prefix = 'surat';
        var index = '';
        pagination[prefix + 'sampah'] = 1;
        search[prefix + 'sampah'] = '';
        page[prefix + 'sampah'] = 10;
        pagination[prefix + 'semua'] = 1;
        search[prefix + 'semua'] = '';
        page[prefix + 'semua'] = 10;
        @foreach($category as $row)
            pagination[prefix + '{{$row->id}}'] = 1;
        search[prefix + '{{$row->id}}'] = '';
        page[prefix + '{{$row->id}}'] = 10;
                @endforeach
        var selectsurat = [];

    </script>
    {{--initialization--}}


    <aside id="fh5co-hero" class="js-fullheight">
        <div class="flexslider js-fullheight">
            <ul class="slides">
                <li style="background-image: url({{asset('images/about.jpeg')}});">
                    <div class="overlay-gradient"></div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-8 col-md-offset-2 text-center js-fullheight slider-text">
                                <div class="slider-text-inner">
                                    <h1>Tambah Berkas</h1>
                                    <p class="fh5co-lead">We are excited for accepting your Archieves</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </aside>
    <br><br>


    <div id="fh5co-eberkas">
        <div class="container">
            <div class="row">

                <div class="row animate-box">
                    <div class="col-md-8 col-md-offset-2 text-center fh5co-heading" style="margin-bottom: 3em">
                        <h2><i class="fa fa-history"></i> Riwayat Berkas</h2>
                    </div>
                </div>

                <div class="row animate-box">
                    <div class="col-lg-12 text-center" style="margin-bottom: 3em">

                        <ul class="nav nav-tabs">
                            <li class="active"><a data-id="3" data-toggle="tab" href="#data" onclick="ambilData(this)"
                                                  title="Klik tab untuk menambahkan data berkas surat">Tambah Data</a>
                            </li>

                            <li><a data-id="2" data-toggle="tab" href="#suratsemua" onclick="ambilData(this)"
                                   title="Klik tab untuk melihat semua berkas surat">Semua</a>
                            </li>

                            @foreach($category as $row)
                                <li><a data-id="0" data-id2="{{$row->id}}" data-toggle="tab" href="#surat{{$row->id}}"
                                       onclick="ambilData(this)"
                                       title="Klik tab untuk melihat berkas {{$row->name}} ">{{$row->singkatan}}</a>
                                </li>
                            @endforeach

                            <li><a data-id="1" data-toggle="tab" href="#suratsampah" onclick="ambilData(this)"
                                   title="Klik tab untuk melihat semua berkas surat">Sampah</a>
                            </li>


                        </ul>
                        <div class="tab-content" id="fill-content" style="margin-top: 1em">
                            <div id="data" class="tab-pane fade in active text-center"><br>
                                <h3>- Tambah Berkas Surat -</h3>
                                <div class="row form-group">
                                    <div class="col-lg-12">
                                        <select class="form-control" name="jumlah" id="jumlah"
                                                required>
                                            @for($i=1;$i<=10;$i++)
                                                @if($i==3)
                                                    <option value="{{$i}}" selected>---- {{$i}} Data ----</option>

                                                @else
                                                    <option value="{{$i}}">---- {{$i}} Data ----</option>
                                                @endif
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <br>

                                <div id="jadi-data">
                                    <form method="post" class="form-horizontal">
                                        {{ csrf_field() }} {{ method_field('post') }}
                                        <div id="isiinputsurat" class="col-lg-12">
                                            @for ($i=0;$i<3;$i++)
                                                <div class="row form-group has-feedback">
                                                    <div class="col-md-2 ">
                                                        <input placeholder="input data" class="form-control addfile"
                                                               type="file"
                                                               id="file[0][]" name="file[]" multiple required
                                                               autofocus>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input placeholder="Kode Surat" class="form-control"
                                                               id="name[]"
                                                               name="name[]" required autofocus>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <input placeholder="Kode Berkas" class="form-control"
                                                               id="kode[]"
                                                               name="kode[]" required autofocus>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <select class="form-control category_id"
                                                                name="category_id[]"
                                                                id="category_id[]" required>
                                                            <option value="" disabled selected>- Pilih Kategori
                                                                Surat -
                                                            </option>
                                                            @foreach($category as $row)
                                                                <option value="{{$row->id}}">{{$row->name}}
                                                                    ({{$row->singkatan}})
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                            <textarea class="form-control" placeholder="Keterangan"
                                                                      id="desc[]"
                                                                      name="desc[]" style="height: 54px"></textarea>
                                                    </div>


                                                </div>
                                            @endfor
                                        </div>
                                        <br>
                                        <div class="col-md-10 col-md-offset-1">
                                            <button type="submit" class="btn btn-block btn-primary btn-lg"
                                                    style="margin-bottom: 30px"><em
                                                        id="berubah1">Submit</em>
                                                <i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"
                                                   id="loading1"></i></button>

                                        </div>
                                    </form>


                                </div>

                            </div>

                            <div id="suratsemua" class="tab-pane fade in text-center">
                                <br>
                                <div id="table2-data">
                                    {{--<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">--}}
                                        {{ csrf_field() }} {{ method_field('post') }}
                                        <input type="hidden" name="metode" id="metode" class="metode">
                                        <div class="row container-fluid">
                                            <div class="col-md-4" style="margin-top: 5px; padding-left: 40px">

                                                <button class="btn btn-primary" type="button"
                                                        data-toggle="tooltip" data-method="1"
                                                        onclick="multiDelete(this)"
                                                        title="Hapus Banyak"
                                                        readonly="true">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                                <button class="btn btn-primary" type="button"
                                                        data-toggle="tooltip"
                                                        onclick="multiEdit('semua')"
                                                        title="Ubah Banyak"
                                                        readonly="true">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </div>
                                            <div class="col-md-4">
                                                <h3 style="margin-top: 10px">- Data Semua Surat -</h3>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row container-fluid">
                                                    <div class="col-md-2 col-md-offset-1">
                                                        <select name="page" class="form-control page" id="page"
                                                                {{--data-id="semua"--}}
                                                                style="width: 90px">
                                                            <option value="10">10</option>
                                                            <option value="25">25</option>
                                                            <option value="50">50</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="input-group input-group-sm"
                                                             style="width: 250px;margin-left: 34px">
                                                            <input type="text" name="inputsuratsemua"
                                                                   id="inputsuratsemua"
                                                                   class="form-control"
                                                                   style="height: 47px; font-size: 14px "
                                                                   placeholder="Cari">

                                                            <div class="input-group-btn">
                                                                <button href="javascript:void(0)" id="submitsurat"
                                                                        type="button"
                                                                        class="btn btn-primary cariBtn"
                                                                        style="height: 47px;">
                                                                    <i class="fa fa-search"
                                                                       id="carisuratsemua"></i>
                                                                    <i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"
                                                                       id="loadingsuratsemua"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <table class="table table-responsive table-bordered table-hover" width="100%"
                                               id="example2" cellspacing="0">
                                            <thead>
                                            <tr>

                                                <th style="text-align:center" width="20px"><input type="checkbox"
                                                                                                  data-toggle="tooltip"
                                                                                                  title="centang semua"
                                                                                                  data-id="semua"
                                                                                                  class="checkall"
                                                                                                  style="width: 30px">
                                                <th>
                                                    <center>Kode Berkas</center>
                                                </th>
                                                <th>
                                                    <center>Kode Surat</center>
                                                </th>
                                                <th>
                                                    <center>Jenis Surat</center>
                                                </th>
                                                <th>
                                                    <center>Pengirim</center>
                                                </th>
                                                <th>
                                                    <center>Dibuat Tanggal</center>
                                                </th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>

                                        </table>
                                    {{--</form>--}}
                                </div>
                            </div>

                            <div id="suratsampah" class="tab-pane fade in text-center">
                                <br>
                                <div id="table2-data">
                                    {{--<form action="" method="post" enctype="multipart/form-data" class="form-horizontal">--}}
                                        {{ csrf_field() }} {{ method_field('post') }}
                                        <input type="hidden" name="metode" id="metode" class="metode">
                                        <div class="row container-fluid">
                                            <div class="col-md-4" style="margin-top: 5px; padding-left: 40px">
                                                <button data-toggle="tooltip" title="Hapus Permanen Banyak"
                                                        value="delete"
                                                        type="button" data-method="2"
                                                        onclick="multiDelete(this)"
                                                        data-limit="delete" id="delete"
                                                        class="btn btn-primary">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                                <button data-toggle="tooltip" title="Pulihkan Banyak" value="restore"
                                                        type="button"
                                                        data-limit="restore"
                                                        class="btn btn-primary restore">
                                                    <i class="fa fa-reply"></i>
                                                </button>
                                            </div>
                                            <div class="col-md-4">
                                                <h3 style="margin-top: 10px">- Data Sampah -</h3>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="row container-fluid">
                                                    <div class="col-md-2 col-md-offset-1">
                                                        <select name="page" class="form-control page" id="page"
                                                                {{--data-id="sampah"--}}
                                                                style="width: 90px">
                                                            <option value="10">10</option>
                                                            <option value="25">25</option>
                                                            <option value="50">50</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="input-group input-group-sm"
                                                             style="width: 250px;margin-left: 34px">
                                                            <input type="text" name="inputsuratsampah"
                                                                   id="inputsuratsampah"
                                                                   class="form-control"
                                                                   style="height: 47px; font-size: 14px "
                                                                   placeholder="Cari">

                                                            <div class="input-group-btn">
                                                                <button id="submitsurat" href="javascript:void(0)"
                                                                        type="button"
                                                                        class="btn btn-primary cariBtn"
                                                                        style="height: 47px;">
                                                                    <i class="fa fa-search"
                                                                       id="carisuratsampah"></i>
                                                                    <i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"
                                                                       id="loadingsuratsampah"></i></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <br>

                                        <table class="table table-responsive table-bordered table-hover" width="100%"
                                               id="example1" cellspacing="0">
                                            <thead>
                                            <tr>

                                                <th style="text-align:center" width="20px"><input type="checkbox"
                                                                                                  data-toggle="tooltip"
                                                                                                  title="centang semua"
                                                                                                  data-id="sampah"
                                                                                                  class="checkall"
                                                                                                  style="width: 30px">
                                                <th>
                                                    <center>Kode Berkas</center>
                                                </th>
                                                <th>
                                                    <center>Kode Surat</center>
                                                </th>
                                                <th>
                                                    <center>Jenis Surat</center>
                                                </th>
                                                <th>
                                                    <center>Penghapus</center>
                                                </th>
                                                <th>
                                                    <center>Dihapus Tanggal</center>
                                                </th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            </tbody>

                                        </table>
                                    {{--</form>--}}
                                </div>
                            </div>

                            @foreach($category as $row)
                                <div id="surat{{$row->id}}" class="tab-pane fade in text-center">
                                    <br>
                                    <div id="table2-data">
                                        {{--<form action="" method="post" enctype="multipart/form-data"--}}
                                              {{--class="form-horizontal">--}}
                                            {{ csrf_field() }} {{ method_field('post') }}
                                            <input type="hidden" name="metode" id="metode" class="metode">
                                            <div class="row container-fluid">
                                                <div class="col-md-4" style="margin-top: 5px; padding-left: 40px">

                                                    <button class="btn btn-primary" type="button"
                                                            data-toggle="tooltip" data-method="1"
                                                            onclick="multiDelete(this)"
                                                            title="Hapus Banyak"
                                                            readonly="true">
                                                        <i class="fa fa-times"></i>
                                                    </button>
                                                    <button class="btn btn-primary" type="button"
                                                            data-toggle="tooltip"
                                                            onclick="multiEdit({{$row->id}})"
                                                            title="Ubah Banyak"
                                                            readonly="true">
                                                        <i class="fa fa-edit"></i>
                                                    </button>
                                                </div>
                                                <div class="col-md-4">
                                                    <h3 style="margin-top: 10px">- Data {{$row->name}} -</h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="row container-fluid">
                                                        <div class="col-md-2 col-md-offset-1">
                                                            <select name="page" class="form-control page" id="page"
                                                                    {{--data-id="0" data-id2="{{$row->id}}"--}}
                                                                    style="width: 90px">
                                                                <option value="10">10</option>
                                                                <option value="25">25</option>
                                                                <option value="50">50</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="input-group input-group-sm"
                                                                 style="width: 250px;margin-left: 34px">
                                                                <input type="text" name="inputsurat{{$row->id}}"
                                                                       id="inputsurat"
                                                                       class="form-control"
                                                                       style="height: 47px; font-size: 14px "
                                                                       placeholder="Cari">

                                                                <div class="input-group-btn">
                                                                    <button id="submitsurat" href="javascript:void(0)"
                                                                            type="button"
                                                                            class="btn btn-primary cariBtn"
                                                                            style="height: 47px;">
                                                                        <i class="fa fa-search"
                                                                           id="carisurat{{$row->id}}"></i>
                                                                        <i class="fa fa-circle-o-notch fa-spin fa-1x fa-fw"
                                                                           id="loadingsurat{{$row->id}}"></i></button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>


                                            <table class="table table-responsive table-bordered table-hover"
                                                   width="100%"
                                                   id="example1" cellspacing="0">
                                                <thead>
                                                <tr>

                                                    <th style="text-align:center" width="20px"><input type="checkbox"
                                                                                                      data-toggle="tooltip"
                                                                                                      title="centang semua"
                                                                                                      data-id="{{$row->id}}"
                                                                                                      class="checkall"
                                                                                                      style="width: 30px">
                                                    </th>
                                                    <th>
                                                        <center>Kode Berkas</center>
                                                    </th>
                                                    <th>
                                                        <center>Kode Surat</center>
                                                    </th>
                                                    <th>
                                                        <center>Pengirim</center>
                                                    </th>
                                                    <th>
                                                        <center>Dibuat</center>
                                                    </th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>

                                            </table>
                                        {{--</form>--}}
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="box-footer container">
                            <div class="pagination p8">
                                <ul id="targerPagi">
                                    <a class="is-active" href="#">
                                        <li><</li>
                                    </a>
                                    <a href="#">
                                        <li>></li>
                                    </a>
                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>
    @include('user.eberkas.formdua')
@endsection
@section('script')
    <script>
        $('.box-footer').hide();
        $('#jadi-data form #loading1').hide();
        $('#jadi-data form #berubah1').show();
        $('.fa-spin').hide();
        console.log(pagination);
    </script>

    {{--loopadd--}}
    <script>
        $('#data').on('change', '#jumlah', function (asd) {
            selectsurat = [];
            var $isiinputsurat = $('#isiinputsurat .row').clone();
            $entity = $(this).val();
            console.log($('#isiinputuser'));
            $isi = '';
            // console.log();
            $('#isiinputsurat').empty();
            for ($i = 0; $i < $entity; $i++) {
                $('#isiinputsurat').append('<div class="row form-group has-feedback add' + $i + '">' + $isiinputsurat[0].innerHTML + '</div>').hide();
                $('#isiinputsurat .add' + $i + ' .addfile').attr('name', 'file[' + $i + '][]');
            }
            $('#isiinputsurat').fadeIn('slow');
        });
    </script>
    {{--loopadd--}}

    {{--addsurat--}}
    <script>
        $(function () {
            $('#jadi-data form').on('submit', function (e) {
                if (!e.isDefaultPrevented()) {
                    $('#jadi-data form #loading1').show();
                    $('#jadi-data form #berubah1').hide();
                    $(':input').prop('readonly', true);
                    $(':button[type="submit"]').prop('disabled', true);
                    $category_id = $('#jadi-data form').find('.category_id');
                    for ($x = 0, $y = $category_id.length; $x < $y; $x++) {
                        $('#jadi-data form').append('<input type="hidden" value="' + $($category_id[$x]).val() + '" name="category_id[]" class="category_id1"/>');
                    }
                    $('#jadi-data form .category_id').addClass('disabled')  //disable class
                        .prop({disabled: true, 'name': 'job_id1[]'});
                    $.ajax({
                        url: "{{route('eberkas.store')}}",
                        type: "post",
                        data: new FormData($('#jadi-data form')[0]),
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            console.log(data);
                            activeformadd();
                            swal({
                                title: 'Berhasil!',
                                text: 'Data Jenis Surat Dibuat...',
                                type: 'success',
                                timer: '1500'
                            });
                            $('#jadi-data form')[0].reset();

                        },
                        error: function () {
                            activeformadd();
                            swal({
                                title: 'Oops...',
                                text: 'Something went wrong!',
                                type: 'error',
                                timer: '1500'
                            });

                        }
                    });

                    return false;
                }
            });

            function activeformadd() {
                $('#jadi-data form .category_id1').remove();
                $('#jadi-data .category_id').removeClass('disabled')  //disable class
                    .prop({'name': 'category_id[]', disabled: false});
                $('#jadi-data .category_id').css('background-color', '#ffffff');
                $('#jadi-data form #loading1').hide();
                $('#jadi-data form #berubah1').show();
                $(':input').prop('readonly', false);
                $(':button[type="submit"]').prop('disabled', false);
            }
        });
    </script>
    {{--addsurat--}}
    {{--changetab--}}
    <script>
        function ambilData(e) {
            index = $(e).data('id');


            if (index == 1) {
                $id = 'sampah';
            }
            else if (index == 2) {
                $id = 'semua';
            }
            else {
                $id = $(e).data('id2');
            }

            if (index == 3) {

                $('.box-footer').hide();
            }
            else {
                getData($id);
            }

        }

    </script>
    {{--changetab--}}

    {{--getdata--}}
    <script>
        function getData($id) {
            $table = $('#surat' + $id + ' table');
            $checkall = $('#surat' + $id + ' .checkall');
            $table.hide();
            $.ajax({
                url: "{{route('eberkas.api')}}",
                type: "get",
                data: {
                    'index': index,
                    'id': $id,
                    'pagination': pagination[prefix + $id],
                    'search': search[prefix + $id],
                    'page': page[prefix + $id]
                },
                success: function (data) {
                    console.log(index);
                    console.log(data);
                    $checkall.prop('checked', false);
                    selectsurat = [];
                    if (data.status == 0) {
                        if (index == 0) {
                            $loopsurat = '<tr><td colspan="6">Data Kosong</td></tr>';
                            $checkall.prop('disabled', true);
                        }
                        else {
                            $loopsurat = '<tr><td colspan="7">Data Kosong</td></tr>';
                            $checkall.prop('disabled', true);
                        }
                        $('.box-footer').hide(500);
                    }
                    else {
                        $maxpage = data.maxpage;
                        $pagi=data.pagi;
                        $checkall.prop('disabled', false);
                        $loopsurat = '';
                        $.each(data.data, function (key, value) {
                            $filesurat = [];
                            $.each(value.relation, function (key2, value2) {
                                $filesurat += '<li><a href="{!!URL::to('/')!!}/' + value2.url + '" target="_blank">' + value2.name + '</a></li>\n';
                            });
                            $opsimenu = '<td>' +
                                '<div class="btn-group">\n' +
                                '        <button type="button" class="btn btn-primary" href="javascript:void(0)" data-id="' + value.id + '" data-role="lihat" data-method="1" onclick="showForm(this)">Lihat</button>\n' +
                                '        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"\n' +
                                '        >\n' +
                                '            <span class="caret"></span>\n' +
                                '            <span class="sr-only">Toggle Dropdown</span>\n' +
                                '        </button>\n' +
                                '        <ul class="dropdown-menu">\n' +
                                '            <li><a data-id="' + value.id + '" data-method="1" href="javascript:void(0)" data-role="edit" onclick="showForm(this)">Rubah</a></li>\n' +
                                '            <li><a data-id="' + value.id + '" data-method="1" href="javascript:void(0)" onclick="deleteData(this)">Hapus</a></li>\n' +
                                '            <li><a data-id="' + value.id + '" data-method="1" href="javascript:void(0)" onclick="historiData(this)">Histori</a></li>\n' +
                                '            <li role="separator" class="divider"></li>\n' +
                                '            \n' + $filesurat +
                                '            \n' +
                                '        </ul>\n' +
                                '    </div>' +
                                '</td>';
                            $opsimenu2 = '<td>' +
                                '<div class="btn-group">\n' +
                                '        <button type="button" class="btn btn-primary" href="javascript:void(0)" data-id="' + value.id + '" data-role="lihat" data-method="2" onclick="showForm(this)">Lihat</button>\n' +
                                '        <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"\n' +
                                '        >\n' +
                                '            <span class="caret"></span>\n' +
                                '            <span class="sr-only">Toggle Dropdown</span>\n' +
                                '        </button>\n' +
                                '        <ul class="dropdown-menu">\n' +
                                '            <li><a data-id="' + value.id + '" data-method="2" href="javascript:void(0)" onclick="restoreData(' + value.id + ')">Pulihkan</a></li>\n' +
                                '            <li><a data-id="' + value.id + '" data-method="2" href="javascript:void(0)" onclick="deleteData(this)">Hapus</a></li>\n' +
                                '            <li><a data-id="' + value.id + '" data-method="1" href="javascript:void(0)" onclick="historiData(this)">Histori</a></li>\n' +
                                '            <li role="separator" class="divider"></li>\n' +
                                '            \n' + $filesurat +
                                '            \n' +
                                '        </ul>\n' +
                                '    </div>' +
                                '</td>';
                            if (index == 0) {
                                $replace = '<td> <a href="javascript:void(0)" onclick="showUser(' + value.user_id + ')">' + value.user + '</a> </td>' +
                                    '<td> ' + value.date + ' </td>' + $opsimenu;
                            }
                            else if (index == 1) {
                                $replace = '<td> ' + value.category + ' </td>' +
                                    '<td> <a href="javascript:void(0)" onclick="showUser(' + value.userdel_id + ')">' + value.userdel + '</a> </td>' +
                                    '<td> ' + value.date2 + ' </td>' + $opsimenu2;
                            }
                            else if (index == 2) {
                                $replace = '<td> ' + value.category + ' </td>' +
                                    '<td> <a href="javascript:void(0)" onclick="showUser(' + value.user_id + ')">' + value.user + '</a> </td>' +
                                    '<td> ' + value.date + ' </td>' + $opsimenu;

                            }
                            $loopsurat += '<tr>' +
                                '<td>' +
                                '                                                                        <input type="checkbox"\n' +
                                '                                                                               title="centang ' + value.name + '"\n' +
                                '                                                                               class="ceksurat"\n' +
                                '                                                                               data-id="' + value.id + '"\n' +
                                '                                                                               style="width: 30px">\n' +
                                '</td>' +
                                '<td> ' + value.kode + ' </td>' +
                                '<td> ' + value.name + ' </td>' + $replace +
                                '</tr>';
                        });

                        $dataafter = '';
                        $databefore = '';
                        for ($i = 1; $i <= $maxpage; $i++) {
                            $dataafter += '<a href="javascript:void(0)" data-per="' + $id + '" data-action="' + $i + '" class="page pagi' + $i + '" >\n' +
                                '                                        <li>'+$i+'</li>\n' +
                                '                                    </a>';
                        }
                        if ($maxpage > 5) {
                            if ($pagi > (parseInt($maxpage) - 3)) {
                                $dataafter = '';
                                $databefore = '';
                                for ($i = ($maxpage - 4); $i <= $maxpage; $i++) {
                                    $databefore += '<a href="javascript:void(0)" data-per="' + $id + '" data-action="' + $i + '" class="page pagi' + $i + '" >\n' +
                                        '                                        <li>'+$i+'</li>\n' +
                                        '                                    </a>';
                                }
                                $dataafter = '<a href="javascript:void(0)" data-per="' + $id + '" data-action="1" class="page pagiLast" >\n' +
                                    '                                        <li>1</li>\n' +
                                    '                                    </a>\n'+
                                    '<a href="javascript:void(0)" data-per="' + $id + '" data-action="' + (parseInt($maxpage) - 5) + '" class="page pagiVar1" >\n' +
                                    '                                        <li>...</li>\n' +
                                    '                                    </a>\n'+ $databefore;
                            }
                            else if ($pagi > 3) {
                                $dataafter = '';
                                $databefore = '';
                                for ($i = (parseInt($pagi) - 2); $i <= ($pagi + 3); $i++) {
                                    $databefore +=  '<a href="javascript:void(0)" data-per="' + $id + '" data-action="' + $i + '" class="page pagi' + $i + '" >\n' +
                                        '                                        <li>'+$i+'</li>\n' +
                                        '                                    </a>\n';
                                }
                                $dataafter =  '<a href="javascript:void(0)" data-per="' + $id + '" data-action="1" class="page pagiLast" >\n' +
                                    '                                        <li>1</li>\n' +
                                    '                                    </a>\n'+
                                    '<a href="javascript:void(0)" data-per="' + $id + '" data-action="' + (parseInt($pagi) - 3) + '" class="page pagiVar1" >\n' +
                                    '                                        <li>...</li>\n' +
                                    '                                    </a>\n' + $databefore +
                                    '<a href="javascript:void(0)" data-per="' + $id + '" data-action="' + (parseInt($pagi) + 3) + '" class="page pagiVar2" >\n' +
                                    '                                        <li>...</li>\n' +
                                    '                                    </a>\n' +
                                    '<a href="javascript:void(0)" data-per="' + $id + '" data-action="' +$maxpage + '" class="page pagiVar2" >\n' +
                                    '                                        <li>'+$maxpage+'</li>\n' +
                                    '                                    </a>\n';
                            }

                            else {
                                $dataafter = '';
                                $databefore = '';
                                for ($i = 1; $i <= 5; $i++) {
                                    $databefore +=  '<a href="javascript:void(0)" data-per="' + $id + '" data-action="' + $i + '" class="page pagi' + $i + '" >\n' +
                                        '                                        <li>'+$i+'</li>\n' +
                                        '                                    </a>\n';
                                }
                                $dataafter = $databefore +
                                    '<a href="javascript:void(0)" data-per="' + $id + '" data-action="' + (parseInt($pagi) + 3) + '" class="page pagiVar2" >\n' +
                                    '                                        <li>...</li>\n' +
                                    '                                    </a>\n' +
                                    '<a href="javascript:void(0)" data-per="' + $id + '" data-action="' +$maxpage + '" class="page pagiVar2" >\n' +
                                    '                                        <li>'+$maxpage+'</li>\n' +
                                    '                                    </a>\n';
                            }

                        }
                        $('.box-footer').hide(500);

                        if ($maxpage > 1) {
                            surat = 1;
                            $('.box-footer').show(500);
                            $('.box-footer #targerPagi').empty().append('<a href="javascript:void(0)" data-per="' + $id + '" data-action="' + (parseInt($pagi) - 1) + '" class="pagiPrevious page" >\n' +
                                '                                        <li><span class="fa fa-caret-left"></span></li>\n' +
                                '                                    </a>' + $dataafter +
                                '<a href="javascript:void(0)" data-per="' + $id + '" data-action="' + (parseInt($pagi) + 1) + '" class="pagiNext page" >\n' +
                                '                                        <li><span class="fa fa-caret-right"></span></li>\n' +
                                '                                    </a>');
                            // pagination
                        }
                        console.log($dataafter);
                        if ($pagi == $maxpage) {
                            $('#targerPagi .pagiNext').data('action', 1);
                        }
                        else {
                            $('#targerPagi .pagiNext').data('action', (parseInt($pagi) + 1));
                        }
                        if ($pagi == 1) {
                            $('#targerPagi .pagiPrevious').data('action', $maxpage);
                        }
                        else {
                            $('#targerPagi .pagiPrevious').data('action', (parseInt($pagi) - 1));
                        }

                        $pagi2 = $('#targerPagi .pagi' + $pagi);
                        $pagi2.addClass('is-active').show(1500);
                        $pagi2.prop('disabled', true);
                        $pagi2.siblings().removeClass('is-active');
                        $pagi2.siblings().prop('disabled', false);
                    }
                    $('#surat' + $id + ' table tbody').empty().append($loopsurat);
                    $table.fadeIn('slow');

                },
                error: function () {
                    $checkall.prop('disabled', true);
                    $('#surat' + $id + ' table tbody').empty().append('<tr><td colspan="6">Data error</td></tr>');
                    $table.fadeIn('slow');
                    // $('#load').hide();
                    // $('.content .row').css("opacity", 1);
                    selectsurat = [];
                    swal({
                        title: 'Oops...',
                        text: 'Something went wrong or data is empty!',
                        type: 'error',
                        timer: '1500'
                    })
                }
            });

        }
        // pagination

        $('#targerPagi').on('click', '.page', function (asd) {
            $id = $(this).data('per');
            pagination[prefix + $id] = $(this).data('action');
            getData($id, $pagi);
        });

    // pagination
    </script>
    {{--getdata--}}
    {{--multidelete--}}
    <script>
        $('.restore').on('click', function (asd) {
            if (selectsurat.length > 0) {
                restoreData(selectsurat);
            }
            else {
                swalInfo('Notice!', 'Select some data....');
            }

            return false;
        });
    </script>

    {{--multidelete--}}

    {{--selectdata--}}
    <script>
        $('.container').on('change', '.ceksurat', function (asd) {
            if ($(this).is(':checked')) {
                selectsurat.push($(this).data('id'));
                $(this).parents('tr').css('background-color', '#e6e8ec');
            }
            else {
                var delarray = selectsurat.indexOf($id);
                selectsurat.splice(delarray, 1);
                $(this).parents('tr').css('background-color', '#ffffff');
            }
            console.log(selectsurat);
        });
    </script>
    {{--selectdata--}}

    {{--checkall--}}
    <script>
        $('#fill-content').on('change', '.checkall', function (asd) {
            selectsurat = [];
            $id = $(this).data('id');
            var $InputElement = $("#surat" + $id).find(".ceksurat");
            if ($(this).is(':checked')) {
                for ($x = 0, $y = $InputElement.length; $x < $y; $x++) {
                    selectsurat.push($($InputElement[$x]).data('id'));
                }
                $InputElement.prop('checked', true);
                $InputElement.parents('tr').css('background-color', '#e6e8ec');
            }
            else {
                selectsurat = [];
                $InputElement.prop('checked', false);
                $InputElement.parents('tr').css('background-color', '#ffffff');
            }
            console.log(selectsurat);
        });
    </script>
    {{--checkall--}}

    {{--focustr--}}
    <script>

    </script>
    {{--focustr--}}
    {{--notifselect--}}
    <script>
        function notifnull() {
            swal({
                title: 'Alert!',
                text: 'Pilih beberapa data.',
                type: 'info',
                timer: '1500'
            })
        }

        function notifsuccess($notif) {
            swal({
                title: 'Berhasil!',
                text: 'Data berhasil di ' + $notif + '.',
                type: 'success',
                timer: '1500'
            })
        }

        function notiferror() {
            swal({
                title: 'Error!',
                text: 'Data tidak ada atau terjadi kesalahan.',
                type: 'error',
                timer: '1500'
            })
        }
    </script>
    {{--notifselect--}}

    {{--show user--}}
    <script>
        function showUser($c) {
            $('#modal-form-user form')[0].reset();
            $.ajax({
                type: 'get',
                url: '{!!URL::to('employes/caridata/')!!}',
                data: {'id': $c},
                success: function (data) {
                    console.log(data);
                    $('#modal-form-user').modal('show');
                    $('.modal-title').text('Biodata Pegawai');
                    if (!$.trim(data.ava)) {
                        $('#modal-form-user #ava').attr('src', '{!!URL::to('images/avatar.png')!!}');
                    }
                    else {
                        $('#modal-form-user #ava').attr('src', '{!!URL::to('/')!!}' + '/' + data.ava);
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
                    if (data.softdel == 0) {
                        trHTML += '<tr><td width="60px">Status Akun</td><td>:&nbsp;</td><td>Aktif</td></tr>';
                    }
                    else {
                        trHTML += '<tr><td width="60px">Status Akun</td><td>:&nbsp;</td><td>Nonaktif Sejak ' + data.softdel + '</td></tr>';
                    }
                    trHTML += '<tr><td width="60px" valign="top">Deskripsi</td><td valign="top">:&nbsp;</td><td align="justify" >' + data.bio + '</td></tr>';
                    $('#modal-form-user #location').empty().append(trHTML);

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
    {{--show user--}}

    {{--multi function--}}
    <script>
        function multiDelete(id) {
            // console.log(id);
            if (selectsurat.length > 0) {
                deleteSurat(selectsurat, $(id).data("method"))
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

        function multiEdit(id) {
            console.log(id);
            if (selectsurat.length > 0) {
                $.ajax({
                    url: "{{route('eberkas.show')}}",
                    type: "get",
                    data: {'id': selectsurat},
                    success: function (data) {
                        console.log(data);
                        $selectMulti = '';
                        $('#modal-form-multiple').modal('show');
                        $labelmulti = $('#modal-form-multiple ').find('.loopmulti').clone().get(0).innerHTML;
                        $('#modal-form-multiple form #fill').empty();
                        $.each(data.listss, function (key, value) {
                            $('#modal-form-multiple form #fill').append('<div class="row container-fluid loopmulti keyi' + key + '">' + $labelmulti + '</div>');
                            $('#modal-form-multiple .keyi' + key + ' #id').val(value.id);
                            $('#modal-form-multiple .keyi' + key + ' #kode').val(value.kode);
                            $('#modal-form-multiple .keyi' + key + ' #name').val(value.name);
                            $('#modal-form-multiple .keyi' + key + ' #desc').val(value.desc);
                            $selectMulti += '<option value="" selected disabled>--Pilih Kategori--</option>';
                            $.each(data.category_list, function (no, nilai) {
                                if (nilai.id == value.category_id) {
                                    $selectMulti += '<option value="' + nilai.id + '" selected>' + nilai.name + '</option>';
                                }
                                else {
                                    $selectMulti += '<option value="' + nilai.id + '">' + nilai.name + '</option>';
                                }
                            });
                            $('#modal-form-multiple .keyi' + key + ' #category_id').append($selectMulti);

                        });


                    },
                    error: function () {
                        swalError('Oops...', 'Something went wrong or data is empty!');
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
    {{--multi function--}}

    {{--change page range--}}
    <script>
        $('#fill-content').on('change', '.page', function (asd) {
            page[prefix + $id] = $(this).val();
            pagination[prefix + $id] = 1;
            getData($id);
        });
    </script>
    {{--change page range--}}

    {{--keyup--}}
    <script>
        $(document).keyup(function (e) {
            if ($("#inputsurat" + $id + ":focus") && (e.keyCode === 13)) {
                searchsurat();
            }

        });
    </script>
    {{--keyup--}}

    {{--search something--}}
    <script>
        $('.cariBtn').on('click', function () {
            searchsurat();
        });

        function searchsurat() {
            $('#carisurat' + $id).hide();
            $('#loadingsurat' + $id).show();
            if (search[prefix + $id] !== $('#inputsurat' + $id).val()) {
                pagination[prefix + $id] = 1;
            }
            search[prefix + $id] = $('#inputsurat' + $id).val();
            getData($id);
            $('#loadingsurat' + $id).hide(2000);
            $('#carisurat' + $id).show(2000);
            return false;
        }
    </script>
    {{--search something--}}

    {{--delete data--}}
    <script>
        function deleteData(e) {
            $methodDelete = $(e).data("method");
            if ($methodDelete == 1) {
                $('#modal-form').modal('hide');
            }
            deleteSurat($(e).data("id"), $methodDelete);

        }

        function deleteSurat(eId, metode) {
            $methodDelete = metode;
            swal({
                title: 'Konfirmasi Keamanan',
                html:
                    '<input id="swal-input1" placeholder="Masukkan Password" type="password" class="form-control mb-1">',
                showCancelButton: true,
                confirmButtonText: 'Submit',
                showLoaderOnConfirm: true,
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ya!',
                preConfirm: function () {
                    return new Promise(function (resolve) {

                        resolve([
                            $('#swal-input1').val()
                        ])
                    })
                },
                allowOutsideClick: false
            }).then(function (isConfirm) {
                var password = $('#swal-input1').val();
                if (isConfirm.value) {
                    $.ajax({
                        type: 'get',
                        url: '<?php echo e(route('user.cek')); ?>',
                        data: {'id': password},
                        success: function (data) {
                            if (data.status == 0) {
                                swalInfo('Cek Password!', 'Password belum diisi!');
                            }
                            else if (data.status == 1) {
                                if ($methodDelete == 2) {
                                    $noticedel = 'Data akan hapus permanen!';
                                } else {
                                    $noticedel = 'Data akan dipindah ke tab sampah!';
                                }
                                swal({
                                    title: 'Hapus Data?',
                                    text: $noticedel,
                                    type: 'warning',
                                    showCancelButton: true,
                                    cancelButtonColor: '#d33',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Ya!'
                                }).then(function (isConfirm) {
                                    if (!$.trim(isConfirm.dismiss)) {
                                        $.ajax({
                                            url: "<?php echo e(route('eberkas.delete')); ?>",
                                            type: "GET",
                                            data: {'id': eId, 'metode': $methodDelete},
                                            success: function (data) {
                                                // $('#location').empty();
                                                // $('.modal-footer').empty();
                                                swalSuccess('Berhasil!', 'Data dipindahkan ke tab sampah!');
                                                if ($methodDelete == 2) {
                                                    swalSuccess('Berhasil!', 'Data Terhapus');
                                                }

                                                getData($id);
                                            },
                                            error: function () {
                                                swalError('Oops...', 'something wrong!');
                                            }
                                        });
                                    }
                                });
                            } else {
                                swal({
                                    title: 'Password Salah!',
                                    text: 'Harap masukkan password dengan benar!',
                                    type: 'error',
                                    timer: '1500'
                                })
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
                return false;
            });

            return false;
        }
    </script>
    {{--delete data--}}

    {{--restore data--}}
    <script>
        function restoreForm(e) {

        }
    </script>
    {{--restore data--}}

    {{--lihat edit--}}
    <script>
        function showForm(e) {
            $showRole = $(e).data("role");
            $showMetode = $(e).data("method");
            $.ajax({
                url: "{{route('eberkas.show')}}",
                type: "get",
                data: {'id': $(e).data("id"), 'metode': $showMetode},
                success: function (data) {
                    console.log(data);
                    if ($showMetode > 0) {
                        loadShow(data);
                        $('#modal-form-see').modal('show');
                    }
                    if ($showRole == 'lihat') {
                        $('#modal-form-see .contentshow').attr('disabled', true);
                        $('#modal-form-see .contentshow').css('background-color', '#ffffff');
                        $('#modal-form-see .btn-save').hide();
                        $('#modal-form-see .editFile').hide();
                        $('#modal-form-see .uploadfile').hide();
                        $('#modal-form-see .lihatsurat').show();
                        $('#modal-form-see .hapussurat').show();
                        $('#modal-form-see #deleteBerkas').empty().append('Berkas:');

                    }
                    else if ($showRole == 'edit') {
                        $('#modal-form-see .contentshow').attr('disabled', false);
                        $('#modal-form-see .btn-save').show();
                        $('#modal-form-see .editFile').show();
                        $('#modal-form-see .uploadfile').show();
                        $('#modal-form-see .lihatsurat').hide();
                        $('#modal-form-see .hapussurat').hide();
                        $('#modal-form-see #deleteBerkas').empty().append('Hapus Berkas:');
                    }
                    else {
                        swalError('Peringatan!', 'Perintah Tidak Terdaftar');
                    }

                },
                error: function () {
                    swalError('Oops...', 'Something went wrong or data is empty!');
                }
            });

        }

        function loadShow(e) {
            $('#modal-form-see form')[0].reset();
            $('#modal-form-see #kode').val(e.kode);
            $('#modal-form-see #id').val(e.id);
            $('#modal-form-see #desc').val(e.desc);
            $('#modal-form-see #name').val(e.name);
            $('#modal-form-see #name').val(e.name);
            $('#modal-form-see #user_id').css('background-color', '#ffffff');
            $('#modal-form-see #user_id').val(e.user_id);
            $('#modal-form-see #changeUser').empty().append('Dibuat Oleh:');

            $selectShow = '';
            $selectShow += '<option value="" disabled>- Pilih Kategori - </option>';
            $.each(e.job_list, function (key, value) {
                if (value.id == e.job_id) {
                    $selectShow += '<option value="' + value.id + '" selected>' + value.name + '</option>';
                }
                else {
                    $selectShow += '<option value="' + value.id + '">' + value.name + '</option>';

                }
            });
            $contentFile = '';
            if (e.file.length > 0) {
                $.each(e.file, function (key, value) {
                    $contentFile += '<input type="checkbox" value="' + value.id + '" class="editFile" name="hapus[]">' +
                        '<a target="_blank" href="{!!URL::to('/')!!}/' + value.url + '" class="contentFile">' + value.name + '</a><br>';

                });
            }
            else {
                $contentFile = 'Berkas Kosong';
            }
            console.log($contentFile + ' ddd');
            $('#modal-form-see #contentBerkas').empty().append($contentFile);
            $('#modal-form-see #category_id').empty().append($selectShow);
            $('#modal-form-see .lihatsurat').empty().append('Edit');
            $('#modal-form-see .lihatsurat').attr('data-id', e.id);
            $('#modal-form-see .lihatsurat').attr('data-role', 'edit');
            $('#modal-form-see .lihatsurat').attr('onclick', 'showForm(this)');
            $('#modal-form-see .lihatsurat').removeAttr('data-dismiss');
            $('#modal-form-see .hapussurat').attr('data-id', e.id);
            $('#modal-form-see .hapussurat').attr('data-method', 1);
            if ($.trim(e.userdel)) {
                $('#modal-form-see .lihatsurat').empty().append('Pulihkan');
                $('#modal-form-see .lihatsurat').attr('data-role', 'pulihkan');
                $('#modal-form-see .lihatsurat').attr('onclick', 'restoreData(' + e.id + ')');
                $('#modal-form-see .lihatsurat').attr('data-dismiss', 'modal');
            }
            if ($.trim(e.userdel)) {
                $('#modal-form-see #user_id').val(e.userdel);
                $('#modal-form-see #changeUser').empty().append('Dihapus Oleh:');
                $('#modal-form-see .hapussurat').attr('data-method', 2);
            }

        }
    </script>
    {{--lihat edit--}}

    {{--save edit--}}
    <script>
        $(function () {
            $('#modal-form-see form').on('submit', function (e) {

                if (!e.isDefaultPrevented()) {
                    $('#modal-form-see').modal('hide');
                    swal({
                        title: 'Konfirmasi Keamanan',
                        html:
                            '<input id="swal-input1" placeholder="Masukkan Password" type="password" class="form-control mb-1">',
                        showCancelButton: true,
                        confirmButtonText: 'Submit',
                        showLoaderOnConfirm: true,
                        showCancelButton: true,
                        cancelButtonColor: '#d33',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ya!',
                        preConfirm: function () {
                            return new Promise(function (resolve) {

                                resolve([
                                    $('#swal-input1').val()
                                ])
                            })
                        },
                        allowOutsideClick: false
                    }).then(function (isConfirm) {
                        var password = $('#swal-input1').val();
                        if (isConfirm.value) {
                            $.ajax({
                                type: 'get',
                                url: '<?php echo e(route('user.cek')); ?>',
                                data: {'id': password},
                                success: function (data) {
                                    if (data.status == 0) {
                                        swal({
                                            title: 'Cek Password!',
                                            text: 'Password belum diisi!',
                                            type: 'info',
                                            timer: '1500'
                                        })
                                    }
                                    else if (data.status == 1) {
                                        $.ajax({
                                            url: "{{route('eberkas.update')}}",
                                            type: "post",
                                            data: new FormData($('#modal-form-see form')[0]),
                                            contentType: false,
                                            processData: false,
                                            success: function (data) {
                                                console.log(data);
                                                getData($id);
                                                if (data == 0) {
                                                    swal({
                                                        title: 'Notice!',
                                                        text: 'Data tidak ada perubahan...',
                                                        type: 'info',
                                                        timer: '1500'
                                                    });
                                                }
                                                else {
                                                    swal({
                                                        title: 'Berhasil!',
                                                        text: 'Data telah dirubah...',
                                                        type: 'success',
                                                        timer: '1500'
                                                    });
                                                }

                                                $('#jadi-data form')[0].reset();

                                            },
                                            error: function () {

                                                swal({
                                                    title: 'Oops...',
                                                    text: 'Something went wrong!',
                                                    type: 'error',
                                                    timer: '1500'
                                                });

                                            }
                                        });
                                    } else {
                                        swal({
                                            title: 'Password Salah!',
                                            text: 'Harap masukkan password dengan benar!',
                                            type: 'error',
                                            timer: '1500'
                                        })
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
                        return false;
                    });

                    return false;
                }
            });
            $('#modal-form-multiple form').on('submit', function (e) {

                if (!e.isDefaultPrevented()) {
                    $('#modal-form-multiple').modal('hide');
                    swal({
                        title: 'Konfirmasi Keamanan',
                        html:
                            '<input id="swal-input1" placeholder="Masukkan Password" type="password" class="form-control mb-1">',
                        showCancelButton: true,
                        confirmButtonText: 'Submit',
                        showLoaderOnConfirm: true,
                        showCancelButton: true,
                        cancelButtonColor: '#d33',
                        confirmButtonColor: '#3085d6',
                        confirmButtonText: 'Ya!',
                        preConfirm: function () {
                            return new Promise(function (resolve) {

                                resolve([
                                    $('#swal-input1').val()
                                ])
                            })
                        },
                        allowOutsideClick: false
                    }).then(function (isConfirm) {
                        var password = $('#swal-input1').val();
                        if (isConfirm.value) {
                            $.ajax({
                                type: 'get',
                                url: '<?php echo e(route('user.cek')); ?>',
                                data: {'id': password},
                                success: function (data) {
                                    if (data.status == 0) {
                                        swal({
                                            title: 'Cek Password!',
                                            text: 'Password belum diisi!',
                                            type: 'info',
                                            timer: '1500'
                                        })
                                    }
                                    else if (data.status == 1) {
                                        $.ajax({
                                            url: "{{route('eberkas.multiupdate')}}",
                                            type: "post",
                                            data: new FormData($('#modal-form-multiple form')[0]),
                                            contentType: false,
                                            processData: false,
                                            success: function (data) {
                                                console.log(data);
                                                getData($id);
                                                if (data == 0) {
                                                    swal({
                                                        title: 'Notice!',
                                                        text: 'Data tidak ada perubahan...',
                                                        type: 'info',
                                                        timer: '1500'
                                                    });
                                                }
                                                else {
                                                    swal({
                                                        title: 'Berhasil!',
                                                        text: 'Data telah dirubah...',
                                                        type: 'success',
                                                        timer: '1500'
                                                    });
                                                }

                                                $('#jadi-data form')[0].reset();

                                            },
                                            error: function () {

                                                swal({
                                                    title: 'Oops...',
                                                    text: 'Something went wrong!',
                                                    type: 'error',
                                                    timer: '1500'
                                                });

                                            }
                                        });
                                    } else {
                                        swal({
                                            title: 'Password Salah!',
                                            text: 'Harap masukkan password dengan benar!',
                                            type: 'error',
                                            timer: '1500'
                                        })
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
                        return false;
                    });

                    return false;
                }
            });
        });
    </script>
    {{--save edit--}}

    {{--restore--}}
    <script>
        function restoreData(e) {
            $('#modal-form-multiple').modal('hide');
            console.log(e);
            $dataRestore = e;
            swal({
                title: 'Konfirmasi Keamanan',
                html:
                    '<input id="swal-input1" placeholder="Masukkan Password" type="password" class="form-control mb-1">',
                showCancelButton: true,
                confirmButtonText: 'Submit',
                showLoaderOnConfirm: true,
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ya!',
                preConfirm: function () {
                    return new Promise(function (resolve) {

                        resolve([
                            $('#swal-input1').val()
                        ])
                    })
                },
                allowOutsideClick: false
            }).then(function (isConfirm) {
                var password = $('#swal-input1').val();
                if (isConfirm.value) {
                    $.ajax({
                        type: 'get',
                        url: '<?php echo e(route('user.cek')); ?>',
                        data: {'id': password},
                        success: function (data) {
                            if (data.status == 0) {
                                swalInfo('Cek Password!', 'Password belum diisi!');
                            }
                            else if (data.status == 1) {

                                swal({
                                    title: 'Pulihkan Data?',
                                    text: 'Data akan kembali ke tab sebelumnya',
                                    type: 'warning',
                                    showCancelButton: true,
                                    cancelButtonColor: '#d33',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Ya!'
                                }).then(function (isConfirm) {
                                    if (!$.trim(isConfirm.dismiss)) {
                                        $.ajax({
                                            url: "<?php echo e(route('eberkas.restore')); ?>",
                                            type: "GET",
                                            data: {'id': $dataRestore},
                                            success: function (data) {
                                                console.log(data);
                                                swalSuccess('Berhasil!', 'Data dipindahkan ke tab sampah!');
                                                getData($id);
                                            },
                                            error: function () {
                                                swalError('Oops...', 'something wrong!');
                                            }
                                        });
                                    }
                                });
                            } else {
                                swal({
                                    title: 'Password Salah!',
                                    text: 'Harap masukkan password dengan benar!',
                                    type: 'error',
                                    timer: '1500'
                                })
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
                return false;
            });

            return false;
        }
    </script>
    {{--restore--}}

    {{--histori--}}
    <script>
        function historiData(e) {
            $methodHistori = $(e).data('method');
            $idHistori = $(e).data('id');
            $.ajax({
                url: "<?php echo e(route('eberkas.history')); ?>",
                type: "GET",
                data: {'id': $idHistori, 'metode': $methodHistori},
                success: function (data) {
                    // $('#location').empty();
                    // $('.modal-footer').empty();
                    console.log(data);
                    $labelmulti = '<a href="javascript:void(0)" class="judul-spoiler" onclick="spoiler(this)">\n' +
                        '                                            {{--Vestibulum--}}\n' +
                        '                                            {{--<i class="fa fa-plus"></i>--}}\n' +
                        '                                        </a>\n' +
                        '                                        <div class="content">\n' +
                        '                                            <div class="row container-fluid has-feedback">\n' +
                        '\n' +
                        '                                                <div class="col-md-6 hapus-file">\n' +
                        '                                                    <b>Hapus Data</b> <br>\n' +
                        '                                                    <span id="fill-hapus">Data telah dihapus</span>\n' +
                        '                                                </div>\n' +
                        '                                                <div class="col-md-6 res-file">\n' +
                        '                                                    <b>Pulihkan Data</b> <br>\n' +
                        '                                                    <span id="fill-res">Data telah dipulihkan</span>\n' +
                        '                                                </div>\n' +
                        '                                                <div class="col-md-6 add-file">\n' +
                        '                                                    <b>Tambah Berkas</b> <br>\n' +
                        '                                                    <div id="fill-add">\n' +
                        '                                                        <a href="#">dasdasd</a><br>\n' +
                        '                                                        <a href="#">dasdasd</a><br>\n' +
                        '\n' +
                        '                                                    </div>\n' +
                        '                                                </div>\n' +
                        '                                                <div class="col-md-6 del-file">\n' +
                        '                                                    <b>Hapus Berkas</b> <br>\n' +
                        '                                                    <div id="fill-del">\n' +
                        '                                                        <a href="#">dasdasd</a><br>\n' +
                        '                                                        <a href="#">dasdasd</a><br>\n' +
                        '                                                        <a href="#">dasdasd</a><br>\n' +
                        '                                                    </div>\n' +
                        '                                                </div>\n' +
                        '                                                <div class="col-md-6 edit-data">\n' +
                        '                                                    <b>Rubah Data</b>\n' +
                        '                                                    <table>\n' +
                        '                                                        <tr>\n' +
                        '                                                            <td style="width: 100px" valign="top">Kode Berkas</td>\n' +
                        '                                                            <td style="width: 10px" valign="top">:</td>\n' +
                        '                                                            <td id="fill-kode">Datto</td>\n' +
                        '                                                        </tr>\n' +
                        '                                                        <tr>\n' +
                        '                                                            <td style="width: 45px" valign="top">Kode Surat</td>\n' +
                        '                                                            <td valign="top">:</td>\n' +
                        '                                                            <td id="fill-name">Datto</td>\n' +
                        '                                                        </tr>\n' +
                        '                                                        <tr>\n' +
                        '                                                            <td style="width: 45px" valign="top">Kategori</td>\n' +
                        '                                                            <td valign="top">:</td>\n' +
                        '                                                            <td id="fill-kategori">Datto</td>\n' +
                        '                                                        </tr>\n' +
                        '                                                        <tr>\n' +
                        '                                                            <td style="width: 45px" valign="top">Detail</td>\n' +
                        '                                                            <td valign="top">:</td>\n' +
                        '                                                            <td id="fill-desc">Datto</td>\n' +
                        '                                                        </tr>\n' +
                        '                                                    </table>\n' +
                        '                                                </div>\n' +
                        '                                            </div>\n' +
                        '                                        </div>';
                    if (data.status == 0) {
                        $labelmulti = '<span>Data Histori Kosong</span>';
                        console.log('aaaaaa');
                    }
                    console.log($labelmulti);
                    $('#modal-form-spoiler form #fill').empty().append('');

                    if (!$.trim(data.ava)) {
                        $('#modal-form-spoiler form #fill').append($labelmulti);

                    }
                    $fileadds = '';

                    $.each(data.lists, function (key, v) {
                        $fillDels = '';
                        $fillAdds = '';
                        $.each(v.listAdd, function (key2, v2) {
                            $fillAdds += '<a href="' + v2.url + '" target="_blank">' + v2.name + '</a><br>\n';
                        });
                        $.each(v.listDel, function (key3, v3) {
                            $fillDels += '<a href="' + v3.url + '" target="_blank">' + v3.name + '</a><br>\n';
                        });

                        $('#modal-form-spoiler form #fill').append('<div class="set loopmulti spoiler' + key + '">' + $labelmulti + '</div>');
                        $contenthistori = '';
                        if (v.del == 1) {
                            $('#modal-form-spoiler .spoiler' + key + ' .hapus-file').show();
                            $contenthistori += ' Hapus Data |';
                        }
                        else {
                            $('#modal-form-spoiler .spoiler' + key + ' .hapus-file').hide();
                        }

                        if (v.res == 1) {
                            $('#modal-form-spoiler .spoiler' + key + ' .res-file').show();
                            $contenthistori += ' Pulihkan Data |';
                        }
                        else {
                            $('#modal-form-spoiler .spoiler' + key + ' .res-file').hide();
                        }
                        if (v.addfiles == 1) {
                            $contenthistori += ' Tambah File |';
                            $('#modal-form-spoiler .spoiler' + key + ' .add-file').show();
                            $('#modal-form-spoiler .spoiler' + key + ' #fill-add').empty().append($fillAdds);
                        }
                        else {
                            $('#modal-form-spoiler .spoiler' + key + ' .add-file').hide();
                        }
                        if (v.fileDel == 1) {
                            $contenthistori += ' Hapus File |';
                            $('#modal-form-spoiler .spoiler' + key + ' .del-file').show();
                            $('#modal-form-spoiler .spoiler' + key + ' #fill-del').empty().append($fillDels);

                        }
                        else {
                            $('#modal-form-spoiler .spoiler' + key + ' .del-file').hide();
                        }
                        if (v.edit == 1) {
                            $contenthistori += ' Edit Data |';
                            $('#modal-form-spoiler .spoiler' + key + ' .edit-data').show();
                            $('#modal-form-spoiler .spoiler' + key + ' #fill-name').empty().append(v.listEdit.name);
                            $('#modal-form-spoiler .spoiler' + key + ' #fill-kode').empty().append(v.listEdit.kode);
                            $('#modal-form-spoiler .spoiler' + key + ' #fill-kategori').empty().append(v.listEdit.category);
                            $('#modal-form-spoiler .spoiler' + key + ' #fill-desc').empty().append(v.listEdit.desc);
                        }
                        else {
                            $('#modal-form-spoiler .spoiler' + key + ' .edit-data').hide();
                        }
                        $('#modal-form-spoiler .spoiler' + key + ' .judul-spoiler').empty().append(v.date + ' | ' + v.user_id + ' |' + $contenthistori + '<i class="fa fa-plus"></i>');


                    });
                    $('#modal-form-spoiler').modal('show');


                    // getData($id);
                },
                error: function () {
                    swalError('Oops...', 'something wrong!');
                }
            });

        }
    </script>
    {{--histori--}}

    {{--swal component--}}
    <script>
        function swalError($swalTittle, $swalContent) {
            swal({
                title: $swalTittle,
                text: $swalContent,
                type: 'error',
                timer: '1500'
            })
        }

        function swalInfo($swalTittle, $swalContent) {
            swal({
                title: $swalTittle,
                text: $swalContent,
                type: 'info',
                timer: '1500'
            })
        }

        function swalSuccess($swalTittle, $swalContent) {
            swal({
                title: $swalTittle,
                text: $swalContent,
                type: 'success',
                timer: '1500'
            })
        }
    </script>
    {{--swal component--}}

    {{--remove check--}}
    <script>
        function removeCheck() {
            var $InputElement = $("#surat" + $id).find(".ceksurat");
            selectsurat = [];
            $InputElement.prop('checked', false);
            $InputElement.parents('tr').css('background-color', '#ffffff');
        }
    </script>
    {{--remove check--}}

    {{--accordion--}}
    <script>

        $("#modal-form-spoiler .set > a").on("click", function () {
            console.log('aaaaaa');
            if ($(this).hasClass("active")) {
                $(this).removeClass("active");
                $(this)
                    .siblings(".content")
                    .slideUp(200);
                $(".set > a i")
                    .removeClass("fa-minus")
                    .addClass("fa-plus");
            } else {
                $(".set > a i")
                    .removeClass("fa-minus")
                    .addClass("fa-plus");
                $(this)
                    .find("i")
                    .removeClass("fa-plus")
                    .addClass("fa-minus");
                $(".set > a").removeClass("active");
                $(this).addClass("active");
                $(".content").slideUp(200);
                $(this)
                    .siblings(".content")
                    .slideDown(200);
            }
        });

        function spoiler(e) {
            if ($(e).hasClass("active")) {
                $(e).removeClass("active");
                $(e)
                    .siblings(".content")
                    .slideUp(200);
                $(".set > a i")
                    .removeClass("fa-minus")
                    .addClass("fa-plus");
            } else {
                $(".set > a i")
                    .removeClass("fa-minus")
                    .addClass("fa-plus");
                $(e)
                    .find("i")
                    .removeClass("fa-plus")
                    .addClass("fa-minus");
                $(".set > a").removeClass("active");
                $(e).addClass("active");
                $(".content").slideUp(200);
                $(e)
                    .siblings(".content")
                    .slideDown(200);
            }
        }


    </script>
    {{--accordion--}}
@endsection