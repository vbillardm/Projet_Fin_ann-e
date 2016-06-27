<!doctype html>
<html lang=fr>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<p>olllllla</p>
{!! Form::open(array('url' => 'room/private', 'method' => 'POST')) !!}
{{ csrf_field() }}

name de la room :{!! Form::text('name') !!}

{!! Form::submit('Click Me!') !!}

{!! Form::close() !!}


</body>
</html>