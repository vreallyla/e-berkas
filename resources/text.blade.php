<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<div class="row form-group">
    <div class="col-md-12">
        <select class="form-control category_id" name="jumlah"
                id="entity"
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
<div id="loop">
    <div class="row form-group has-feedback">
        <div class="col-md-12">
            <input placeholder="Type Name"
                   data-tabe="name1"
                   class="form-control name1"
                   id="name[]"
                   name="name[]" required autofocus>

        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        $(document).on('change', '#entity', function () {
            var fill1 = '';
            var valu = $(this).val();

            fill1 = '';
            for (var i = 1; i <= valu; i++) {

                fill1 += '<div class="row form-group has-feedback">\n' +
                    '        <div class="col-md-12">\n' +
                    '            <input placeholder="Type Name"\n' +
                    '                   data-tabe="name' + i + '"\n' +
                    '                   class="form-control name' + i + '"\n' +
                    '                   id="name[]"\n' +
                    '                   name="name[]" required autofocus>\n' +
                    '\n' +
                    '        </div>';

            }
            $('#loop').empty().append(fill1);

        });

        $('#loop').html();
        $('#loop .name2').on('input', function (e) {
            console.log(asd.delegateTarget.dataset.tabe);
            console.log(asd.delegateTarget.value);

        });

    });
</script>
<a href="javascript:void(0)" onclick="showForm()">
    <div class="col-md-3" style="padding: 0.3cm">
        <img src="" class="img-circle"
             alt="User Image" style="-webkit-filter: grayscale(100%); filter: grayscale(100%); width: 70%">
        <a class="users-list-name" href="#"><em style="font-size: 18px">
            </em></a>
        <span class="users-list-date" style="font-size: 13px">Belum diposisikan</span>
    </div></a>

</body>

</html>
