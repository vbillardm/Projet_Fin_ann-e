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
            <li><a href="{{ route('profile', ['name' => $user->name]) }}">Profil</a></li>
            <li>{{ link_to_route('room', 'Rejoindre un salon') }}</li>
            <li class="active">{{ link_to_route('join-private', 'Nouveau salon') }}</li>
            <li>{{ link_to_route('rank', 'Classement') }}</li>
        </ul>
    </nav>
</div>
<div class="notif">Voté !</div>
<div class="content">
    <div class="content__infos">
        <ul>
            <li class="content__infos--pseudo">{{ $user->name }}</li>
            <li class="content__infos--pts">{{ $user->score->xp }}<span> pts </span></li>
            <li class="content__infos--niv"><span>Niv :</span> {{ $user->score->lvl_total }}</li>
        </ul>
    </div>
    <div class="content__title">
        <h1>| Rejoindre un salon privé</h1>
        <div class="content__title--intro">
            <p>Pour rejoindre le salon d’un ami, entrez simplement le code de page que vous avez reçu.</p>
        </div>
        <div class="content__title--explain">
            <p>
                Ce code est composé de 6 lettres ou chiffres, entrez le ci-dessous :
            </p>
        </div>
    </div>
    <div class="content__code">
        <input type="text" placeholder="Votre code" >
    </div>
    <div class="content__join">
        <button type="button"><a href="">Annuler</a></button>
        <button type="button" class="right"><a href="recherche.html">Jouer</a></button>
    </div>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="js/index.js"></script>
</body>

</html>