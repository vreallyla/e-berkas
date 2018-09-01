{{--variable--}}
<script>
    var $index2 = '';
    var pagination2 = {}, search2 = {};
    var prefix2 = 'user';
    var selectuser = [];
    @foreach($jobCategory as $row)
        pagination2[prefix2 + '{{$row->id}}'] = 1;
    search2[prefix2 + '{{$row->id}}'] = '';
    @endforeach
        pagination2[prefix2 + 'na'] = 1;
    search2[prefix2 + 'na'] = '';
</script>
{{--variable--}}
{{--callpenghuni--}}
<script>
    function changePenghuni(id) {
        $index2 = $(id).data('id');
        $pagi = pagination2[prefix2 + $index2];
        $('.content .row').css("opacity", 0.4);
        $('#load2').fadeIn(500);
        if ($index2 == 0) {
            $('.box-footer').hide(500);
            $('.content .row').css("opacity", 1);
            $('#load2').hide(500);
        }
        else if ($index2 == 'na') {
            $('.box-footer').hide(500);
            $('.content .row').css("opacity", 1);
            $('#load2').hide(500);

            console.log('na');
            $.ajax({
                url: "{{route('admin.table.penghuni.histori')}}",
                type: "get",
                data: {
                    // 'id': $index2,
                    'pagination': pagination2[prefix2 + $index2],
                    'search': search2[prefix2 + $index2]
                },
                success: function (data) {
                    console.log(data);
                    $('.checkall').prop('checked', false);
                    selectuser = [];
                    $('.box-footer').hide(500);
                    if (data.status == 0) {
                        $('#job' + $index2 + ' table tbody').empty().append('<tr><td colspan="6">Data Kosong...</td></tr>').fadeIn(2000);
                        $('.box-footer').hide(500);
                        $('#job' + $index2 + ' .checkall').attr("disabled", true);
                        pengguna = 0;
                    }
                    else {
                        $maxpage = data.pagination;
                        $('#job' + $index2 + ' .checkall').removeAttr("disabled");
                        $dataloop2 = '';
                        // console.log(data);
                        $emailstatus = [];
                        $emaildetail = [];
                        $.each(data.list, function (key, value) {
                            if (value.status == 'y') {
                                $emailstatus.push('/aprove.png');
                                $emaildetail.push('email sudah terkirim');
                            }
                            else {
                                $emailstatus.push('/fail.png');
                                $emaildetail.push('email gagal dikirim');
                            }
                        });
                        $.each(data.list, function (key, value) {
                            $dataloop2 += '<tr>\n' +
                                '                                                                    <td>\n' +
                                '                                                                        <input type="checkbox"\n' +
                                '                                                                               title="centang ' + value.name + '"\n' +
                                '                                                                               class="ceksurat"\n' +
                                '                                                                               data-id="' + value.id + '"\n' +
                                '                                                                               style="width: 30px">\n' +
                                '                                                                    </td>\n' +
                                '                                                                    <td>' + value.nip + '</td>\n' +
                                '                                                                    <td>' + value.name + '</td>\n' +
                                '                                                                    <td>' + value.posisition_id + ' di ' + value.job_id + '</td>\n' +
                                '                                                                    <td>' + value.role_id + '</td>\n' +
                                '<td><img src="{!!URL::to('aprrovement')!!}' + $emailstatus[key] + '"\n' +
                                '                                                     style="width: 15px;height: auto;" title="' + $emaildetail[key] + '">' +
                                '<td>\n ' +
                                '<button class="btn btn-default" type="button"\n' +
                                '                                                                data-toggle="tooltip"\n' +
                                '                                                                onclick="resendEmail(\'' + value.id + '\')"\n' +
                                '                                                                title="Kirim Ulang ke Email Berdasarkan Pilihan"\n' +
                                '                                                                readonly="true"><i\n' +
                                '                                                                    class="fa fa-reply" data-method="0"></i> Resend\n' +
                                '                                                        </button>' +
                                '                                                                        </td>\n' +
                                '                                                                </tr>';
                        });
                        // filltable
                        $('#job' + $index2 + ' table tbody').empty().append($dataloop2).show(1500);
                        // filltable
                        // pagination
                        $dataafter = '';
                        $databefore = '';
                        for ($i = 1; $i <= $maxpage; $i++) {
                            $dataafter += '<button href="javascript:void(0)" data-per="' + $index2 + '" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                        }
                        if ($maxpage > 5) {
                            if ($pagi > (parseInt($maxpage) - 3)) {
                                $dataafter = '';
                                $databefore = '';
                                for ($i = ($maxpage - 4); $i <= $maxpage; $i++) {
                                    $databefore += '<button href="javascript:void(0)" data-per="' + $index2 + '" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                                }
                                $dataafter = '<button href="javascript:void(0)" " data-per="' + $index2 + '" data-action="1" class="pagiLast btn page gradient">1</button>\n' +
                                    '<button href="javascript:void(0)" " data-per="' + $index2 + '" data-action="' + (parseInt($maxpage) - 5) + '" class="pagiVar1 btn page gradient">..</button>\n' + $databefore;
                            }
                            else if ($pagi > 3) {
                                $dataafter = '';
                                $databefore = '';
                                for ($i = (parseInt($pagi) - 2); $i <= ($pagi + 3); $i++) {
                                    $databefore += '<button href="javascript:void(0)" data-per="' + $index2 + '" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                                }
                                $dataafter = '<button href="javascript:void(0)" " data-per="' + $index2 + '" data-action="1" class="pagiLast btn page gradient">1</button>\n' +
                                    '<button href="javascript:void(0)" " data-per="' + $index2 + '" data-action="' + (parseInt($pagi) - 3) + '" class="pagiVar1 btn page gradient">..</button>\n' + $databefore +
                                    '<button href="javascript:void(0)" " data-per="' + $index2 + '" data-action="' + ($pagi + 3) + '" class="pagiVar2 btn page gradient">..</button>\n' +
                                    '<button href="javascript:void(0)" " data-per="' + $index2 + '" data-action="' + $maxpage + '" class="pagiVar2 btn page gradient">' + $maxpage + '</button>\n';
                            }

                            else {
                                $dataafter = '';
                                $databefore = '';
                                for ($i = 1; $i <= 5; $i++) {
                                    $databefore += '<button href="javascript:void(0)" data-per="' + $index2 + '" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                                }
                                $dataafter = $databefore +
                                    '<button href="javascript:void(0)" " data-per="' + $index2 + '" data-action="' + 6 + '" class="pagiVar2 btn page gradient">..</button>\n' +
                                    '<button href="javascript:void(0)" " data-per="' + $index2 + '" data-action="' + $maxpage + '" class="pagiVar2 btn page gradient">' + $maxpage + '</button>\n';
                            }

                        }


                        $('.box-footer').hide(500);
                        pengguna = 0;
                        if ($maxpage > 1) {
                            pengguna = 1;
                            $('.box-footer').show(500);
                            $('#pagination').hide(500);
                            $('#pagiuser').show(500);
                            $('#pagiuser').empty().append('<button href="javascript:void(0)" data-per="' + $index2 + '" data-action="' + (parseInt($pagi) - 1) + '"\n' +
                                '                                            class="pagiPrevious btn page gradient"><span\n' +
                                '                                                class="fa fa-caret-left"></span></button>\n' + $dataafter +
                                '<button href="javascript:void(0)" data-action="' + (parseInt($pagi) + 1) + '" data-per="' + $index2 + '" class="pagiNext btn page gradient"><span class="fa fa-caret-right"></span></button>');
                            // pagination
                        }
                        if ($pagi == $maxpage) {
                            $('#pagiuser .pagiNext').data('action', 1);
                        }
                        else {
                            $('#pagiuser .pagiNext').data('action', (parseInt($pagi) + 1));
                        }
                        if ($pagi == 1) {
                            $('#pagiuser .pagiPrevious').data('action', $maxpage);
                        }
                        else {
                            $('#pagiuser .pagiPrevious').data('action', (parseInt($pagi) - 1));
                        }

                        $pagi2 = $('#pagiuser .pagi' + $pagi);
                        $pagi2.removeClass('gradient').show(1500);
                        $pagi2.addClass('active').show(1500);
                        $pagi2.prop('disabled', true);
                        $pagi2.siblings().removeClass('active');
                        $pagi2.siblings().addClass('gradient');
                        $pagi2.siblings().prop('disabled', false);
                        // pagination
                    }
                    $('#load2').fadeOut(1000);
                    $('.content .row').css("opacity", 1).fadeIn(1000);
                },
                error: function () {
                    $('.checkall').prop('checked', false);
                    $('#load2').hide();
                    $('.content .row').css("opacity", 1);
                    errorNotif();
                }
            });

        }
        else {
            $('#job' + $index2 + ' table tbody').empty().append('<tr><td colspan="6">loading...</td></tr>');
            $.ajax({
                url: "{{route('admin.table.penghuni.api')}}",
                type: "get",
                data: {
                    'id': $index2,
                    'pagination': pagination2[prefix2 + $index2],
                    'search': search2[prefix2 + $index2]
                },
                success: function (data) {
                    $('.checkall').prop('checked', false);
                    selectuser = [];
                    $('.box-footer').hide(500);
                    if (data.status == 0) {
                        $('#job' + $index2 + ' table tbody').empty().append('<tr><td colspan="6">Data Kosong...</td></tr>').fadeIn(2000);
                        $('.box-footer').hide(500);
                        $('#job' + $index2 + ' .checkall').attr("disabled", true);
                        pengguna = 0;
                    }
                    else {
                        $maxpage = data.pagination;
                        $('#job' + $index2 + ' .checkall').removeAttr("disabled");
                        $dataloop2 = '';
                        // console.log(data);
                        $.each(data.list, function (key, value) {
                            $dataloop2 += '<tr>\n' +
                                '                                                                    <td>\n' +
                                '                                                                        <input type="checkbox"\n' +
                                '                                                                               title="centang ' + value.name + '"\n' +
                                '                                                                               class="ceksurat"\n' +
                                '                                                                               data-id="' + value.id + '"\n' +
                                '                                                                               style="width: 30px">\n' +
                                '                                                                    </td>\n' +
                                '                                                                    <td>' + value.nip + '</td>\n' +
                                '                                                                    <td>' + value.name + '</td>\n' +
                                '                                                                    <td>' + value.ps + '</td>\n' +
                                '                                                                    <td>' + value.role + '</td>\n' +
                                '                                                                        <td>\n' +
                                '                                                                            <div class="btn-group">\n' +
                                '                                                                                <button type="button"\n' +
                                '                                                                                        class="btn btn-default lihatuser"\n' +
                                '                                                                                        data-action="lihat"\n' +
                                '                                                                                        data-id="' + value.id + '"\n' +
                                '                                                                                        data-status="0"\n' +
                                '                                                                                        onclick="lihatuser(this)">\n' +
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
                                '                                                                                           class="lihatuser"\n' +
                                '                                                                                           data-action="edit"\n' +
                                '                                                                                           data-status="0"\n' +
                                '                                                                                           data-id="' + value.id + '"\n' +
                                '                                                                                           onclick="lihatuser(this)">Rubah</a>\n' +
                                '                                                                                    </li>\n' +
                                '                                                                                    <li><a href="javascript:void(0)"\n' +
                                '                                                                                           onclick="hapususer(' + value.id + ')">Bekukan</a>\n' +
                                '                                                                                    </li>\n' +
                                '                                                                                </ul>\n' +
                                '                                                                            </div>\n' +
                                '                                                                        </td>\n' +
                                '                                                                </tr>';
                        });
                        // filltable
                        $('#job' + $index2 + ' table tbody').empty().append($dataloop2).show(1500);
                        // filltable
                        // pagination
                        $dataafter = '';
                        $databefore = '';
                        for ($i = 1; $i <= $maxpage; $i++) {
                            $dataafter += '<button href="javascript:void(0)" data-per="' + $index2 + '" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                        }
                        if ($maxpage > 5) {
                            if ($pagi > (parseInt($maxpage) - 3)) {
                                $dataafter = '';
                                $databefore = '';
                                for ($i = ($maxpage - 4); $i <= $maxpage; $i++) {
                                    $databefore += '<button href="javascript:void(0)" data-per="' + $index2 + '" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                                }
                                $dataafter = '<button href="javascript:void(0)" " data-per="' + $index2 + '" data-action="1" class="pagiLast btn page gradient">1</button>\n' +
                                    '<button href="javascript:void(0)" " data-per="' + $index2 + '" data-action="' + (parseInt($maxpage) - 5) + '" class="pagiVar1 btn page gradient">..</button>\n' + $databefore;
                            }
                            else if ($pagi > 3) {
                                $dataafter = '';
                                $databefore = '';
                                for ($i = (parseInt($pagi) - 2); $i <= ($pagi + 3); $i++) {
                                    $databefore += '<button href="javascript:void(0)" data-per="' + $index2 + '" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                                }
                                $dataafter = '<button href="javascript:void(0)" " data-per="' + $index2 + '" data-action="1" class="pagiLast btn page gradient">1</button>\n' +
                                    '<button href="javascript:void(0)" " data-per="' + $index2 + '" data-action="' + (parseInt($pagi) - 3) + '" class="pagiVar1 btn page gradient">..</button>\n' + $databefore +
                                    '<button href="javascript:void(0)" " data-per="' + $index2 + '" data-action="' + ($pagi + 3) + '" class="pagiVar2 btn page gradient">..</button>\n' +
                                    '<button href="javascript:void(0)" " data-per="' + $index2 + '" data-action="' + $maxpage + '" class="pagiVar2 btn page gradient">' + $maxpage + '</button>\n';
                            }

                            else {
                                $dataafter = '';
                                $databefore = '';
                                for ($i = 1; $i <= 5; $i++) {
                                    $databefore += '<button href="javascript:void(0)" data-per="' + $index2 + '" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                                }
                                $dataafter = $databefore +
                                    '<button href="javascript:void(0)" " data-per="' + $index2 + '" data-action="' + 6 + '" class="pagiVar2 btn page gradient">..</button>\n' +
                                    '<button href="javascript:void(0)" " data-per="' + $index2 + '" data-action="' + $maxpage + '" class="pagiVar2 btn page gradient">' + $maxpage + '</button>\n';
                            }

                        }


                        $('.box-footer').hide(500);
                        pengguna = 0;
                        if ($maxpage > 1) {
                            pengguna = 1;
                            $('.box-footer').show(500);
                            $('#pagination').hide(500);
                            $('#pagiuser').show(500);
                            $('#pagiuser').empty().append('<button href="javascript:void(0)" data-per="' + $index2 + '" data-action="' + (parseInt($pagi) - 1) + '"\n' +
                                '                                            class="pagiPrevious btn page gradient"><span\n' +
                                '                                                class="fa fa-caret-left"></span></button>\n' + $dataafter +
                                '<button href="javascript:void(0)" data-action="' + (parseInt($pagi) + 1) + '" data-per="' + $index2 + '" class="pagiNext btn page gradient"><span class="fa fa-caret-right"></span></button>');
                            // pagination
                        }
                        if ($pagi == $maxpage) {
                            $('#pagiuser .pagiNext').data('action', 1);
                        }
                        else {
                            $('#pagiuser .pagiNext').data('action', (parseInt($pagi) + 1));
                        }
                        if ($pagi == 1) {
                            $('#pagiuser .pagiPrevious').data('action', $maxpage);
                        }
                        else {
                            $('#pagiuser .pagiPrevious').data('action', (parseInt($pagi) - 1));
                        }

                        $pagi2 = $('#pagiuser .pagi' + $pagi);
                        $pagi2.removeClass('gradient').show(1500);
                        $pagi2.addClass('active').show(1500);
                        $pagi2.prop('disabled', true);
                        $pagi2.siblings().removeClass('active');
                        $pagi2.siblings().addClass('gradient');
                        $pagi2.siblings().prop('disabled', false);
                        // pagination
                    }
                    $('#load2').fadeOut(1000);
                    $('.content .row').css("opacity", 1).fadeIn(1000);
                },
                error: function () {
                    $('.checkall').prop('checked', false);
                    $('#load2').hide();
                    $('.content .row').css("opacity", 1);
                    errorNotif();
                }
            });
        }
    }
</script>
{{--callpenghuni--}}

{{--pagination--}}
<script>
    $('#pagiuser').on('click', '.page', function (asd) {
        $pagi = $(this).data('action');
        $index2 = $(this).data('per');
        pagination2[prefix2 + $index2] = $pagi;
        getData2($index2, $pagi);
    });
</script>
{{--pagination--}}
{{--getdata pagination--}}
<script>
    function getData2($index2, $pagi) {
        $('.content .row').css("opacity", 0.4);
        $('#load2').fadeIn(500);
        $('#job' + $index2 + ' table tbody').empty().append('<tr><td colspan="6">loading...</td></tr>');
        $.ajax({
            url: "{{route('admin.table.penghuni.api')}}",
            type: "get",
            data: {'id': $index2,
                'pagination': $pagi,
                'search': search2[prefix2 + $index2]},
            success: function (data) {
                // pagination2[prefix2 + $index2] = $pagi;
                // console.log(pagination2[prefix2 + $index2]);
                console.log(data);
                $('.checkall').prop('checked', false);
                selectuser = [];
                if (data.status == 0) {
                    $('#job' + $index2 + ' table tbody').empty().append('<tr><td colspan="6">Data Kosong...</td></tr>').fadeIn(2000);
                    $('#job' + $index2 + ' .checkall').attr("disabled", true);
                    surat = 0;
                    $('.box-footer').hide(500);
                }
                else {
                    $('#job' + $index2 + ' .checkall').removeAttr("disabled");
                    $maxpage = data.pagination;

                    $dataloop2 = '';
                    console.log(data);
                    if ($index2=='na'){
                        $emailstatus = [];
                        $emaildetail = [];
                        $.each(data.list, function (key, value) {
                            if (value.status == 'y') {
                                $emailstatus.push('/aprove.png');
                                $emaildetail.push('email sudah terkirim');
                            }
                            else {
                                $emailstatus.push('/fail.png');
                                $emaildetail.push('email gagal dikirim');
                            }
                        });
                        $.each(data.list, function (key, value) {
                            $dataloop2 += '<tr>\n' +
                                '                                                                    <td>\n' +
                                '                                                                        <input type="checkbox"\n' +
                                '                                                                               title="centang ' + value.name + '"\n' +
                                '                                                                               class="ceksurat"\n' +
                                '                                                                               data-id="' + value.id + '"\n' +
                                '                                                                               style="width: 30px">\n' +
                                '                                                                    </td>\n' +
                                '                                                                    <td>' + value.nip + '</td>\n' +
                                '                                                                    <td>' + value.name + '</td>\n' +
                                '                                                                    <td>' + value.posisition_id + ' di ' + value.job_id + '</td>\n' +
                                '                                                                    <td>' + value.role_id + '</td>\n' +
                                '<td><img src="{!!URL::to('aprrovement')!!}' + $emailstatus[key] + '"\n' +
                                '                                                     style="width: 15px;height: auto;" title="' + $emaildetail[key] + '">' +
                                '<td>\n ' +
                                '<button class="btn btn-default" type="button"\n' +
                                '                                                                data-toggle="tooltip"\n' +
                                '                                                                onclick="resendEmail(\'' + value.id + '\')"\n' +
                                '                                                                title="Kirim Ulang ke Email Berdasarkan Pilihan"\n' +
                                '                                                                readonly="true"><i\n' +
                                '                                                                    class="fa fa-reply" data-method="0"></i> Resend\n' +
                                '                                                        </button>' +
                                '                                                                        </td>\n' +
                                '                                                                </tr>';
                        });
                    }else {
                        $.each(data.list, function (key, value) {
                            $dataloop2 += '<tr>\n' +
                                '                                                                    <td>\n' +
                                '                                                                        <input type="checkbox"\n' +
                                '                                                                               title="centang ' + value.name + '"\n' +
                                '                                                                               class="ceksurat"\n' +
                                '                                                                               data-id="' + value.id + '"\n' +
                                '                                                                               style="width: 30px">\n' +
                                '                                                                    </td>\n' +
                                '                                                                    <td>' + value.nip + '</td>\n' +
                                '                                                                    <td>' + value.name + '</td>\n' +
                                '                                                                    <td>' + value.ps + '</td>\n' +
                                '                                                                    <td>' + value.role + '</td>\n' +
                                '                                                                        <td>\n' +
                                '                                                                            <div class="btn-group">\n' +
                                '                                                                                <button type="button"\n' +
                                '                                                                                        class="btn btn-default lihatuser"\n' +
                                '                                                                                        data-action="lihat"\n' +
                                '                                                                                        data-id="' + value.id + '"\n' +
                                '                                                                                        data-status="0"\n' +
                                '                                                                                        onclick="lihatuser(this)">\n' +
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
                                '                                                                                           class="lihatuser"\n' +
                                '                                                                                           data-action="edit"\n' +
                                '                                                                                           data-status="0"\n' +
                                '                                                                                           data-id="' + value.id + '"\n' +
                                '                                                                                           onclick="lihatuser(this)">Rubah</a>\n' +
                                '                                                                                    </li>\n' +
                                '                                                                                    <li><a href="javascript:void(0)"\n' +
                                '                                                                                           onclick="hapususer(' + value.id + ')">Hapus</a>\n' +
                                '                                                                                    </li>\n' +
                                '                                                                                </ul>\n' +
                                '                                                                            </div>\n' +
                                '                                                                        </td>\n' +
                                '                                                                </tr>';
                        });
                    }
                    // filltable
                    $('#job' + $index2 + ' table tbody').empty().append($dataloop2).show(1500);
                    // filltable
                    // pagination
                    $dataafter = '';
                    $databefore = '';
                    for ($i = 1; $i <= $maxpage; $i++) {
                        $dataafter += '<button href="javascript:void(0)" data-per="' + $index2 + '" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                    }
                    if ($maxpage > 5) {
                        if ($pagi > (parseInt($maxpage) - 3)) {
                            $dataafter = '';
                            $databefore = '';
                            for ($i = ($maxpage - 4); $i <= $maxpage; $i++) {
                                $databefore += '<button href="javascript:void(0)" data-per="' + $index2 + '" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                            }
                            $dataafter = '<button href="javascript:void(0)" " data-per="' + $index2 + '" data-action="1" class="pagiLast btn page gradient">1</button>\n' +
                                '<button href="javascript:void(0)" " data-per="' + $index2 + '" data-action="' + (parseInt($maxpage) - 5) + '" class="pagiVar1 btn page gradient">..</button>\n' + $databefore;
                        }
                        else if ($pagi > 3) {
                            $dataafter = '';
                            $databefore = '';
                            for ($i = (parseInt($pagi) - 2); $i <= ($pagi + 3); $i++) {
                                $databefore += '<button href="javascript:void(0)" data-per="' + $index2 + '" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                            }
                            $dataafter = '<button href="javascript:void(0)" " data-per="' + $index2 + '" data-action="1" class="pagiLast btn page gradient">1</button>\n' +
                                '<button href="javascript:void(0)" " data-per="' + $index2 + '" data-action="' + (parseInt($pagi) - 3) + '" class="pagiVar1 btn page gradient">..</button>\n' + $databefore +
                                '<button href="javascript:void(0)" " data-per="' + $index2 + '" data-action="' + ($pagi + 3) + '" class="pagiVar2 btn page gradient">..</button>\n' +
                                '<button href="javascript:void(0)" " data-per="' + $index2 + '" data-action="' + $maxpage + '" class="pagiVar2 btn page gradient">' + $maxpage + '</button>\n';
                        }

                        else {
                            $dataafter = '';
                            $databefore = '';
                            for ($i = 1; $i <= 5; $i++) {
                                $databefore += '<button href="javascript:void(0)" data-per="' + $index2 + '" data-action="' + $i + '" class="pagi' + $i + ' btn page gradient">' + $i + '</button>\n';
                            }
                            $dataafter = $databefore +
                                '<button href="javascript:void(0)" " data-per="' + $index2 + '" data-action="' + 6 + '" class="pagiVar2 btn page gradient">..</button>\n' +
                                '<button href="javascript:void(0)" " data-per="' + $index2 + '" data-action="' + $maxpage + '" class="pagiVar2 btn page gradient">' + $maxpage + '</button>\n';
                        }

                    }


                    $('.box-footer').hide(500);
                    pengguna = 0;
                    if ($maxpage > 1) {
                        pengguna = 1;
                        $('.box-footer').show(500);
                        $('#pagination').hide(500);
                        $('#pagiuser').show(500);
                        $('#pagiuser').empty().append('<button href="javascript:void(0)" data-per="' + $index2 + '" data-action="' + (parseInt($pagi) - 1) + '"\n' +
                            '                                            class="pagiPrevious btn page gradient"><span\n' +
                            '                                                class="fa fa-caret-left"></span></button>\n' + $dataafter +
                            '<button href="javascript:void(0)" data-action="' + (parseInt($pagi) + 1) + '" data-per="' + $index2 + '" class="pagiNext btn page gradient"><span class="fa fa-caret-right"></span></button>');
                        // pagination
                    }
                    if ($pagi == $maxpage) {
                        $('#pagiuser .pagiNext').data('action', 1);
                    }
                    else {
                        $('#pagiuser .pagiNext').data('action', (parseInt($pagi) + 1));
                    }
                    if ($pagi == 1) {
                        $('#pagiuser .pagiPrevious').data('action', $maxpage);
                    }
                    else {
                        $('#pagiuser .pagiPrevious').data('action', (parseInt($pagi) - 1));
                    }

                    $pagi2 = $('#pagiuser .pagi' + $pagi);
                    $pagi2.removeClass('gradient').show(1500);
                    $pagi2.addClass('active').show(1500);
                    $pagi2.prop('disabled', true);
                    $pagi2.siblings().removeClass('active');
                    $pagi2.siblings().addClass('gradient');
                    $pagi2.siblings().prop('disabled', false);
                }
                $('#load2').fadeOut(1000);
                $('.content .row').css("opacity", 1).fadeIn(1000);


            },
            error: function () {
                errorNotif();
            }
        });

    }
</script>

{{--search--}}
<script>
    $('.cariBtn2').on('click', function () {
        searchsurat2();
    });

    function searchsurat2() {
        $('#cariuser' + $index2).hide();
        $('#loadinguser' + $index2).show();
        if (search[prefix2 + $index2] !== $('#inputuser' + $index2).val()){
            pagination2[prefix2 + $index2]=1;
        }
        search2[prefix2 + $index2] = $('#inputuser' + $index2).val();
        getData2($index2, pagination2[prefix2 + $index2]);
        $('#loadinguser' + $index2).hide(2000);
        $('#cariuser' + $index2).show(2000);
    }
</script>
{{--search--}}

{{--keyup--}}
<script>
    $(document).keyup(function (e) {
        if ($("#inputuser" + $index2 + ":focus") && (e.keyCode === 13)) {
            searchsurat2();
        }
    });
</script>

<script>
    function lockfilllihat() {
        $('#modal-form #name').prop('disabled', true);
        $('#modal-form #name').css('background-color', '#fcfdff');
        $('#modal-form #bio').prop('disabled', true);
        $('#modal-form #bio').css('background-color', '#fcfdff');
        $('#modal-form #nip').prop('disabled', true);
        $('#modal-form #nip').css('background-color', '#fcfdff');
        $('#modal-form #email').prop('disabled', true);
        $('#modal-form #email').css('background-color', '#fcfdff');
        $('#modal-form #phone').prop('disabled', true);
        $('#modal-form #phone').css('background-color', '#fcfdff');
        $('#modal-form #alamat').prop('disabled', true);
        $('#modal-form #alamat').css('background-color', '#fcfdff');
    }
    function lihatuser(asd) {
        $id = $(asd).data('id');
        $action = $(asd).data('action');
        $status = $(asd).data('status');
console.log($(asd).data('id'));
        $.ajax({
            url: "{{route('admin.table.pengguna.lihat')}}",
            type: "get",
            data: {'id': $id},
            success: function (data) {
                console.log(data);
                $job_id = '';
                $ps_id = '';
                $role_id = '';
                if ($action == 'lihat') {
                    $('#modal-form .hapususer').attr('onclick', 'hapususer(' + data.id + ')');
lockfilllihat();
                    // $('#modal-form2 #desc').prop('disabled', true);
                    // $('#modal-form2 #desc').css('background-color', '#fcfdff');
                    // $('#modal-form2 #user_id').prop('disabled', true);
                    // $('#modal-form2 #user_id').css('background-color', '#fcfdff');
                    $('#modal-form .lihatsurat').attr('data-id',data.id);  //disable class
                    $('#modal-form #job_id').addClass('disabled')  //disable class
                        .prop({disabled: true});
                    $('#modal-form #job_id').css('background-color', '#fcfdff');
                    $('#modal-form #posisition_id').css('background-color', '#fcfdff');
                    $('#modal-form #posisition_id').addClass('disabled')  //disable class
                        .prop({disabled: true});
                    $('#modal-form #role_id').css('background-color', '#fcfdff');
                    $('#modal-form #role_id').addClass('disabled')  //disable class
                        .prop({disabled: true});
                    // $('.lihatsurat').data('id', data.id);
                    $('#loading3').hide();
                    $('#modal-form .editform').hide();
                    $('#modal-form .lihatform').show();
                    $('#modal-form #notif1').empty();
                    //
                    // $('#modal-form2 .hapussurat').attr('onclick', 'hapussurat(' + data.id + ')');
                    // $('#berubah').show();
                }
                else {
                    lockfilllihat();
                    $('#loading3').hide();
                    $('.lihatform').hide();
                    $('.editform').show();
                    $('#modal-form #job_id').removeClass('disabled')  //disable class
                        .prop({disabled: false});
                    $('#modal-form #posisition_id').removeClass('disabled')  //disable class
                        .prop({disabled: false});
                    $('#modal-form #job_id').css('background-color', '#ffffff');
                    $('#modal-form #role_id').removeClass('disabled')  //disable class
                        .prop({disabled: false});
                    $('#modal-form #role_id').css('background-color', '#ffffff');
                    $('#modal-form #posisition_id').css('background-color', '#ffffff');
                    $('#modal-form #job_id').focus().select();
                    $('#modal-form #notif1').empty().append("ubah seksi, jobdesk, dan hak akses");


                }
                if (!$.trim(data.ava)) {
                    $('#ava').attr('src', '{!!URL::to('images/avatar.png')!!}');
                }
                else {
                    $('#ava').attr('src', '{!!URL::to('/')!!}' + '/' + data.ava);
                }
                $job_id += '  <option value="" disabled="true">Pilih Seksi</option>';
                $ps_id += '  <option value="" disabled="true">Pilih Jobdesk</option>';
                $role_id += '  <option value="" disabled="true">Pilih Hak Akses</option>';
                // for ($x = 0, $y = data.ids_job.length; $x < $y; $x++) {
                //     if (data.ids[$x] == data.select) {
                //         $job_id += '<option value="' + data.ids[$x] + '" selected>' + data.names[$x] + '</option>\n';
                //     }
                //     else {
                //         $job_id += '<option value="' + data.ids[$x] + '">' + data.names[$x] + '</option>\n';
                //     }
                // }
                for ($x = 0; $x < data.ids_job.length; $x++) {
                    if (data.ids_job[$x] == data.select) {
                        $job_id += '<option value="' + data.ids_job[$x] + '" selected>' + data.names_job[$x] + '</option>\n';
                    }
                    else {
                        $job_id += '<option value="' + data.ids_job[$x] + '">' + data.names_job[$x] + '</option>\n';
                    }
                }
                for ($x = 0; $x < data.pss.length; $x++) {
                    if (data.pss[$x]['id'] == data.ps_id) {
                        $ps_id += '<option value="' + data.pss[$x].id + '" selected>' + data.pss[$x].name + '</option>\n';
                    }
                    else {
                        $ps_id += '<option value="' + data.pss[$x].id + '">' + data.pss[$x].name + '</option>\n';
                    }
                }
                for ($x = 0; $x < data.roles.length; $x++) {
                    if (data.roles[$x]['id'] == data.role_id) {
                        $role_id += '<option value="' + data.roles[$x].id + '" selected>' + data.roles[$x].name + '</option>\n';
                    }
                    else {
                        $role_id += '<option value="' + data.roles[$x].id + '">' + data.roles[$x].name + '</option>\n';
                    }
                }

                $('#modal-form #id').val(data.id);
                $('#modal-form #name').val(data.name);
                $('#modal-form #nip').val(data.nip);
                $('#modal-form #alamat').val(data.alamat);
                $('#modal-form #phone').val(data.phone);
                $('#modal-form #email').val(data.email);
                $('#modal-form #bio').val(data.bio);
                // $('#modal-form2 #job_id').val(data.job_id);
                // $('#modal-form2 #desc').val(data.desc);
                // $('#modal-form2 #user_id').val(data.user);
                $('#modal-form #job_id').empty().append($job_id);
                $('#modal-form #posisition_id').empty().append($ps_id);
                $('#modal-form #role_id').empty().append($role_id);
                if ($status == 0) {
                    $('#modal-form').modal('show');
                }
            },
            error: function () {
                $('#load').hide();
                $('.content .row').css("opacity", 1);
                errorNotif();
            }
        });
    }
</script>

{{--focus--}}
<script>
    $("#modal-form2 #job_id").focus(function () {

        var length = $('#modal-form2 #job_id option').length;
        //open dropdown
        $(this).attr('size', length);

        // // to close
        // $(this).attr('size', 0);
    });
</script>
{{--focus--}}
{{--error notif--}}
<script>
    function errorNotif() {
        swal({
            title: 'Oops...',
            text: 'Something went wrong or data is empty!',
            type: 'error',
            timer: '1500'
        })
    }
</script>
{{--error notif--}}

{{--changeoption--}}
<script>
    $('#modal-form').html();
    $('#modal-form').on('change', '#job_id', function (asd) {
        $.ajax({
            type: 'get',
            url: '{{route('admin.table.user.getPosisition')}}',
            data: {'id': $(this).val()},
            success: function (data) {
                if (!$.trim(data[0])) {
                    $('#modal-form #posisition_id').empty().append('<option value="" selected>Data Belum Diisi</option>');
                }
                else {
                    $('#modal-form #posisition_id').html('');
                    $('#modal-form #posisition_id').append('<option value="" selected disabled>Pilih Jobdesk</option>');
                    $.each(data, function (no, value) {
                        $('#modal-form #posisition_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }

            },
            error: function () {
                errorNotif();
            }
        });

    });
</script>
<script>
    $('#modal-form4').html();
    $('#modal-form4').on('change', '.job_id', function (asd) {
        $key = $(this).data('no');
        $.ajax({
            type: 'get',
            url: '{{route('admin.table.user.getPosisition')}}',
            data: {'id': $(this).val()},
            success: function (data) {
                console.log(data);

                if (data.length > 0) {
                    $('#modal-form4 .filledit' + $key + ' .posisition_id').html('');
                    $('#modal-form4 .filledit' + $key + ' .posisition_id').append('<option value="" selected disabled>Pilih Jobdesk</option>');
                    $.each(data, function (no, value) {
                        $('#modal-form4 .filledit' + $key + ' .posisition_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                    });
                }
                else {
                    $('#modal-form4 .filledit' + $key + ' .posisition_id').html('');
                    $('#modal-form4 .filledit' + $key + ' .posisition_id').append('<option value="" selected disabled>Data Kosong</option>');
                }


            },
            error: function () {
                errorNotif();
            }
        });

    });
</script>
{{--changeoption--}}

{{--delete--}}
<script>
    function hapususer($id) {
        $('#load2').show();
        $('.content .row').css("opacity", 0.4);
        $.ajax({
            url: "{{route('admin.table.pengguna.cekhapus')}}",
            type: "get",
            data: {'id': $id},
            success: function (data) {

                if (data.length > 0) {
                    $notice = 'The user have ' + data.length + ' receipt data!';
                }
                else {
                    $notice = 'This data not be able to recover !!';
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
                            url: "{{route('admin.table.pengguna.hapus')}}",
                            type: "get",
                            data: {'id': $id},
                            success: function (data) {
                                selectuser = [];
                                $InputElement = $("#job" + $id).find(".ceksurat")
                                $InputElement.prop('checked', false);
                                $InputElement.parents('tr').css('background-color', '#ffffff');
                                getData2($index2, pagination2[prefix2 + $index2]);
                                // $(':button').prop('disabled', false);
                                // $('li').prop('disabled', false);
                                // $('a').prop('disabled', false);
                                swal({
                                    title: 'Success!',
                                    text: 'data has been deleted!',
                                    type: 'success',
                                    timer: '1500'
                                });
                                $('#load2').hide();
                            },
                            error: function () {

                                // $(':button[type="submit"]').prop('disabled', false);
                                errorNotif();
                            }
                        });

                    }
                    $('#load2').hide();
                    return false;
                });
                $('#load2').hide();
            },
            error: function () {
                $('#load2').hide(1000);
                $('.content .row').css("opacity", 1);
                errorNotif();
            }
        });
        $('#load').fadeOut(3000);
        $('.content .row').css("opacity", 1).fadeIn(3000);
    }
</script>
{{--delete--}}

{{--checkall--}}
<script>
    $('#user').on('change', '.checkall', function (asd) {
        selectuser = [];
        $id = $(this).data('id');
        var $InputElement = $("#job" + $id).find(".ceksurat");
        if ($(this).is(':checked')) {
            for ($x = 0, $y = $InputElement.length; $x < $y; $x++) {
                selectuser.push($($InputElement[$x]).data('id'));
            }
            $InputElement.prop('checked', true);
            $InputElement.parents('tr').css('background-color', '#c8cace');
        }
        else {
            selectuser = [];
            $InputElement.prop('checked', false);
            $InputElement.parents('tr').css('background-color', '#ffffff');
        }
        console.log(selectuser);
    });
</script>

{{--checkall--}}

{{--check some--}}
<script>
    $('#user').on('change', '.ceksurat', function (asd) {
        $id = $(this).data('id');
        if ($(this).is(':checked')) {
            selectuser.push($id);
            $(this).parents('tr').css('background-color', '#c8cace');
        }
        else {
            var delarray = selectuser.indexOf($id);
            selectuser.splice(delarray, 1);
            $(this).parents('tr').css('background-color', '#ffffff');
        }

        console.log(selectuser);
    });
</script>

{{--check some--}}

{{--edit--}}{{-- sing di garap--}}
<script>
    $('#modal-form form').on('submit', function (e) {
        $('#berubah1').hide();
        $('#loading3').show();
        $('button').prop('disabled', true);
        // $('#modal-form #name').prop('readonly', true);
        // $('#modal-form #name').css('background-color', '#fcfdff');
        // $('#modal-form #nip').prop('readonly', true);
        // $('#modal-form #nip').css('background-color', '#fcfdff');
        $('#modal-form #job_id').prop('readonly', true);
        $('#modal-form #job_id').css('background-color', '#fcfdff');
        $('#modal-form #posisition_id').prop('readonly', true);
        $('#modal-form #posisition_id').css('background-color', '#fcfdff');
        $('#modal-form #role_id').prop('readonly', true);
        $('#modal-form #role_id').css('background-color', '#fcfdff');
        // $('#modal-form #bio').prop('readonly', true);
        // $('#modal-form #bio').css('background-color', '#fcfdff');
        // $('#modal-form #email').prop('readonly', true);
        // $('#modal-form #email').css('background-color', '#fcfdff');
        // $('#modal-form #phone').prop('readonly', true);
        // $('#modal-form #phone').css('background-color', '#fcfdff');
        // $('#modal-form #alamat').prop('readonly', true);
        // $('#modal-form #alamat').css('background-color', '#fcfdff');
        // $('#modal-form form').append('<input type="hidden" value="' + $('#modal-form2 #job_id').val() + '" name="job_id"/>');
        $.ajax({
            url: "{{route('admin.table.pengguna.edit')}}",
            type: "post",
            data: new FormData($('#modal-form form')[0]),
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                $('#modal-form #job_id').prop('readonly', false);
                $('#modal-form #job_id').css('background-color', '#ffffff');
                $('#modal-form #posisition_id').prop('readonly', false);
                $('#modal-form #posisition_id').css('background-color', '#ffffff');
                $('#modal-form #role_id').prop('readonly', false);
                $('#modal-form #role_id').css('background-color', '#ffffff');
                getData2($index2, pagination2[prefix2 + $index2]);
                // activeform2();
                $('button').prop('disabled', false);
                $('#modal-form').modal('hide');
                swal({
                    title: 'Berhasil!',
                    text: 'Data Jenis Surat Dibuat...',
                    type: 'success',
                    timer: '1500'
                });

            },
            error: function () {
                $('#modal-form #job_id').prop('readonly', false);
                $('#modal-form #job_id').css('background-color', '#ffffff');
                $('#modal-form #posisition_id').prop('readonly', false);
                $('#modal-form #posisition_id').css('background-color', '#ffffff');
                errorNotif();

            }
        });

        return false;
    });
</script>
{{--edit--}}

{{--multi function--}}
{{--delete--}}
<script>
    function multidelete2(id) {
        if (selectuser.length > 0) {
            hapususer(selectuser);
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
{{--edit--}}
<script>
    function multiedit2(id) {

        if (selectuser.length > 0) {
            $('#load2').show();
            $('.content .row').css("opacity", 0.4);
            // declareEdit();

            $.ajax({
                url: "{{route('admin.table.pengguna.lihat')}}",
                type: "get",
                data: {'id': selectuser},
                success: function (data) {
                    console.log(data);
                    $labelmulti = $('#modal-form4 form').find('.loopmulti').clone().get(0).innerHTML;
                    $('#modal-form4 form #fill').empty();
                    $.each(data, function (key, value) {
                        $('#modal-form4 form #fill').append('<div class="row container-fluid loopmulti">' + $labelmulti + '</div>');
                        $changearray = $('#modal-form4 form').find('.loopmulti').get(key);
                        $($changearray).addClass('filledit' + key);
                        $('#modal-form4 form .filledit' + key + ' .name').val(value.name);
                        $('#modal-form4 form .filledit' + key + ' .name').prop('disabled', true);
                        $('#modal-form4 form .filledit' + key + ' .name').css('background-color', '#fcfdff');
                        $('#modal-form4 form .filledit' + key + ' .id').val(value.id);
                        // $('#modal-form3 form .filledit' + key + ' .singkatan').val(value.singkatan);
                        // $('#modal-form3 form .filledit' + key + ' .desc').val(value.desc);
                        // $('#modal-form3 form .filledit' + key + ' .id').val(value.id);
                        $job_id = ' ';
                        $job_id += '<option value="" disabled="true">Pilih Seksi</option>';
                        $posisition = ' ';
                        $posisition += '<option value="" disabled="true">Pilih Jobdesk</option>';

                        for ($x = 0, $y = value.ids_job.length; $x < $y; $x++) {
                            if (value.ids_job[$x] == value.select) {
                                $job_id += '<option value="' + value.ids_job[$x] + '" selected>' + value.names_job[$x] + '</option>\n';
                            }
                            else {
                                $job_id += '<option value="' + value.ids_job[$x] + '">' + value.names_job[$x] + '</option>\n';
                            }
                        }
                        for ($x = 0, $y = value.pss.length; $x < $y; $x++) {
                            if (value.pss[$x].id == value.ps_id) {
                                $posisition += '<option value="' + value.pss[$x].id + '" selected>' + value.pss[$x].name + '</option>\n';
                            }
                            else {
                                $posisition += '<option value="' + value.pss[$x].id + '">' + value.pss[$x].name + '</option>\n';
                            }
                        }
                        $role_id = ' ';
                        $role_id += '<option value="" disabled="true">Pilih Hak Akses</option>';
                        for ($x = 0, $y = value.roles.length; $x < $y; $x++) {
                            if (value.roles[$x].id == value.role_id) {
                                $role_id += '<option value="' + value.roles[$x].id + '" selected>' + value.roles[$x].name + '</option>\n';
                            }
                            else {
                                $role_id += '<option value="' + value.roles[$x].id + '">' + value.roles[$x].name + '</option>\n';
                            }
                        }
                        $('#modal-form4 form .filledit' + key + ' .job_id').empty().append($job_id);
                        $('#modal-form4 form .filledit' + key + ' .job_id').attr('data-no', key);
                        $('#modal-form4 form .filledit' + key + ' .posisition_id').empty().append($posisition);
                        $('#modal-form4 form .filledit' + key + ' .role_id').empty().append($role_id);
                    });

                    $('#load2').hide();
                    $('.content .row').css("opacity", 1);
                    $('#modal-form4').modal('show');
                    $('#modal-form4 .modal-title').text('Multi Edit Data Pegawai');
                },
                error: function () {
                    $('#load2').hide();
                    $('.content .row').css("opacity", 1);
                    errorNotif();
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
{{--edit--}}

{{--submit multiedit--}}
<script>
    $('#modal-form4 form').on('submit', function (e) {
        $('#berubah3').hide();
        $('#loading4').show();
        $('button').prop('disabled', true);
        $('#modal-form4 .job_id option:not(:selected)').attr('disabled', 'disabled');
        $('#modal-form4 .job_id').css('background-color', '#fcfdff');
        $('#modal-form4 .posisition_id option:not(:selected)').attr('disabled', 'disabled');
        $('#modal-form4 .posisition_id').css('background-color', '#fcfdff');
        $('#modal-form4 .role_id option:not(:selected)').attr('disabled', 'disabled');
        $('#modal-form4 .role_id').css('background-color', '#fcfdff');
        console.log($('#modal-form4 form')[0]);
        $.ajax({
            url: "{{route('admin.table.pengguna.edit')}}",
            type: "post",
            data: new FormData($('#modal-form4 form')[0]),
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                $('#modal-form4 .job_id option:not(:selected)').attr('disabled', false);
                $('#modal-form #job_id').css('background-color', '#ffffff');
                $('#modal-form4 .posisition_id option:not(:selected)').attr('disabled', false);
                $('#modal-form #posisition_id').css('background-color', '#ffffff');
                $('#modal-form4 .role_id option:not(:selected)').attr('disabled', false);
                $('#modal-form #role_id').css('background-color', '#ffffff');
                getData2($index2, pagination2[prefix2 + $index2]);
                // activeform2();
                $('button').prop('disabled', false);
                $('#modal-form4').modal('hide');
                swal({
                    title: 'Berhasil!',
                    text: 'Data Jenis Surat Dibuat...',
                    type: 'success',
                    timer: '1500'
                });

            },
            error: function () {
                $('#modal-form #job_id').prop('readonly', false);
                $('#modal-form #job_id').css('background-color', '#ffffff');
                $('#modal-form #posisition_id').prop('readonly', false);
                $('#modal-form #posisition_id').css('background-color', '#ffffff');
                errorNotif();

            }
        });


        return false;
    });
</script>
{{--submit multiedit--}}
{{--multi function--}}

{{--notice edit keyup pr--}}

{{--send email--}}
<script>

    $('#data2 form').on('submit', function (e) {
        if (navigator.onLine) {
            $('#data2 form :input').prop('readonly', true);
            $('#data2 form .email').prop('readonly', true);
            $('#data2 .seksi').addClass('disabled');
            $('#data2 .seksi option:not(:selected)').attr('disabled', 'disabled');
            $('#data2 .opsi').addClass('disabled');
            $('#data2 .opsi option:not(:selected)').attr('disabled', 'disabled');
            $(':input[type="submit"]').prop('disabled', true);
            $('#data2 form #berubah').hide();
            $('#data2 form #loading1').show();
            $('#data2 form #progresssurat').show();
            $x = 0;
            $('#data2 form #progresssurat').empty().append($x + '/' + countSend + ' Proses Kirim (Jangan Tutup/Refresh Halaman)');
                    {{Session::put('proSend',0)}}
            for ($x = 0; $x < countSend; $x++) {
                send($x, countSend);
            }
        } else {
            swal({
                title: 'Cek Koneksi',
                text: 'Internet dibutuhkan untuk kirim email!',
                type: 'error',
                timer: '1500'
            })
        }
        return false;
    });

    function send($x, entit) {
        $.ajax({
            url: "{{route('admin.table.pengguna.storesuratplus')}}",
            // async: false,
            type: "post",
            data: new FormData($('#data2 form')[0]),
            contentType: false,
            processData: false,
            success: function (data) {
                console.log(data);
                $x = 1 + $x;
                $('#data2 form #progresssurat').empty().append($x + '/' + countSend + ' Proses Kirim (Jangan Tutup/Refresh Halaman)');
                if (data == 1) {
                    swal({
                        title: 'Berhasil!',
                        text: 'user ' + $x + ' telah dibuat',
                        type: 'success',
                        timer: '1500'
                    });
                }
                else {
                    swal({
                        title: 'Galat!',
                        text: 'user ' + $x + ' gagal mengirim Email',
                        type: 'info',
                        timer: '1500'
                    });
                }
                if (entit == $x) {
                    doneSend();
                    // location.reload();
                }
                return $x;
            },
            error: function () {
                doneSend();
                errorNotif();
            }
        });

    }

    function doneSend() {

        // $('#data2 form')[0].reset();
        $('#data2 form #entitySend').val(countSend);
        console.log(data);
        $('#data2 form .email').prop('readonly', false);
        $('#data2 form #berubah').show();
        $('#data2 form #loading1').hide();
        $('#data2 form #progresssurat').hide();
        $('#data2 form :input').prop('readonly', false);
        $('#data2 .seksi option:not(:selected)').attr('disabled', false);
        $('#data2 .seksi').removeClass('disabled');
        $('#data2 .opsi option:not(:selected)').attr('disabled', false);
        $('#data2 .opsi').removeClass('disabled');
        $(':input[type="submit"]').prop('disabled', false);

    }
</script>
{{--send email--}}

{{--cek email nip--}}
<script>
    $('#data2').on('input', '.nip', function (asd) {
        var NIP = [];
        $statusnip = 0;
        $call = $('#data2 .nip');
        label = $(this).val();
        $target = $(this);
        $call.each(function () {
            NIP.push(this.value);
        });
        cut = $(this).data('no');
        NIP.splice(cut, 1);
        console.log(NIP);
        console.log('anu ' + cut);
        $.each(NIP, function (index, value) {
            if (label == value && label !== '') {
                $statusnip = 1;
            }
            console.log(label + ' ddd ' + value + ' (das');
        });

        $(this).addClass('loadinglah');
        $.ajax({
            url: "{{route('admin.table.pengguna.ceknip')}}",
            type: "get",
            data: {'cek': label, 'mode': 1},
            success: function (data) {
                console.log(data);
                if (data == 0 || $statusnip == 1) {
                    $('#data2 form :input').prop('readonly', true);
                    $('#data2 form .email').prop('readonly', true);
                    $('#data2 .seksi').addClass('disabled');
                    $('#data2 .seksi option:not(:selected)').attr('disabled', 'disabled');
                    $('#data2 .opsi').addClass('disabled');
                    $('#data2 .opsi option:not(:selected)').attr('disabled', 'disabled');
                    $('#data2 :input[type="submit"]').prop('disabled', true);
                    swal({
                        title: 'notice',
                        text: 'NIP telah dipakai!',
                        type: 'info',
                        timer: '1500'
                    })
                    $('#data2 form #berubah').empty().append('NIP telah dipakai!');
                    // $( '#jadi-data form input:not(.'+urutancek+')' ).prop('readonly', true);
                    // $( '#jadi-data form .text1' ).prop('readonly', true);
                    // $('#bantu').empty().append(isicek1 + isicek2);
                    // $(':input[type="submit"]').prop('disabled', true);
                    // $(':input[type="submit"]').prop('title', 'data sudah ada');
                    // $('#bantu').show();
                    $target.prop('readonly', false);
                }
                else {
                    noticecek();

                }
                $target.removeClass('loadinglah');
            },
            error: function () {
                noticecek();
                $target.removeClass('loadinglah');
                swal({
                    title: 'Oops...',
                    text: 'Something went wrong!',
                    type: 'error',
                    timer: '1500'
                })
            }
        });

    });

    $('#data2').on('input', '.email', function (asd) {
        console.log($(this).val());
        label = $(this).val();
        $target = $(this);

        var EMAIL = [];
        $statusemail = 0;
        $call = $('#data2 .email');
        label = $(this).val();
        $target = $(this);
        $call.each(function () {
            EMAIL.push(this.value);
        });
        cut = $target.data('no');
        EMAIL.splice(cut, 1);
        console.log(EMAIL);
        console.log('anu ' + cut);
        $.each(EMAIL, function (index, value) {
            if (label == value && label !== '') {
                $statusemail = 1;
            }
            console.log(label + ' ddd ' + value + ' (das');
        });


        $target.addClass('loadinglah');
        $.ajax({
            url: "{{route('admin.table.pengguna.ceknip')}}",
            type: "get",
            data: {'cek': label, 'mode': 0},
            success: function (data) {
                console.log(data);
                if (data == 0 || $statusemail == 1) {
                    $('#data2 form :input').prop('readonly', true);
                    $('#data2 form .email').prop('readonly', true);
                    $('#data2 .seksi').addClass('disabled');
                    $('#data2 .seksi option:not(:selected)').attr('disabled', 'disabled');
                    $('#data2 .opsi').addClass('disabled');
                    $('#data2 .opsi option:not(:selected)').attr('disabled', 'disabled');
                    $('#data2 :input[type="submit"]').prop('disabled', true);
                    swal({
                        title: 'notice',
                        text: 'email telah dipakai!',
                        type: 'info',
                        timer: '1500'
                    })
                    $('#data2 form #berubah').empty().append('email telah dipakai!');
                    // $( '#jadi-data form input:not(.'+urutancek+')' ).prop('readonly', true);
                    // $( '#jadi-data form .text1' ).prop('readonly', true);
                    // $('#bantu').empty().append(isicek1 + isicek2);
                    // $(':input[type="submit"]').prop('disabled', true);
                    // $(':input[type="submit"]').prop('title', 'data sudah ada');
                    // $('#bantu').show();
                    $target.prop('readonly', false);
                }
                else {
                    noticecek();

                }
                $target.removeClass('loadinglah');
            },
            error: function () {
                noticecek();
                $target.removeClass('loadinglah');
                errorNotif();
            }
        });

    });

    function noticecek() {
        $('#data2 form :input').prop('readonly', false);
        $('#data2 form .email').prop('readonly', false);
        $('#data2 .seksi').removeClass('disabled');
        $('#data2 .seksi option:not(:selected)').attr('disabled', false);
        $('#data2 .opsi').removeClass('disabled');
        $('#data2 .opsi option:not(:selected)').attr('disabled', false);
        $('#data2 :input[type="submit"]').prop('disabled', false);
        $('#data2 form #berubah').empty().append('Submit');
    }
</script>
{{--cek email--}}

{{--lock number--}}
<script>
    function numbertok(evt) {
        var theEvent = evt || window.event;
        var key = theEvent.keyCode || theEvent.which;
        key = String.fromCharCode(key);
        var regex = /[0-9]|\./;
        if (!regex.test(key)) {
            theEvent.returnValue = false;
            swal({
                title: 'Oops...',
                text: 'input dengan angka',
                type: 'info',
                timer: '1500'
            })
            if (theEvent.preventDefault) theEvent.preventDefault();
        }
    }

</script>
{{--lock number--}}

{{--resend email--}}
<script>
    function resendEmail($id) {
        $('#load2').show();
        $('.content .row').css("opacity", 0.4);
        $(':button').prop('disabled', true);
        $('li').prop('disabled', true);
        if (navigator.onLine) {
        if ($id == 'na') {
            entresend=selectuser.length;
            if (entresend > 0) {
                swallProses(0,entresend,'Jangan Tutup/Refresh Halaman');
                {{Session::put('proSend',0)}}
                $.each(selectuser, function (anu, value) {
                    resendMulti(value,entresend,anu);
                })
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
        else {
            $.ajax({
                url: "{{route('admin.table.pengguna.resend')}}",
                type: "get",
                data: {'id': $id},
                success: function (data) {
                    $(':button').prop('disabled', false);
                    $('li').prop('disabled', false);
                    console.log(data);
                    $('#load2').hide();
                    $('.content .row').css("opacity", 1).fadeIn();
                    if (data == 1) {
                        swal({
                            title: 'Berhasil!',
                            text: 'Email Telah terkirim!',
                            type: 'success',
                            timer: '1500'
                        })
                    }
                    else {
                        swal({
                            title: 'Galat!',
                            text: 'Email Gagal dikirim!',
                            type: 'info',
                            timer: '1500'
                        })
                    }
                },
                error: function () {
                    $(':button').prop('disabled', false);
                    $('li').prop('disabled', false);
                    $('#load2').hide(1000);
                    $('.content .row').css("opacity", 1);
                    errorNotif();
                }
            });
        }}
        else {
            swal({
                title: 'Cek Koneksi',
                text: 'Internet dibutuhkan untuk kirim email!',
                type: 'error',
                timer: '1500'
            })
        }

    }

    function resendMulti($id,entity,anu) {
        $.ajax({
            url: "{{route('admin.table.pengguna.resend')}}",
            type: "get",
            data: {'id': $id,'entitySend':entity},
            success: function (data) {
                $('#load2').hide();
                $('.content .row').css("opacity", 1);
                $(':button').prop('disabled', false);
                $('li').prop('disabled', false);
                console.log(data);
                $('#load').fadeOut(300);
                $('.content .row').css("opacity", 1).fadeIn(300);

                if (data.send==0) {
                    $('#swal2-content').empty().append((parseInt(anu) + 1) + '/' + entity + ' Kirim Email (Gagal)');
                }if (data.send==1) {
                    $('#swal2-content').empty().append((parseInt(anu) + 1) + '/' + entity + ' Kirim Email (Berhasil)');
                }
                if(data.status==1) {
                    setTimeout(
                        function()
                        {
                            //do something special
                            swal.close();
                        }, 2000);

                }

                // if (data == 1) {
                //     swal({
                //         title: 'Berhasil!',
                //         text: 'Email Telah terkirim!',
                //         type: 'success',
                //         timer: '1500'
                //     })
                // }
                // else {
                //     swal({
                //         title: 'Galat!',
                //         text: 'Email Gagal dikirim!',
                //         type: 'info',
                //         timer: '1500'
                //     })
                // }
            },
            error: function () {
                $('#load2').hide();
                $('.content .row').css("opacity", 1);
                $(':button').prop('disabled', false);
                $('li').prop('disabled', false);
                errorNotif();
            }
        });

    }
    function swallProses(awal,akhir) {

        swal({
            title: 'Proses...',
            text: awal+'/'+akhir + ' Kirim Email (Jangan Tutup/Refresh Halaman)',
            imageUrl: "{!!URL::to('images/loadingstyle/loadingimg.gif')!!}",
            imageWidth: 200,
            imageHeight: 200,
            customClass: 'swal-wide',
            allowOutsideClick: false,
            showCancelButton: false, // There won't be any cancel button
            showConfirmButton: false
        });
    }
</script>
{{--resend email--}}