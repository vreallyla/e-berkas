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
                        <h2><i class="fa fa-history"></i> Riwayat Da</h2>
                    </div>
                </div>

                <div class="row animate-box">
                    <div class="col-lg-12 text-center" style="margin-bottom: 3em">

                        <ul class="nav nav-tabs">
                            <li class="active"><a data-toggle="tab" href="#data"
                                                  title="Klik tab untuk menambahkan data berkas surat">Tambah Data</a>
                            </li>

                            <li><a data-id="2" data-toggle="tab" href="#semua" onclick="ambilData(this)"
                                   title="Klik tab untuk melihat semua berkas surat">Semua</a>
                            </li>
                            <?php $asd = 3?>
                            @foreach($job as $row)
                                <li><a data-tabl="{{$row->singkatan}}" data-id="{{$asd++}}" data-toggle="tab"
                                       href="#{{$row->singkatan}} " onclick="ambilData(this)"
                                       title="Klik tab untuk melihat {{$row->desc}}">{{$row->singkatan}}</a></li>
                            @endforeach
                            <li><a data-id="1" data-toggle="tab" href="#sampah" onclick="ambilData(this)"
                                   title="Klik tab untuk melihat semua berkas surat">Sampah</a>
                            </li>


                        </ul>
                        <div class="tab-content" style="margin-top: 1em">
                            <div id="data" class="tab-pane fade in active text-center"><br>
                                <h3>- Tambah Berkas Surat -</h3>
                                <div class="row form-group">
                                    <div class="col-lg-12">
                                        <select class="form-control category_id" name="jumlah" id="jumlah"
                                                required>
                                            <option value="1" selected="true">---- 1 Data ----</option>
                                            @for($i=2;$i<=10;$i++)
                                                <option value="{{$i}}">---- {{$i}} Data ----</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <br>
                                <div id="jadi-data">
                                    <form action="" method="post" enctype="multipart/form-data"
                                          class="form-horizontal"
                                    >
                                        <input type="hidden" id="status" name="status" value="0">
                                        {{ csrf_field() }} {{ method_field('post') }}
                                        <div class="row form-group">
                                            <div class="col-lg-12">
                                                <table id="ulang">
                                                    <tr>
                                                        <td><input placeholder="input data" class="form-control"
                                                                   type="file"
                                                                   id="file[]" name="file[]" multiple required></td>
                                                        <td><input placeholder="Kode Surat" class="form-control"
                                                                   id="name"
                                                                   name="name" required></td>
                                                        <td>
                                                        <td><input placeholder="Kode Berkas" class="form-control"
                                                                   id="kode"
                                                                   name="kode" required></td>
                                                        <td>
                                                            <select class="form-control category_id" name="category_id"
                                                                    id="category_id" required>
                                                                <option value="" disabled selected>- Pilih Kategori
                                                                    Surat -
                                                                </option>
                                                                @foreach(\App\trDataCategory::where('job_id', \Illuminate\Support\Facades\Auth::user()->job_id)->get() as $row)
                                                                    <option value="{{$row->id}}">{{$row->name}}
                                                                        ({{$row->singkatan}})
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </td>
                                                        <td>
                                                    <textarea class="form-control" placeholder="Keterangan" id="desc"
                                                              name="desc" style="height: 54px"></textarea>
                                                        </td>

                                                    </tr>
                                                </table>
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

                            <div id="semua" class="tab-pane fade in text-center">
                                <br>
                                <div id="table2-data">
                                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        {{ csrf_field() }} {{ method_field('post') }}
                                        <input type="hidden" name="metode" id="metode" class="metode">
                                        <h3>- Data Semua Surat -</h3>
                                        <div class="text-right">
                                            <button data-toggle="tooltip" title="delete" value="delete"
                                                    type="submit"
                                                    data-limit="delete" id="delete"
                                                    class="btn btn-primary">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <button data-toggle="tooltip" title="edit" value="delete"
                                                    type="submit"
                                                    data-limit="update" id="update"
                                                    class="btn btn-primary">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </div>
                                        <br>

                                        <table class="table table-responsive table-bordered table-hover" width="100%"
                                               id="example2" cellspacing="0">
                                            <thead>
                                            <tr>

                                                <th width="20px">

                                                </th>
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
                                    </form>
                                </div>
                            </div>

                            <div id="sampah" class="tab-pane fade in text-center">
                                <br>
                                <div id="table2-data">
                                    <form action="" method="post" enctype="multipart/form-data" class="form-horizontal">
                                        {{ csrf_field() }} {{ method_field('post') }}
                                        <input type="hidden" name="metode" id="metode" class="metode">
                                        <h3>- Data Semua Surat -</h3>
                                        <div class="text-right">
                                            <button data-toggle="tooltip" title="delete" value="delete"
                                                    type="submit"
                                                    data-limit="delete" id="delete"
                                                    class="btn btn-primary">
                                                <i class="fa fa-times"></i>
                                            </button>
                                            <button data-toggle="tooltip" title="edit" value="delete"
                                                    type="submit"
                                                    data-limit="update" id="update"
                                                    class="btn btn-primary">
                                                <i class="fa fa-edit"></i>
                                            </button>
                                        </div>
                                        <br>

                                        <table class="table table-responsive table-bordered table-hover" width="100%"
                                               id="example1" cellspacing="0">
                                            <thead>
                                            <tr>

                                                <th width="20px">

                                                </th>
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
                                    </form>
                                </div>
                            </div>
                            <?php $exam = 3; $exam2 = 3;$exam3 = 3;$exam4 = 3?>
                            @foreach($job as $row)

                                <div id="{{$row->singkatan}}" class="tab-pane fade in text-center">
                                    <br>
                                    <div id="data{{$exam2++}}">
                                        <form action="" method="post" enctype="multipart/form-data"
                                              class="form-horizontal">
                                            {{ csrf_field() }} {{ method_field('post') }}
                                            <input type="hidden" name="metode" id="metode" class="metode">
                                            <h3>- Data {{$row->name}} -</h3>
                                            <div class="text-right">
                                                <button data-toggle="tooltip" title="delete" value="delete"
                                                        type="submit"
                                                        data-limit="delete" id="delete{{$exam3++}}"
                                                        class="btn btn-primary">
                                                    <i class="fa fa-times"></i>
                                                </button>
                                                <button data-toggle="tooltip" title="edit" value="delete"
                                                        type="submit"
                                                        data-limit="delete" id="update{{$exam4++}}"
                                                        class="btn btn-primary">
                                                    <i class="fa fa-edit"></i>
                                                </button>
                                            </div>
                                            <br>
                                            <table class="table table-responsive table-bordered table-hover"
                                                   width="100%"
                                                   id="example_{{$row->singkatan}}" cellspacing="0">
                                                <thead>
                                                <tr>
                                                    <th width="20px">
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
                                                        <center>Dibuat Tanggal</center>
                                                    </th>
                                                    <th></th>
                                                </tr>
                                                </thead>
                                                <tbody>

                                                </tbody>

                                            </table>
                                        </form>
                                    </div>
                                </div>

                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <br><br><br>
    @include('user.eberkas.form')
