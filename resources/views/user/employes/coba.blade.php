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
<form action="{{route('coba')}}" method="post" enctype="multipart/form-data">
    {{ csrf_field() }} {{ method_field('post') }}

    <input type="checkbox" name="data[]" multiple value="a">data
    <input type="checkbox" name="data[]" multiple value="b">data2
    <input type="submit">submit
</form>
</body>
</html>