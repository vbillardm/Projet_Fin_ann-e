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
            <li class="active">{{ link_to_route('form-private', 'Nouveau salon') }}</li>
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
        <h1>| Room privé</h1>
        <div class="content__title--intro">
            <p>Créer et gérer votre room.</p>
        </div>
        <div class="content__title--explain">
            <p>
                Entrer le nom de votre salon.
            </p>
        </div>
    </div>
    <form class="content__code" action="/room/private/create" method="post">
        <input type="text" placeholder="Nom de room" name="name">
        <input type="submit" style="display:none" class="submit-form">
    </form>
    <div class="content__create">
        <a href="" class="create"><button type="button"><img src="/css/img/create.png" alt="">Créer</button></a>
    </div>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="/js/index.js"></script>
<script>
    document.querySelector('.create').addEventListener('click', function(e) {
        e.preventDefault();

        document.querySelector('.submit-form').click();
    });
</script>
</body>

</html>
