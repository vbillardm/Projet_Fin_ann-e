<!doctype html>
<html lang=fr>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

    {!! Form::open(array('url' => 'room/private/select', 'method' => 'POST')) !!}
    {{ csrf_field() }}

    slug de la room :{!! Form::text('slug') !!}

    {!! Form::submit('Click Me!') !!}

    {!! Form::close() !!}

</body>
</html>