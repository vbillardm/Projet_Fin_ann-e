<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Sandsound</title>
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
            <li class="active"><a href="{{ route('profile', ['name' => $user->name]) }}">Profil</a></li>
            <li>{{ link_to_route('room', 'Rejoindre un salon') }}</li>
            <li>{{ link_to_route('form-private', 'Nouveau salon') }}</li>
            <li>{{ link_to_route('rank', 'Classement') }}</li>
        </ul>
    </nav>
</div>

<div class="content">
    <div class="content__infos">
        <ul>
            <li class="content__infos--pseudo">{{ $user->name }}</li>
            <li class="content__infos--pts">{{ $user->score->xp }}<span> pts </span></li>
            <li class="content__infos--niv"><span>Niv :</span> {{ $user->score->lvl_total }}</li>
        </ul>
    </div>
    <div class="content__title">
        <h1>|   {{ $user->name }}</h1>
        <div class="content__title--intro">
            <p>{{ $user->name }} est niveau <span>{{ $user->score->lvl_total }}</span>.</p>
        </div>
        <div class="content__title--explain">
            <p>
                Découvrez les dernières musiques de <span>{{ $user->name }}</span>.

            </p>
        </div>
        <div class="content__experiencepre">
            <ul>
                <li class="content__experiencepre--bass">| Bass :  <span>{{ $user->score->lvl_bass }}</span></li>
                <li class="content__experiencepre--pads">| Ambiance :  <span>{{ $user->score->lvl_ambiance }}</span></li>
                <li class="content__experiencepre--drum">| Drum :  <span>{{ $user->score->lvl_drum }}</span></li>
                <li class="content__experiencepre--lead">| Lead :  <span>{{ $user->score->lvl_lead }}</span></li>
            </ul>
        </div>
        <div class="content__experience">
            <ul>
                <li class="content__experience--bass"></li>
                <li class="content__experience--pads"></li>
                <li class="content__experience--drum"></li>
                <li class="content__experience--lead"></li>
            </ul>
        </div>
        @if (count($songs))
            <div class="content__title--score">
                <table>
                    <thead>
                    <tr>
                        <th scope="col">Nom de la chanson :</th>
                        <th scope="col">Score :</th>
                    </tr>
                    <tbody>
                    @foreach ($songs as $song)
                        <tr>
                            <td>
                                {{ $song->name }}</td>
                            <td>{{ $song->score }}</td>
                        </tr>
                    @endforeach

                    </tbody>
                </table>
            </div>
        @endif
    </div>
    <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
    <script src="/js/index.js"></script>
</body>

</html>

