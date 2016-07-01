<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Inscription | Sandsound</title>
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
                        <li>{{ link_to('profile', 'Profil') }}</li>
                        <li>{{ link_to('room', 'Rejoindre un salon') }}</li>
                        <li>{{ link_to('form.private', 'Nouveau salon') }}</li>
                        <li>{{ link_to('rank', 'Classement') }}</li>
                    @endif
                </ul>
            </nav>
        </div>
        <div class="content">
            <div class="content__infos">
                @if (Auth::check())
                    <ul>
                        <li class="content__infos--pseudo">{{ $user->name }}</li>
                        <li class="content__infos--pts">{{ $user->score->xp }}<span> pts </span></li>
                        <li class="content__infos--niv"><span>Niv :</span> {{ $user->score->lvl_total }}</li>
                    </ul>
                @endif
            </div>
            <div class="login">
                <form action="/register" method="post">
                    {!! csrf_field() !!}
                    <input type="text" placeholder="Username" class="login__user" name="name">
                    <input type="email" placeholder="Email" class="login__user" name="email">
                    <input type="password" placeholder="Mot de passe" class="login__password" name="password">
                    <input type="password" placeholder="Retappez mot de passe" class="login__password" name="password_confirmation">
                    <input type="submit" value="Inscription" class="login__btn">
                    {{ link_to('login', 'Connexion', ['class' => 'underline']) }}
                </form>
            </div>
        </div>

        <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
        <script src="/js/index.js"></script>
    </body>
</html>
