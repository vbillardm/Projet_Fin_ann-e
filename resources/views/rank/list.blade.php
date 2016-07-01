<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Ranking | Sandsound</title>
    <link rel="stylesheet" href="/css/reset.css">
    <link rel="stylesheet" href="/css/style.css">

</head>

<body>

<canvas id="canvas" class="background"></canvas>

<!-- Ne s'affiche que si sur mobile :) -->
<div class="mobile">
    <a href="/"><img class="logo" src="/css/img/logo.png" alt="SandSound"></a>
    <p>Pour profiter de l'expérience SandSound, rendez-vous sur une tablette ou desktop !</p>
</div>


<div class="sidebar">
    <a href="/"><img class="logo" src="/css/img/logo.png" alt="SandSound"></a>

    <nav>
        <ul>
            @if (Auth::check())
                <li><a href="{{ route('profile', ['name' => $user->name]) }}">Profil</a></li>
                <li>{{ link_to_route('room', 'Rejoindre un salon') }}</li>
                <li>{{ link_to_route('join-private', 'Nouveau salon') }}</li>
                <li class="active">{{ link_to_route('rank', 'Classement') }}</li>
            @endif
        </ul>
    </nav>
</div>
<div class="notif">Voté !</div>
<div class="content">
    <div class="content__infos">
        <ul>
            @if (Auth::check())
                <li class="content__infos--pseudo">{{ $user->name }}</li>
                <li class="content__infos--pts">{{ $user->score->xp }}<span> pts </span></li>
                <li class="content__infos--niv"><span>Niv :</span> {{ $user->score->lvl_total }}</li>
            @endif
        </ul>
    </div>
    <div class="content__title">
        <h1>| Classement</h1>
        <div class="content__title--intro">
            <p>Les meilleurs musiques du mois de Juin !</p>
        </div>
        <div class="content__title--explain">
            <p>
                Cliquez sur une musique pour l’écouter

            </p>
        </div>
        <div class="content__title--score">
            <table>
                <thead>
                <tr>
                    <th scope="col">Nom de la chanson :</th>
                    <th scope="col">Score :</th>
                </tr>
                <tbody>
                <tr>
                    @foreach ($songs as $song)
                        <td>
                            {{ $song->name }}
                        </td>
                        <td><button class="up">/\</button> <button class="down">\/</button></td>
                    @endforeach
                </tr>

                </tbody>
            </table>
        </div>
    </div>
    <script src='/js/jquery-3.0.0.min.js'></script>
    <script src="/js/index.js"></script>
</body>

</html>