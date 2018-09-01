@extends('layouts.user.mst_user_relog')
@section('title', 're:eBerkas KPP MADYA | '.\Illuminate\Support\Facades\Auth::user()->name.'`s Profile')
@section('nav')
    <li><a href="{{url('home')}}">Home</a></li>

@endsection
@section('content')
    <div id="semua">
        <div style="padding: 1em 0;" id="fh5co-contact">

            <div class="container">
                <div class="row">
                    <div class="row animate-box">
                        <div class="col-lg-10 col-sm-offset-1  fh5co-heading">

                            <div class="w3-panel w3-card">


                                <div style="padding-top: 2%" class="col-lg-12 text-center">
                                    <h2>Edit Profile</h2>

                                    <span class="help-block">
                                        <strong>Terakhir dirubah:</strong>
                                        <strong id="update"> {{$user->updated_at->formatLocalized('%d %B %Y')}} {{$user->updated_at->format('H:i')}} WIB</strong>
                                    </span>
                                    <form action="" method="post" enctype="multipart/form-data"
                                          class="form-horizontal"
                                    >
                                        {{ csrf_field() }} {{ method_field('post') }}
                                        <input type="hidden" id="id" name="id" value="{{$user->id}}">
                                        <div class="col-lg-4 col-sm-offset-1" style="padding-top: 2%">

                                            @if($user->ava==null)
                                                <img class="data gambar" src="{{asset('images/avatar.png')}}" id="file"
                                                     style="width: 300px">
                                            @else
                                                <img class="data gambar" style="width: 300px"
                                                     src="{{asset($user->ava)}}" id="file">

                                            @endif
                                            <input id="ava" name="ava" type="file" title="pilih gambar" class="data2">

                                            <br>
                                            <br>
                                            <br>
                                        </div>
                                        <div class="col-lg-6" style="padding-top: 2%;padding-left: 5%">
                                            <table>

                                                <td valign="baseline" align="left" width="80px"><b>NIP</b></td>
                                                <td valign="top">:&nbsp;&nbsp;</td>
                                                <td align="justify">
                                                    <div id="nip">{{$user->nip}}</div>
                                                </td>
                                                </tr>
                                                <td valign="baseline" align="left" width="80px"><b>Nama</b></td>
                                                <td valign="top">:&nbsp;&nbsp;</td>
                                                <td align="justify">
                                                    <div id="name2" class="data"
                                                         title="klik 2x untuk edit nama...">{{$user->name}}</div>
                                                    <input placeholder="Nama lengkap" type="text"
                                                           class="form-control data2"
                                                           name="name" id="name" value="{{$user->name}}"
                                                    ></td>
                                                </tr>
                                                </tr>
                                                <td valign="baseline" align="left" width="80px"><b>Password</b></td>
                                                <td valign="top">:&nbsp;&nbsp;</td>
                                                <td align="justify">
                                                    <div id="password2" class="data"
                                                         title="klik 2x untuk edit password...">Ganti Password
                                                    </div>
                                                    <input placeholder="Password" type="password"
                                                           class="form-control data2"
                                                           name="password" id="password"
                                                    ><input type="checkbox" class="data2" id="tampil"
                                                            title="tampilkan password"
                                                            tyle="transform: scale(3);width: 120px;">
                                                    <em class="data2" id="ttampil">Tampilkan Password</em>
                                                </td>
                                                </tr>
                                                <tr>
                                                    <td valign="baseline" align="left" width="80px"><b>TTL</b></td>
                                                    <td valign="top">:&nbsp;&nbsp;</td>
                                                    <td align="justify">
                                                        <div id="ttl" class="data"
                                                             class="data" title="klik 2x untuk edit TTL...">
                                                            @if($user->tempat_lahir!=null&&$user->tgl_lahir!=null)
                                                                {{$user->tempat_lahir.', '.\Carbon\Carbon::createFromFormat('Y-m-d',$user->tgl_lahir)->formatLocalized('%d %B %Y')}}
                                                            @else
                                                                data belum diisi
                                                            @endif
                                                        </div>
                                                        <input placeholder="Tempat Lahir" type="text"
                                                               class="form-control data2"
                                                               name="tempat_lahir" id="tempat_lahir"
                                                               value="@if($user->tempat_lahir!=null){{$user->tempat_lahir}}@endif"
                                                        >
                                                        <input placeholder="Tanggal Lahir" type="text"
                                                               class="form-control data2"
                                                               name="tgl_lahir" id="tgl_lahir"
                                                               value="@if($user->tgl_lahir!=null){{\Illuminate\Support\Carbon::createFromFormat('Y-m-d', $user->tgl_lahir)->format('d/m/Y')}}@endif"
                                                        ></td>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="baseline" align="left" width="80px"><b>Email</b></td>
                                                    <td valign="top">:&nbsp;&nbsp;</td>
                                                    <td align="justify">
                                                        <div id="email2" class="data"
                                                             title="klik 2x untuk edit email...">
                                                            {{$user->email}}
                                                        </div>
                                                        <input placeholder="Email" type="text"
                                                               class="form-control data2"
                                                               name="email" id="email" value="{{$user->email}}"
                                                        >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="baseline" align="left" width="80px"><b>Telp</b></td>
                                                    <td valign="top">:&nbsp;&nbsp;</td>
                                                    <td align="justify">
                                                        <div id="phone2" class="data"
                                                             title="klik 2x untuk edit telp...">
                                                            @if($user->phone!=null)
                                                                {{$user->phone}}
                                                            @else
                                                                Data belum diisi
                                                            @endif
                                                        </div>
                                                        <input placeholder="No Telp." type="text"
                                                               class="form-control data2"
                                                               name="phone" id="phone"
                                                               value="@if($user->phone!=null) {{$user->phone}} @endif"
                                                        >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="baseline" align="left" width="80px">
                                                        @if(is_null($user->posisition_id))
                                                            <b>Seksi</b>
                                                        @else
                                                            <b>Jabatan</b>
                                                        @endif
                                                    </td>
                                                    <td valign="top">:&nbsp;&nbsp;</td>
                                                    <td align="justify">
                                                        <div id="jabatan">
                                                            @if(is_null($user->posisition_id))
                                                                {{\App\trDataJobDesc::findOrFail($user->job_id)->name}}
                                                            @else
                                                                {{\App\trDataPosisition::findOrFail($user->posisition_id)->name.' di '.\App\trDataJobDesc::findOrFail($user->job_id)->name}}
                                                                @if($ganti==1)
                                                                    <em title="menunggu perubahan ke..."> ({{$ke}})</em>
                                                                @endif
                                                            @endif
                                                        </div>
                                                        <select name="job_id" id="job_id"
                                                                class="form-control data2">
                                                            <option value="" selected disabled>Pilih Seksi</option>
                                                            @foreach(\App\trDataJobDesc::all() as $row)
                                                                <option value="{{$row->id}}"
                                                                        @if ($row->id==$user->job_id)
                                                                        selected
                                                                        @endif>{{$row->name}}</option>
                                                            @endforeach
                                                        </select>
                                                        <select name="posisition_id" id="posisition_id"
                                                                class="form-control data2">
                                                            <option value="" selected disabled>Pilih Posisi Seksi
                                                            </option>
                                                            @foreach($category as $row)
                                                                <option value="{{$row->id}}"
                                                                        @if ($row->id==$user->posisition_id)
                                                                        selected
                                                                        @endif>{{$row->name}}</option>
                                                            @endforeach
                                                        </select>

                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="baseline" align="left" width="80px"><b>Alamat</b></td>
                                                    <td valign="top">:&nbsp;&nbsp;</td>
                                                    <td align="justify">
                                                        <div id="alamat2" class="data">
                                                            @if($user->alamat!=null)
                                                                {{$user->alamat}}
                                                            @else
                                                                Data belum diisi
                                                            @endif
                                                        </div>
                                                        <input placeholder="Alamat" type="text"
                                                               class="form-control data2"
                                                               name="alamat" id="alamat" value="@if($user->alamat!=null)
                                                        {{$user->alamat}}
                                                        @endif"
                                                        >
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td valign="baseline" align="left" width="80px"><b>Biografi</b></td>
                                                    <td valign="top">:&nbsp;&nbsp;</td>
                                                    <td align="justify">
                                                        <div class="data" id="bio2">
                                                            @if($user->bio!=null)
                                                                {!! $user->bio !!}
                                                            @else
                                                                Data belum diisi
                                                            @endif
                                                        </div>
                                                        <textarea class="form-control data2" placeholder="Keterangan"
                                                                  id="bio"
                                                                  name="bio">@if($user->bio!=null)
                                                                {!! $user->bio !!}
                                                        @endif</textarea></td>
                                                </tr>
                                            </table>
                                            <br>
                                            <br>
                                            <br>
                                            <button type="submit" value="submit" id="submit">submit</button>
                                        </div>
                                    </form>

                                </div>
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
        var a = 2, b = 2;
        var base_url = '{!!URL::to('')!!}' + '/';
        $('#semua form .data2').hide();
        $('#semua form #submit').hide();

        $(document).ready(function () {
            $('#tgl_lahir').datepicker();

            $('#semua form .data2').click(function () {
                a = 2;
                b = 1;
            });
            $('#semua form .data').click(function () {
                a = 2;
                b = 1;
            });

            $(document).click(function (e) {
                if (!$(e.target).is('#semua form .data2') || !$(e.target).is('#semua form .data'))
                    a = 1;
            });

            $(document).on('change', '#tampil', function () {
                if ($("#tampil").prop('checked') == true) {
                    $("#password").prop('type', 'text');
                } else {
                    $("#password").prop('type', 'password');
                }
            });

            $(document).on('change', '#job_id', function () {


                var kota_id = $(this).val();
                console.log(kota_id);

//                var div = $(this).parent();
                var op = " ";

                $.ajax({
                    type: 'get',
                    url: '{{route('user.getjob')}}',
                    data: {'id': kota_id},
                    success: function (data) {
                        console.log('success');
                        console.log(data);

                        op += '<option value="0" selected disabled>-- Pilih Bagian Seksi --</option>';
                        for (var i = 0; i < data.length; i++) {

                            op += '<option value="' + data[i].id + '">' + data[i].name + '</option>';
                        }

                        $('#posisition_id').html(" ");
                        $('#posisition_id').append(op);


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

            setInterval(function () {
                // getRealData()
            }, 10000);//request every x seconds

            {{--function getRealData() {--}}
                {{--$.ajax({--}}
                    {{--type: 'get',--}}
                    {{--url: '{{route('user.waktu')}}',--}}
                    {{--success: function (data) {--}}
                        {{--if (data.statusupdate == true) {--}}
                            {{--console.log(data);--}}
                            {{--$('#jabatan').text(data.rubah.posisition + ' di ' + data.rubah.job);--}}
                            {{--$job = '';--}}
                            {{--$posisition = '';--}}
                            {{--$job += '<option value="" selected disabled>Pilih Seksi</option>';--}}
                            {{--$posisition += '<option value="" selected disabled>Pilih Jabatan</option>';--}}

                            {{--$jobs = [];--}}
                            {{--$posisitions = [];--}}
                            {{--for ($i = 0; $i < data.listjob.length; $i++) {--}}
                                {{--if (data.listjob[$i].id == data.rubah.job_id) {--}}
                                    {{--$jobs.push('selected');--}}
                                {{--}--}}
                                {{--else {--}}
                                    {{--$jobs.push('');--}}
                                {{--}--}}
                            {{--}--}}
                            {{--for ($i = 0; $i < data.listjob.length; $i++) {--}}
                                {{--$job += '<option value="' + data.listjob[$i].id + '" ' + $jobs[$i] + '>' + data.listjob[$i].name + '</option>';--}}
                            {{--}--}}
                            {{--for ($i = 0; $i < data.listposisition.length; $i++) {--}}
                                {{--if (data.listposisition[$i].id == data.rubah.posisition_id) {--}}
                                    {{--$posisitions.push('selected');--}}
                                {{--}--}}
                                {{--else {--}}
                                    {{--$posisitions.push('');--}}
                                {{--}--}}
                            {{--}--}}
                            {{--for ($i = 0; $i < data.listposisition.length; $i++) {--}}
                                {{--$posisition += '<option value="' + data.listposisition[$i].id + '" ' + $posisitions[$i] + '>' + data.listposisition[$i].name + '</option>';--}}
                            {{--}--}}

                            {{--$('#job_id').empty().append($job);--}}
                            {{--$('#posisition_id').empty().append($posisition);--}}
                            {{--if (data.statusperubahan == 1) {--}}
                                {{--swal({--}}
                                    {{--title: 'Berhasil!',--}}
                                    {{--text: 'Permintaan Perubahan Jabatan diterima',--}}
                                    {{--type: 'success',--}}
                                    {{--timer: '1500'--}}
                                {{--})--}}
                            {{--}--}}
                            {{--else {--}}
                                {{--swal({--}}
                                    {{--title: 'Gagal!',--}}
                                    {{--text: 'Permintaan Perubahan Jabatan ditolak',--}}
                                    {{--type: 'error',--}}
                                    {{--timer: '1500'--}}
                                {{--})--}}
                            {{--}--}}
                        {{--}--}}
                        {{--$('#update').text(data.waktu);--}}
                    {{--},--}}
                    {{--error: function () {--}}
                        {{--swal({--}}
                            {{--title: 'Oops...',--}}
                            {{--text: 'something wrong!',--}}
                            {{--type: 'error',--}}
                            {{--timer: '1500'--}}
                        {{--})--}}
                    {{--}--}}
                {{--});--}}

            {{--}--}}

        });

        $('#semua').click(function () {
            console.log(b);
            console.log(a);
            if ($("#ava").val() != '' || $("#name").val() != '' || $("#tempat_lahir").val() != '' || $("#tgl_lahir").val() != ''
                || $("#phone").val() != '' || $("#bio").val() != '' || $("#email").val() != '' || $("#posisition_id").val() != ''
                || $("#job_id").val() != '') {

                if (b == 2) {

                }
                else if (a == 2) {

                }

                else {
                    $('#semua form').submit();
                }


            }
            else {
                console.log('asdas');
            }
        });
        var ganti2;


        $('#semua form').on('submit', function (e) {
            b = 2;
            var op = '', op2 = '', sel = [], sel2 = [];

            if (!e.isDefaultPrevented()) {
                swal({
                    title: 'Konfirmasi Keamanan',
                    html:
                        '<input id="swal-input1" placeholder="Masukkan Password" type="password" class="form-control mb-1" autofocus>',
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
                                    b = 1;
                                    a = 2;
                                    swal({
                                        title: 'Password Kosong!',
                                        text: 'Harap Masukkan Password!',
                                        type: 'error',
                                        timer: '1500'
                                    })
                                }
                                else if (data.status == 1) {
//                    $(':input[type="submit"]').prop('disabled', true);

                                    $('#semua form :input').prop('readonly', true);
                                    $.ajax({
                                        type: 'post',
                                        url: '{{route('user.store')}}',
                                        data: new FormData($('#semua form')[0]),
                                        contentType: false,
                                        processData: false,
                                        success: function (data) {
//                            console.log('success');
                                            $('#update').text(data.waktu);
                                            console.log(data);
                                            $('#semua form .data').empty();
                                            $('#name2').append(data.name);
                                            $('#password2').append('Ganti Password');
                                            $('#ttl').append(data.ttl);
                                            $('#email2').append(data.email);
                                            $('#phone2').append(data.phone);
//                            $('#jabatan').append(data.jabatan);
                                            $('#alamat2').append(data.alamat);
                                            $('#bio2').empty().append(data.bio);
                                            $('#semua form .data2').hide();
                                            $('#semua form :input').prop('readonly', false);
                                            $('#semua form .data2').val('');
                                            $('#semua form .data2').empty();
                                            $('#name').val(data.name);
                                            $('#ttampil').append('Tampilkan Password');
                                            $('#tempat_lahir').val(data.tempat_lahir);
                                            $('#tgl_lahir').val(data.tgl_lahir);
                                            $('#email').val(data.email);
                                            $('#phone').val(data.phone);
                                            $('#alamat').val(data.alamat);
                                            $('#bio').val(data.bio);
                                            for (var i = 0; i < data.job.length; i++) {
                                                if (data.job_id == data.job[i].id) {
                                                    sel.push('selected');
                                                }
                                                else {
                                                    sel.push('');
                                                }
                                            }
                                            for (var i = 0; i < data.posisition.length; i++) {
                                                if (data.posisition_id == data.posisition[i].id) {
                                                    sel2.push('selected');
                                                }
                                                else {
                                                    sel2.push('');
                                                }
                                            }
                                            op += '<option value="" selected disabled>Pilih Seksi</option>\n';
                                            for (var i = 0; i < data.job.length; i++) {
                                                op += '<option value="' + data.job[i].id + '" ' + sel[i] + '>' + data.job[i].name + '</option>\n';
                                            }
                                            op2 += '<option value="" selected disabled>Pilih Posisi Seksi</option>\n';
                                            for (var i = 0; i < data.posisition.length; i++) {
                                                op2 += '<option value="' + data.posisition[i].id + '" ' + sel2[i] + '>' + data.posisition[i].name + '</option>\n';
                                            }
                                            if (data.status == 1) {
                                                $('#jabatan').append('<em title="menunggu pergantiaan"> (ke ' + data.jabatan + ')</em>');
                                                data2 = data.status;
                                            }
                                            $('#job_id').append(op);
                                            $('#posisition_id').append(op2);
                                            if ($.trim(data.file2)) {
                                                $('#semua form .gambar').removeAttr('src');
                                                $('#semua form .gambar').attr("src", base_url + data.file2);
                                            }

                                            $('#semua form .data').show();
                                            $('#semua form #jabatan').show();
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


                                    return false;

                                }
                                else {
                                    b = 1;
                                    a = 2;
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


        $("#file").dblclick(function () {
            b = 1;
            a = 2;
            $('#file').hide();
            $('#ava').show();
            $('#ava').focus();
        });

        $("#name2").dblclick(function () {
            b = 1;
            a = 2;
            $('#name2').hide();
            $('#name').show();
            $('#name').focus();
        });
        $("#ttl").dblclick(function () {
            b = 1;
            a = 2;
            $('#ttl').hide();
            $('#tempat_lahir').show();
            $('#tempat_lahir').focus();
            $('#tgl_lahir').show();
        });
        $("#email2").dblclick(function () {
            $('#email2').hide();
            b = 1;
            a = 2;
            $('#email').show();
            $('#email').focus();
        });
        $("#phone2").dblclick(function () {
            $('#phone2').hide();
            b = 1;
            a = 2;
            $('#phone').show();
            $('#phone').focus();
        });
        $("#jabatan").dblclick(function () {
            var ganti = '{{$ganti}}';
            console.log('gantui '+ganti);
            if (ganti == 1) {
                swal({
                    title: 'Peringatan!',
                    text: 'Harap tunggu konfirmasi dari admin!',
                    type: 'info',
                    timer: '1500'
                })
            }
            else {
                $.ajax({
                    type: 'get',
                    url: '{{route('user.kirim')}}',
                    data: {'id': $('#semua form #id').val()},
                    success: function (data) {
                        console.log(data);
                        if (data.statuskirim>0) {
                            if (!$.trim(data.list)) {
                                swal({
                                    title: 'info!',
                                    text: 'Harap tunggu konfirmasi dari admin!',
                                    type: 'info',
                                    timer: '1500'
                                })
                            }
                            else {
                                swal({
                                    title: 'info!',
                                    text: "Perubahan jabatan memerlukan konfirmasi admin web!",
                                    type: 'info',
                                    showCancelButton: true,
                                    cancelButtonColor: '#d33',
                                    confirmButtonColor: '#3085d6',
                                    confirmButtonText: 'Lanjutkan!'
                                }).then(function (isConfirm) {

                                    if (!$.trim(isConfirm.dismiss)) {

                                        $('#jabatan').hide();
                                        b = 1;
                                        a = 2;
                                        $('#posisition_id').show();
                                        $('#posisition_id').focus();
                                        $('#job_id').show();
                                    }
                                })

                            }
                        }
                        else {
                            swal({
                                title: 'Peringatan!',
                                text: "Perubahan jabatan memerlukan konfirmasi admin web!",
                                type: 'info',
                                showCancelButton: true,
                                cancelButtonColor: '#d33',
                                confirmButtonColor: '#3085d6',
                                confirmButtonText: 'Lanjutkan!'
                            }).then(function (isConfirm) {

                                if (!$.trim(isConfirm.dismiss)) {

                                    $('#jabatan').hide();
                                    b = 1;
                                    a = 2;
                                    $('#posisition_id').show();
                                    $('#posisition_id').focus();
                                    $('#job_id').show();
                                }
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

        });
        $("#bio2").dblclick(function () {
            b = 1;
            a = 2;
            $('#bio2').hide();
            $('#bio').show();
            $('#bio').focus();
        });
        $("#password2").dblclick(function () {
            b = 1;
            a = 2;
            $('#password2').hide();
            $('#password').show();
            $('#password').focus();
            $('#tampil').show();
            $('#ttampil').show();
        });
        $("#alamat2").dblclick(function () {
            b = 1;
            a = 2;
            $('#alamat2').hide();
            $('#alamat').show();
            $('#alamat').focus();
        });
        $("#nip").dblclick(function () {
            swal({
                title: 'Peringatan!',
                text: 'NIP tidak bisa dirubah!',
                type: 'error',
                timer: '1500'
            })
        });

    </script>
@endsection
