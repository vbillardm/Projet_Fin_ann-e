@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Dashboard</div>

                <div class="panel-body">
                    You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>
<a href="/room">join a public room</a></br>
<a href="/room/private/join">join a private room</a></br>
<a href="/room/private/create">create a private room</a></br>
<a href="/rank">Ranking list boloss</a>
@endsection