@endsection
@section('script')
    <script>
        $('#loading1').hide();
        var myobj = {},
            prefix = 'table', trHTML = '';
        var exam1 = [];
        @for ($i=0;$i<count($job);$i++)
        exam1.push("{{$job[$i]->singkatan}}");
        @endfor
        $(document).ready(function () {
            var bias = 0;
            var url1 = [];
            url1.push("{{route('api.mst.data3')}}");
            url1.push("{{route('api.mst.data4')}}");
            $.fn.dataTable.ext.errMode = 'throw';
            for (var i = 1; i <= 2; i++) {
                bias=i-1;
                myobj[prefix + i] = '';
                myobj[prefix + i] = $('#example' + i).DataTable({
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
                    ajax: url1[bias],
                    columns: [
                        {data: 'cek', name: 'cek', orderable: false, searchable: false},
                        {data: 'kode', name: 'kode'},
                        {data: 'name', name: 'name'},
                        {data: 'category', name: 'category'},
                        {data: 'user', name: 'user'},
                        {data: 'dibuat', name: 'dibuat'},
                        {data: 'action', name: 'action', orderable: false, searchable: false}]
                });
            }

            var b = -1;
            for (var i = 3; i < ({{count($job)}} +3); i++) {
                var a = [];
                @for ($i=0;$i<count($job);$i++)
                a.push("{{$job[$i]->id}}");
                @endfor
                    myobj[prefix + exam1[i - 3]] = '';
                myobj[prefix + exam1[i - 3]] = $('#example_' + exam1[i - 3]).DataTable({
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
                    "ajax": {
                        "url": "{{ route('api.mst.data2') }}",
                        "data": {
                            "id": a[b = b + 1]
                        }
                    },
                    columns: [
                        {data: 'cek', name: 'cek', orderable: false, searchable: false},
                        {data: 'kode', name: 'kode'},
                        {data: 'name', name: 'name'},
                        {data: 'user', name: 'user'},
                        {data: 'dibuat', name: 'dibuat'},
                        {data: 'action', name: 'action', orderable: false, searchable: false}]
                });

            }
            $(document).on('change', '#jumlah', function () {

                var trHTML2 = '';
                var op = '';
                var desa = $(this).val();

                var div = $(this).parent();
                var op = " ";

                $.ajax({
                    type: 'get',
                    url: '{!!URL::to('eBerkas/jumlah')!!}',
                    data: {'id': '{{\Illuminate\Support\Facades\Auth::user()->job_id}}'},
                    success: function (data) {

                        $('#jadi-data form')[0].reset();
                        op += '<option value="" disabled selected>- Pilih Kategori\n' +
                            '                                                                    Surat -\n' +
                            '                                                                </option>';
                        for (var i = 0; i < data.length; i++) {
                            op += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                        }
                        for (var i = 1; i <= desa; i++) {
                            trHTML2 += '<tr>\n' +
                                '                                                        <td><input placeholder="input data" class="form-control"\n' +
                                '                                                                   type="file"\n' +
                                '                                                                   id="file[' + i + '][]" name="file[' + i + '][]" multiple required></td>\n' +
                                '                                                        <td><input placeholder="Kode Surat" class="form-control"\n' +
                                '                                                                   id="name[]"\n' +
                                '                                                                   name="name[]" multiple required></td>\n' +
                                '                                                        <td>\n' +
                                '                                                        <td><input placeholder="Kode Berkas" class="form-control"\n' +
                                '                                                                   id="kode[]"\n' +
                                '                                                                   name="kode[]" multiple required></td>\n' +
                                '                                                        <td>\n' +
                                '                                                            <select class="form-control category_id" name="category_id[]"\n' +
                                '                                                                    id="category_id[]" required>' + op + '</select>\n' +
                                '                                                        </td>\n' +
                                '                                                        <td>\n' +
                                '                                                    <textarea class="form-control" placeholder="Keterangan" id="desc[]"\n' +
                                '                                                              name="desc[]" multiple style="height: 54px"></textarea>\n' +
                                '                                                        </td>\n' +
                                '\n' +
                                '                                                    </tr>';
                        }
                        $('#jadi-data form #ulang').empty().append(trHTML2);
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

            })

        });

        $(function () {
            $('#jadi-data form').on('submit', function (e) {
                if (!e.isDefaultPrevented()) {
                    $('#berubah1').hide();
                    $('#loading1').show();
                    $(':input[type="submit"]').prop('disabled', true);


                    $.ajax({
                        url: "{{route('eberkas.store')}}",
                        type: "post",
                        data: new FormData($('#jadi-data form')[0]),
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            $('#jadi-data form')[0].reset();
                            $(':input[type="submit"]').prop('disabled', false);
                            $('#loading1').hide();
                            $('#berubah1').show();
                            swal({
                                title: 'Berhasil!',
                                text: 'Data berkas telah dibuat!',
                                type: 'success',
                                timer: '1500'
                            })
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

        $(function () {
            $('#modal-form2 form').on('submit', function (e) {
                if (!e.isDefaultPrevented()) {
//$("input[type:submit]").attr("disable","disable");
                    $(':button[type="submit"]').prop('disabled', true);
                    $.ajax({
                        url: "{{route('eberkas.multiupdate')}}",
                        type: "post",
                        data: new FormData($('#modal-form2 form')[0]),
                        contentType: false,
                        processData: false,
                        success: function (data) {

                            $('#modal-form2 form')[0].reset();
                            $(':button[type="submit"]').prop('disabled', false);

                            if (data.gagal == 0) {
                                swal({
                                    title: 'Peringatan!',
                                    text: 'Harap rubah salah satu colom dari setiap baris!',
                                    type: 'info',
                                    timer: '2500'
                                })
                                return false;
                            }
                            myobj['table2'].ajax.reload();
                            $('#modal-form2').modal('hide');
                            for (var i = 3; i < ({{count($job)}}+3); i++) {
                                myobj['table' + exam1[i - 3]].ajax.reload();
                            }
                            $('#modal-form2 form')[0].reset();
                            swal({
                                title: 'Sukses!',
                                text: 'Data Berhasil Dirubah!',
                                type: 'success',
                                timer: '1500'
                            })
                        },
                        error: function () {
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
//$("input[type:submit]").attr("disable","disable");
                    $(':button[type="submit"]').prop('disabled', true);
                    $.ajax({
                        url: "{{route('eberkas.update')}}",
                        type: "post",
                        data: new FormData($('#modal-form3 form')[0]),
                        contentType: false,
                        processData: false,
                        success: function (data) {
                            $(':button[type="submit"]').prop('disabled', false);
                            $('#modal-form3 form')[0].reset();

                            $('#modal-form3').modal('hide');
                            if (data.gagal == 0) {
                                swal({
                                    title: 'Peringatan!',
                                    text: 'Data Belum Dirubah!',
                                    type: 'info',
                                    timer: '1500'
                                })
                            }
                            else if (data.gagal == 1) {
                                swal({
                                    title: 'Peringatan!',
                                    text: 'File berkas tidak dapat dihapus semua!',
                                    type: 'info',
                                    timer: '1500'
                                })
                            }
                            else {
                                myobj['table2'].ajax.reload();
                                for (var i = 3; i < ({{count($job)}}+3); i++) {
                                    myobj['table' + exam1[i - 3]].ajax.reload();
                                }
                                $('#modal-form3 form')[0].reset();
                                $(':button[type="submit"]').prop('disabled', false);
                                swal({
                                    title: 'Sukses!',
                                    text: 'Data Berhasil Dirubah!',
                                    type: 'success',
                                    timer: '1500'
                                })
                            }
                        },
                        error: function () {
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

        $('#table2-data form #delete').click(function () {
            $('#table2-data form #metode').val(0);
        });
        $('#table2-data form #update').click(function () {
            $('#table2-data form #metode').val(1);
        });

        $(function () {
            var op = '', trHTML2 = '';
            var jd = '', jd = [];
            $('#table2-data form').on('submit', function (e) {
                if (!e.isDefaultPrevented(e)) {
//$("input[type:submit]").attr("disable","disable");
                    /*if ($("input[name='cek]']").prop('checked')==true) {
                        alert('iya');
                    }
                    else {
                        alert('tidak');
                    }*/
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
                                url: '{{route('user.cek')}}',
                                data: {'id': password},
                                success: function (data) {
//                                    console.log(data);
                                    if (data.status == 0) {
                                        swal({
                                            title: 'Password Kosong!',
                                            text: 'Harap Masukkan Password!',
                                            type: 'error',
                                            timer: '1500'
                                        })
                                    }
                                    else if (data.status == 1) {
                                        url = "{{route('eberkas.cek')}}";
                                        if ($('#table2-data form #metode').val() == 0) {
                                            swal({
                                                title: 'Hapus Data?',
                                                text: "Data Akan Hilang!",
                                                type: 'warning',
                                                showCancelButton: true,
                                                cancelButtonColor: '#d33',
                                                confirmButtonColor: '#3085d6',
                                                confirmButtonText: 'Ya!'
                                            }).then(function (isConfirm) {
                                                if (!$.trim(isConfirm.dismiss)) {

                                                    $(':button[type="submit"]').prop('disabled', true);
                                                    $.ajax({
                                                        url: url,
                                                        type: "post",
                                                        data: new FormData($('#table2-data form')[0]),
                                                        contentType: false,
                                                        processData: false,
                                                        success: function (data) {

//                                        console.log(data);
                                                            myobj['table2'].ajax.reload();
                                                            $(':button[type="submit"]').prop('disabled', false);
                                                            if (data.status == true) {
                                                                swal({
                                                                    title: 'Sukses!',
                                                                    text: 'Data Berhasil Dihapus!',
                                                                    type: 'success',
                                                                    timer: '1500'
                                                                })
                                                            }
                                                            else {
                                                                swal({
                                                                    title: 'Pilih Data!',
                                                                    text: 'Data Belum Dipilih!',
                                                                    type: 'info',
                                                                    timer: '1500'
                                                                })
                                                            }
                                                        },
                                                        error: function () {
                                                            $(':button[type="submit"]').prop('disabled', false);
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

                                            })

                                        }
                                        else {
                                            $(':button[type="submit"]').prop('disabled', true);

                                            $.ajax({
                                                url: url,
                                                type: "post",
                                                data: new FormData($('#table2-data form')[0]),
                                                contentType: false,
                                                processData: false,
                                                success: function (data) {
//                                console.log(data);
//                                myobj['table2'].ajax.reload();
                                                    $(':button[type="submit"]').prop('disabled', false);
                                                    if (data.gagal == 0) {
                                                        swal({
                                                            title: 'Peringatan!',
                                                            text: 'Multi edit berfungsi untuk lima data!',
                                                            type: 'info',
                                                            timer: '2500'
                                                        })
                                                        return false;
                                                    }
                                                    if (data.status == true) {
                                                        $('#modal-form2 form')[0].reset();
                                                        $('#modal-form2').modal('show');
                                                        $('.modal-title2').text('Multiple Edit Berkas');
                                                        jd = '';
                                                        jd = [];
                                                        for (var z = 0; z < data.jadi.length; z++) {
                                                            op = '';
                                                            op += '<option value="" disabled selected>- Pilih Kategori - </option>';
                                                            for (var i = 0; i < data.category.length; i++) {
                                                                if (data.jadi[z].category_id == data.category[i].id) {
                                                                    op += '<option value="' + data.category[i].id + '" selected>' + data.category[i].name + '</option>';
                                                                }
                                                                else {
                                                                    op += '<option value="' + data.category[i].id + '">' + data.category[i].name + '</option>';
                                                                }
//                                            console.log(data.category[i].id);

                                                            }
                                                            jd.push(op);
//                                        console.log(data.jadi[z].category_id);

                                                        }
//                                    console.log(jd);
                                                        trHTML2 = '';
                                                        var av = -1;
                                                        for (var i = 0; i < data.jadi.length; i++) {
                                                            trHTML2 += '<tr>\n' +
                                                                '    <th width="150px">&nbsp;&nbsp;file</th>\n' +
                                                                '    <th>&nbsp;&nbsp;Kode Surat</th>\n' +
                                                                '    <th>&nbsp;&nbsp;Kode Berkas</th>\n' +
                                                                '    <th>&nbsp;&nbsp;Jenis Surat</th>\n' +
                                                                '    <th>&nbsp;&nbsp;Detail</th>\n' +
                                                                '</tr><tr>\n' +
                                                                '                                                        <td><input type="hidden" id="id[' + i + ']" name="id[' + i + ']" value="' + data.jadi[i].id + '" required>\n' +
                                                                '                            <input placeholder="input data" class="form-control"\n' +
                                                                '                                                                   type="file"\n' +
                                                                '                                                                   id="file[' + i + '][]" name="file[' + i + '][]" multiple></td>\n' +
                                                                '                                                        <td><input placeholder="Kode Surat" class="form-control"\n' +
                                                                '                                                                   id="name[]"\n' +
                                                                '                                                                   name="name[]" multiple value="' + data.jadi[i].name + '" required></td>\n' +
                                                                '                                                        <td><input placeholder="Kode Berkas" class="form-control"\n' +
                                                                '                                                                   id="kode[]"\n' +
                                                                '                                                                   name="kode[]" value="' + data.jadi[i].kode + '" multiple required></td>\n' +
                                                                '                                                        <td><select class="form-control category_id" name="category_id[]"\n' +
                                                                '                                                                    id="category_id[]" required>' + jd[i] + '</select>\n' +
                                                                '                                                        </td>\n' +
                                                                '                                                        <td><textarea class="form-control" placeholder="Keterangan" id="desc[]"\n' +
                                                                '                                                              name="desc[]"  style="height: 54px">' + data.jadi[i].desc + '</textarea>\n' +
                                                                '                                                        </td>\n' +
                                                                '\n' +
                                                                '                                                    </tr>';
                                                        }
                                                        $('#location2').empty().append(trHTML2);
                                                        $('#modal-form2 .modal-footer').empty().append(' <button type="submit" class="btn btn-primary btn-save">Submit</button>\n' +
                                                            '                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>');
//                                    $('#jadi-data form #ulang').empty().append(trHTML2);

                                                    }
                                                    else {
                                                        swal({
                                                            title: 'Pilih Data!',
                                                            text: 'Data Belum Dipilih!',
                                                            type: 'info',
                                                            timer: '1500'
                                                        })
                                                    }
                                                },
                                                error: function () {
                                                    $(':button[type="submit"]').prop('disabled', false);
                                                    swal({
                                                        title: 'Oops...',
                                                        text: 'Something went wrong!',
                                                        type: 'error',
                                                        timer: '1500'
                                                    })
                                                }
                                            });

                                        }
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

        var singk = [];

        @for ($i=0;$i<count($job);$i++)
        singk.push("{{$job[$i]->singkatan}}");
                @endfor


        for (var mb = 0; mb < ({{count($job)}}+0); mb++) {
            var ml = mb + 3, datas = data + (mb + 3);
            $('#' + singk[mb] + ' form #delete' + ml).on('click', {id: ml}, function () {
                url = "{{route('eberkas.cek')}}";

                $('#data' + e.data.id + ' form #metode').val(0);
                if ($('#data' + e.data.id + ' form #metode').val() == 0) {
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
                                url: '{{route('user.cek')}}',
                                data: {'id': password},
                                success: function (data) {
//                                    console.log(data);
                                    if (data.status == 0) {
                                        swal({
                                            title: 'Password Kosong!',
                                            text: 'Harap Masukkan Password!',
                                            type: 'error',
                                            timer: '1500'
                                        })
                                    }
                                    else if (data.status == 1) {
                                        swal({
                                            title: 'Hapus Data?',
                                            text: "Data Akan Hilang!",
                                            type: 'warning',
                                            showCancelButton: true,
                                            cancelButtonColor: '#d33',
                                            confirmButtonColor: '#3085d6',
                                            confirmButtonText: 'Ya!'
                                        }).then(function (isConfirm) {
                                            if (!$.trim(isConfirm.dismiss)) {

                                                $(':button[type="submit"]').prop('disabled', true);
                                                $.ajax({
                                                    url: url,
                                                    type: "post",
                                                    data: new FormData($('#data' + e.data.id + ' form')[0]),
                                                    contentType: false,
                                                    processData: false,
                                                    success: function (data) {
//                                    console.log(data);
                                                        myobj['table' + exam1[e.data.id - 3]].ajax.reload();
                                                        $(':button[type="submit"]').prop('disabled', false);
                                                        if (data.status == true) {
                                                            swal({
                                                                title: 'Sukses!',
                                                                text: 'Data Berhasil Dihapus!',
                                                                type: 'success',
                                                                timer: '1500'
                                                            })
                                                        }
                                                        else {
                                                            swal({
                                                                title: 'Pilih Data!',
                                                                text: 'Data Belum Dipilih!',
                                                                type: 'info',
                                                                timer: '1500'
                                                            })
                                                        }
                                                    },
                                                    error: function () {
                                                        $(':button[type="submit"]').prop('disabled', false);
                                                        swal({
                                                            title: 'Oops...',
                                                            text: 'Something went wrong!',
                                                            type: 'error',
                                                            timer: '1500'
                                                        })
                                                    }
                                                });
                                            }
                                        })
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

                }

                else {
                    swal({
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        type: 'error',
                        timer: '1500'
                    })

                }
                return false;

            });

            $('#' + singk[mb] + ' form #update' + ml).on('click', {id: ml}, function (e) {
                $('#data' + e.data.id + ' form #metode').val(1);
                var kunci = '', op = '', trHTML2 = '';
                var jd = '', jd = [];
                if ($('#data' + e.data.id + ' form #metode').val() == 1) {
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
                                url: '{{route('user.cek')}}',
                                data: {'id': password},
                                success: function (data) {
//                                    console.log(data);
                                    if (data.status == 0) {
                                        swal({
                                            title: 'Password Kosong!',
                                            text: 'Harap Masukkan Password!',
                                            type: 'error',
                                            timer: '1500'
                                        })
                                    }
                                    else if (data.status == 1) {
                                        $(':button[type="submit"]').prop('disabled', true);
                                        url = "{{route('eberkas.cek')}}";
                                        $.ajax({
                                            url: url,
                                            type: "post",
                                            data: new FormData($('#data' + e.data.id + ' form')[0]),
                                            contentType: false,
                                            processData: false,
                                            success: function (data) {
                                                myobj['table' + exam1[e.data.id - 3]].ajax.reload();
                                                $(':button[type="submit"]').prop('disabled', false);
                                                if (data.status == true) {
                                                    $('#modal-form2 form')[0].reset();
                                                    $('#modal-form2').modal('show');
                                                    $('.modal-title2').text('Multiple Edit Berkas');
                                                    for (var z = 0; z < data.jadi.length; z++) {
                                                        op = '';
                                                        op += '<option value="" disabled selected>- Pilih Kategori - </option>';
                                                        for (var i = 0; i < data.category.length; i++) {
                                                            if (data.jadi[z].category_id == data.category[i].id) {
                                                                op += '<option value="' + data.category[i].id + '" selected>' + data.category[i].name + '</option>';
                                                            }
                                                            else {
                                                                op += '<option value="' + data.category[i].id + '">' + data.category[i].name + '</option>';
                                                            }
                                                        }
                                                        jd.push(op);
                                                    }
                                                    trHTML2 = '';
                                                    var av = -1;
                                                    for (var i = 0; i < data.jadi.length; i++) {
                                                        trHTML2 += '<tr><input type="hidden" value="' + data.jadi[i].id + '" name="id[]" id="id[]" multiple>\n' +
                                                            '    <th width="150px">&nbsp;&nbsp;file</th>\n' +
                                                            '    <th>&nbsp;&nbsp;Kode Surat</th>\n' +
                                                            '    <th>&nbsp;&nbsp;Kode Berkas</th>\n' +
                                                            '    <th>&nbsp;&nbsp;Jenis Surat</th>\n' +
                                                            '    <th>&nbsp;&nbsp;Detail</th>\n' +
                                                            '</tr><tr>\n' +
                                                            '                                          <td><input type="hidden" id="id[' + i + ']" name="id[' + i + ']" value="' + data.jadi[i].id + '" required>\n' +
                                                            '                            <input placeholder="input data" class="form-control"\n' +
                                                            '                                                                   type="file"\n' +
                                                            '                                                                   id="file[' + i + '][]" name="file[' + i + '][]" multiple></td>\n' +
                                                            '                                                        <td><input placeholder="Kode Surat" class="form-control"\n' +
                                                            '                                                                   id="name[]"\n' +
                                                            '                                                                   name="name[]" multiple value="' + data.jadi[i].name + '" required></td>\n' +
                                                            '                                                        <td><input placeholder="Kode Berkas" class="form-control"\n' +
                                                            '                                                                   id="kode[]"\n' +
                                                            '                                                                   name="kode[]" value="' + data.jadi[i].kode + '" multiple required></td>\n' +
                                                            '                                                        <td><select class="form-control category_id" name="category_id[]"\n' +
                                                            '                                                                    id="category_id[]" required>' + jd[i] + '</select>\n' +
                                                            '                                                        </td>\n' +
                                                            '                                                        <td><textarea class="form-control" placeholder="Keterangan" id="desc[]"\n' +
                                                            '                                                              name="desc[]"  style="height: 54px">' + data.jadi[i].desc + '</textarea>\n' +
                                                            '                                                        </td>\n' +
                                                            '\n' +
                                                            '                                                    </tr>';
                                                    }
                                                    $('#location2').empty().append(trHTML2);
                                                    $('#modal-form2 .modal-footer').empty().append(' <button type="submit" class="btn btn-primary btn-save">Submit</button>\n' +
                                                        '                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>');


                                                }
                                                else {
                                                    swal({
                                                        title: 'Pilih Data!',
                                                        text: 'Data Belum Dipilih!',
                                                        type: 'info',
                                                        timer: '1500'
                                                    })
                                                }
                                            },
                                            error: function () {
                                                $(':button[type="submit"]').prop('disabled', false);
                                                swal({
                                                    title: 'Oops...',
                                                    text: 'Something went wrong!',
                                                    type: 'error',
                                                    timer: '1500'
                                                })
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


                }
                else {
                    swal({
                        title: 'Oops...',
                        text: 'Something went wrong!',
                        type: 'error',
                        timer: '1500'
                    })

                }
                return false;
            });
        }

        function ambilData(asd) {
//            console.log('hmmm');
            if ($(asd).data("id") == 2 || $(asd).data("id") == 1) {
//                alert($(asd).data("id"));
                myobj['table' + $(asd).data("id")].ajax.reload();


            }
            else {
//                alert($(asd).data("tabl"));
                myobj['table' + $(asd).data("tabl")].ajax.reload();
            }

        }

        function showForm(id) {
            var opa = '';
            var opa2 = '';
            var base_url = '{!!URL::to('/')!!}' + '/';
            var foo = '';

            $.ajax({
                url: "{{route('eberkas.show')}}",
                type: "GET",
                data: {'id': id},
                success: function (data) {
                    $('#modal-form form')[0].reset();
                    $('#modal-form').modal('show');
                    console.log(data)
                    $('.modal-title').text('Detail Berkas');
//                    console.log(data);
                    opa = '';

                    for (var i = 0; i < data.berkas.length; i++) {
                        opa += '<a href="' + base_url + data.berkas[i].name + '" target="_blank">' + data.berkas[i].name.substr(21) + '</a><br> ';
                    }
                    if ($.trim(data.diedit)) {
                        opa2 = '<a href="#' + data.kode + '" onclick="historyData(' + data.id + ')">' + data.diedit + '</a>'
                    }
                    else {
                        opa2 = 'Belum ada perubahan'
                    }

                    trHTML = '';
                    trHTML += '<tr><td width="200px">Kode Berkas</td><td>:&nbsp;</td><td>' + data.kode + '</td></tr>';
                    trHTML += '<tr><td width="200px">Kode Surat</td><td>:&nbsp;</td><td>' + data.name + '</td></tr>';
                    trHTML += '<tr><td width="200px">Jenis Surat</td><td>:&nbsp;</td><td>' + data.category + ' (' + data.singkatan + ')' + '</td></tr>';
                    trHTML += '<tr><td width="200px">Pengirim</td><td>:&nbsp;</td><td>' + data.user + '</td></tr>';
                    trHTML += '<tr><td width="200px">Perubahan Data</td><td>:&nbsp;</td><td>' + opa2 + '</td></tr>';
                    trHTML += '<tr><td width="200px" valign="top">Berkas</td><td valign="top">:&nbsp;</td><td>' + opa.substr(0) + '</td></tr>';
                    trHTML += '<tr><td width="200px">Dibuat</td><td>:&nbsp;</td><td>' + data.dibuat + '</td></tr>';
                    trHTML += '<tr><td width="200px" valign="top">Keterangan</td><td valign="top">:&nbsp;</td><td align="justify" >' + data.desc + '</td></tr>';
                    $('#location').empty().append(trHTML);
                    foo = '';
                    if (data.deleted_at == null) {
                        foo += '    <a data-id="' + data.id + '" data-method="1" onclick="editForm(this)" class="btn btn-success">Edit</a>\n' +
                            '    <a data-id="' + data.id + '" data-method="1" onclick="deleteData(this)" class="btn btn-danger">Hapus</a>\n';
                    }
                    else {
                        foo += '    <a data-id="' + data.id + '" data-method="1" onclick="restoreData(this)" class="btn btn-success">Pulihkan</a>\n' +
                            '    <a data-id="' + data.id + '" data-method="1" onclick="deletePermData(this)" class="btn btn-danger" title="Hapus Permanen">Hapus Perm</a>\n';
                    }
                    $('#modal-form .modal-footer').empty().append('' + foo +
                        '                    <button type="button" class="btn btn-default" data-dismiss="modal">Kembali</button>');

                },
                error: function () {
                    alert("Nothing Data");
                }
            });
        }


        function deleteData(id) {
            if ($(id).data("method") == 1) {
                $('#modal-form').modal('hide');
            }
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
                        url: '{{route('user.cek')}}',
                        data: {'id': password},
                        success: function (data) {
//                            console.log(data);
                            if (data.status == 0) {
                                swal({
                                    title: 'Password Kosong!',
                                    text: 'Harap Masukkan Password!',
                                    type: 'error',
                                    timer: '1500'
                                })
                            }
                            else if (data.status == 1) {
                                swal({
                                    title: 'Hapus Data?',
                                    text: "Data Akan Hilang!",
                                    type: 'warning',
                                    showCancelButton: true,
                                    cancelButtonColor: '#d33',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Ya!'
                                }).then(function (isConfirm) {
                                    if (!$.trim(isConfirm.dismiss)) {
                                        $.ajax({
                                            url: "{{route('eberkas.delete')}}",
                                            type: "GET",
                                            data: {'id': $(id).data("id")},
                                            success: function (data) {
                                                $('#location').empty();
                                                $('.modal-footer').empty();
                                                swal({
                                                    title: 'Data Terhapus!',
                                                    text: 'Data Dipindahkan ke Sampah!',
                                                    type: 'success',
                                                    timer: '1500'
                                                })
                                                myobj['table2'].ajax.reload();
                                                myobj['table' + data.category].ajax.reload();
                                            },
                                            error: function () {
                                                alert("Nothing Data");
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

        function restoreData(id) {
            if ($(id).data("method") == 1) {
                $('#modal-form').modal('hide');
            }
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
                        url: '{{route('user.cek')}}',
                        data: {'id': password},
                        success: function (data) {
                            console.log(data);
                            if (data.status == 0) {
                                swal({
                                    title: 'Password Kosong!',
                                    text: 'Harap Masukkan Password!',
                                    type: 'error',
                                    timer: '1500'
                                })
                            }
                            else if (data.status == 1) {
                                swal({
                                    title: 'Pulikan Data?',
                                    text: "Data akan kembali!",
                                    type: 'warning',
                                    showCancelButton: true,
                                    cancelButtonColor: '#d33',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Ya!'
                                }).then(function (isConfirm) {
                                    if (!$.trim(isConfirm.dismiss)) {

                                        $.ajax({
                                            url: "{{route('eberkas.restore')}}",
                                            type: "GET",
                                            data: {'id': $(id).data("id")},
                                            success: function (data) {
//                        console.log(data);
                                                $('#location').empty();
                                                $('.modal-footer').empty();
                                                swal({
                                                    title: 'Data Dipulihkan!',
                                                    text: 'Data Berhasil Dipulihkan!',
                                                    type: 'success',
                                                    timer: '1500'
                                                })
                                                myobj['table1'].ajax.reload();
                                            },
                                            error: function () {
                                                alert("Nothing Data");
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

        function deletePermData(id) {
            swal({
                title: 'Hapus Permanen?',
                text: "Data akan terhapus permanen!",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Ya!'
            }).then(function (isConfirm) {
                if (!$.trim(isConfirm.dismiss)) {
                    $.ajax({
                        url: "{{route('eberkas.deleteperm')}}",
                        type: "GET",
                        data: {'id': $(id).data("id")},
                        success: function (data) {
//                            console.log(data);

                            swal({
                                title: 'Data Dipulihkan!',
                                text: 'Data Berhasil Dipulihkan!',
                                type: 'success',
                                timer: '1500'
                            })
                            myobj['table1'].ajax.reload();
                        },
                        error: function () {
                            alert("Nothing Data");
                        }
                    });
                }
            });
            return false;
        }

        function editForm(id) {
            var op = '';
            var opa = '';
            var base_url = '{!!URL::to('/')!!}' + '/';
            if ($(id).data("method") == 1) {
                $('#modal-form').modal('hide');
            }
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
                        url: '{{route('user.cek')}}',
                        data: {'id': password},
                        success: function (data) {
//                            console.log(data);
                            if (data.status == 0) {
                                swal({
                                    title: 'Password Kosong!',
                                    text: 'Harap Masukkan Password!',
                                    type: 'error',
                                    timer: '1500'
                                })
                            }
                            else if (data.status == 1) {
                                $.ajax({
                                    url: "{{route('eberkas.show')}}",
                                    type: "GET",
                                    data: {'id': $(id).data("id")},
                                    success: function (data) {
                                        $('#modal-form3').modal('show');
                                        $('.modal-title').text('Edit Berkas');
//                        console.log(data);
                                        $('#modal-form3 .modal-footer').empty().append(' <button type="submit" class="btn btn-primary btn-save">Submit</button>\n' +
                                            '                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>');
                                        op = '';
                                        op += '<option value="" disabled selected>- Pilih Kategori - </option>';
                                        for (var i = 0; i < data.category2.length; i++) {
                                            if (data.category_id == data.category2[i].id) {
                                                op += '<option value="' + data.category2[i].id + '" selected>' + data.category2[i].name + '</option>';
                                            }
                                            else {
                                                op += '<option value="' + data.category2[i].id + '">' + data.category2[i].name + '</option>';
                                            }
                                        }
                                        opa += '';
                                        opa += '<div class="col-md-12"><label class="control-label">&nbsp;Hapus Berkas</label></div>';
                                        for (var i = 0; i < data.berkas.length; i++) {
                                            opa += '<div class="col-md-6">' +
                                                '<input type="checkbox" id="berkas[]" name="berkas[]" value="' + data.berkas[i].id + '" multiple">\n' +
                                                '<a href="' + base_url + data.berkas[i].name + '" target="_blank" style="font-size: 18px" placeholder="klik jika ingin menghapus!">' + data.berkas[i].name.substr(21) + '</a>' +
                                                '                                            </div>\n';
                                        }
//                    console.log(opa);
//                            console.log(jd2);

                                        $('#modal-form3 form #isi').empty().append('<div class="row form-group has-feedback">\n' +
                                            '                                            <div class="col-md-12">\n' +
                                            '                                                <input type="hidden" id="id" name="id" value="' + data.id + '">' +
                                            '<label class="control-label">&nbsp;Tambah Berkas</label><input id="file[]" type="file"\n' +
                                            '                                                       class="form-control"\n' +
                                            '                                                       name="file[]"\n' +
                                            '                                                       multiple title="pilih gambar"/>\n' +
                                            '                                            </div>\n' +
                                            '                                        </div>\n' +
                                            '                                        <div class="row form-group has-feedback">' + opa + '\n' +
                                            '                                        </div>\n' +
                                            '                                        <div class="row form-group has-feedback">\n' +
                                            '                                            <div class="col-md-6"><label class="control-label">&nbsp;Kode Surat</label>\n' +
                                            '                                                <input placeholder="Kode Surat" id="name" type="text"\n' +
                                            '                                                       class="form-control"\n' +
                                            '                                                       name="name" value="' + data.name + '" \n' +
                                            '                                                       required autofocus>\n' +
                                            '                                            </div>\n' +
                                            '                                            <div class="col-md-6"><label class="control-label">&nbsp;Kode Berkas</label>\n' +
                                            '                                                <input placeholder="Kode Berkas" id="kode" type="text"\n' +
                                            '                                                       class="form-control"\n' +
                                            '                                                       name="kode" value="' + data.kode + '" \n' +
                                            '                                                        required autofocus>\n' +
                                            '                                            </div>\n' +
                                            '                                        </div>\n' +
                                            '\n' +
                                            '                                        <div class="row form-group has-feedback">\n' +
                                            '                                            <div class="col-md-12"><label class="control-label">&nbsp;Kategori Surat</label>\n' +
                                            '                                                <select name="category_id" id="category_id"\n' +
                                            '                                                        class="form-control"\n' +
                                            '                                                        required autofocus>\n' +
                                            '                                               ' + op + ' </select>\n' +
                                            '\n' +
                                            '                                            </div>\n' +
                                            '                                        </div>\n' +
                                            '                                        <div class="row form-group has-feedback">\n' +
                                            '                                            <div class="col-md-12"><label class="control-label">&nbsp;Detail</label>\n' +
                                            '                                        <textarea placeholder="Keterangan" id="desc" type="text"\n' +
                                            '                                                  class="form-control"\n' +
                                            '                                                  name="desc" >' + data.desc + '</textarea>\n' +
                                            '                                            </div>\n' +
                                            '                                        </div>');
                                    },
                                    error: function () {
                                        alert("Nothing Data");
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

        function historyData(id) {
            var tanggal = '';
            var tr = '';
            var tanggal2 = '';
            var urutan = '';
            var tgl = '',
                lakuk = '', isi = '', kontenedit = '';
            prefix = 'row';
            var kontendelet = '', kontentambah = '';

            $.ajax({
                type: 'get',
                url: '{{route('eberkas.history')}}',
                data: {'id': id},
                success: function (data) {
//                    console.log('data');
                    tanggal = '';
                    tanggal = [];
                    urutan = '';
                    urutan = [];
                    tanggal.push(data[0].tanggal.tglStr);
                    urutan.push(0);
                    tgl = '';
                    tgl = {};
                    tr = '';
                    for (var i = 0; i < (data.length - 1); i++) {
                        if (data[i].tanggal.tanggal!==data[data.length-2].tanggal.tanggal) {
                            if (data[i].tanggal.tanggal !== data[i + 1].tanggal.tanggal) {
                                tanggal.push(data[i + 1].tanggal.tglStr);
                                urutan.push(i + 1);
                            }
                        }

                    }
//                    console.log(urutan);
                    lakuk = '';
                    lakuk = [];
                    for (var j = 0; j < (data.length - 1); j++) {
                        if ($.trim(data[j].editan)) {
                            isi = '';
                            for (var k = 0; k < data[j].editan.length; k++) {
                                isi += '<tr>' +
                                    '<td valign="baseline" align="left">' + data[j].editan[k].name + '</td>' +
                                    '<td valign="top">&nbsp;: &nbsp;</td>' +
                                    '<td valign="baseline" align="justify">' + data[j].editan[k].lama + '</td>' +
                                    '<td valign="top">&nbsp; &rarr; &nbsp;</td>' +
                                    '<td valign="baseline" align="justify">' + data[j].editan[k].baru + '</td>' +
                                    '</tr>\n';
                            }
                            kontenedit = '<li><a><table>' + isi +
                                '</table></a></li>';
                        }
                        if ($.trim(data[j].tambahan)) {
                            kontendelet = '';
                            for (var k = 0; k < data[j].tambahan.length; k++) {
                                kontendelet += '<li><a target="_blank" href="' + data[j].tambahan[k].url + '">' + data[j].tambahan[k].name +
                                    '</a></li>';
                            }
                        }
                        if ($.trim(data[j].delete)) {
                            kontentambah = '';
                            for (var k = 0; k < data[j].delete.length; k++) {
                                kontentambah += '<li><a target="_blank" href="' + data[j].delete[k].url + '">' + data[j].delete[k].name +
                                    '</a></li>';
                            }
                        }
                        lakuk[j] = '';
                        if (data[j].deldata == 1) {
                            lakuk[j] = '  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' +
                                'style="padding: 1px 5px;text-align: center;border-radius: 0%;font-size: 14px;" title="Data dihapus oleh ' + data[j].user + '">' +
                                'Menghapus Data' +
                                '</button>';
                        }
                        if (data[j].resdata == 1) {
                            lakuk[j] = '  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' +
                                'style="padding: 1px 5px;text-align: center;border-radius: 0%;font-size: 14px;" title="Data dipulihkan oleh ' + data[j].user + '">' +
                                'Memulihkan Data' +
                                '</button>';
                        }
                        if (data[j].deletes == 1) {
                            lakuk[j] += '<div class="btn-group">\n' +
                                '  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' +
                                'style="padding: 1px 5px;text-align: center;border-radius: 0%;font-size: 14px;" title="klik untuk detail">\n' +
                                'Menghapus File' +
                                '  </button>\n' +
                                '  <div class="dropdown-menu">\n' + kontentambah
                                +
                                '  </div>\n' +
                                '</div>  ';
                        }
                        if (data[j].edit == 1) {
                            lakuk[j] += '<div class="btn-group">\n' +
                                '  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' +
                                'style="padding: 1px 5px;text-align: center;border-radius: 0%;font-size: 14px;" title="klik untuk detail">\n' +
                                'Merubah Data' +
                                '  </button>\n' +
                                '  <div class="dropdown-menu">\n' + kontenedit +
                                '  </div>\n' +
                                '</div>  ';
                        }
                        if (data[j].tambah == 1) {
                            lakuk[j] += '<div class="btn-group">\n' +
                                '  <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"' +
                                'style="padding: 1px 5px;text-align: center;border-radius: 0%;font-size: 14px;" title="klik untuk detail">\n' +
                                'Menambah File' +
                                '  </button>\n' +
                                '  <div class="dropdown-menu">\n' + kontendelet +
                                '  </div>\n' +
                                '</div>  ';
                        }

                    }
//                    console.log(lakuk);
                    for (var i = 0; i < urutan.length; i++) {
                        if (urutan[i] !== urutan[urutan.length - 1]) {
                            tgl[prefix + i] = '';
                            for (var j = urutan[i]; j < urutan[i + 1]; j++) {
                                tgl[prefix + i] += '<tr>' +
                                    '<td>' + data[j].tanggal.waktu + '</td>' +
                                    '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>' +
                                    '<td>' + data[j].user + '</td>' +
                                    '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>' +
                                    '<td>' + lakuk[j] + '</td>' +
                                    '</tr>';
                            }
                        }
                        else {
                            tgl[prefix + i] = '';
                            for (var j = urutan[i]; j < (data.length - 1); j++) {
                                tgl[prefix + i] += '<tr>' +
                                    '<td>' + data[j].tanggal.waktu + '</td>' +
                                    '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>' +
                                    '<td>' + data[j].user + '</td>' +
                                    '<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>' +
                                    '<td>' + lakuk[j] + '</td>' +
                                    '</tr>';
                            }
                        }
                    }

//                    console.log(tgl);
                    tanggal2 = '';
                    for (var i = 0; i < tanggal.length; i++) {
                        tanggal2 += '<strong style="font-size: 15px">' + tanggal[i] + '</strong><table id="table' + i + '"></table>';
                    }
                    $('#modal-form4 #data').empty().append(tanggal2);
                    for (var i = 0; i < tanggal.length; i++) {
                        $('#modal-form4 #data #table' + i).empty().append(tgl[prefix + i]);
                    }
                    $('#modal-form').modal('hide');
                    $('#modal-form4').modal('show');
                    $('#modal-form4 .modal-title4').text('Histori Perubahan Berkas');
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