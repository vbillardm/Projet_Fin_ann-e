<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>

<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
        {{ Auth::user()->name }} <span class="caret"></span>
    </a>

    <ul class="dropdown-menu" role="menu">
        <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
    </ul>
</li>

{!! Form::open(array('url' => 'room/private/'.$private->slug , 'method' => 'POST')) !!}
{{ csrf_field() }}

choix 1  {!! Form::text('choix1') !!}
choix 2  {!! Form::text('choix2') !!}

{!! Form::submit('Click Me!') !!}

{!! Form::close() !!}

</body>
</html>