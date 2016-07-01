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
            <li class="active">{{ link_to_route('room', 'Rejoindre un salon') }}</li>
            <li>{{ link_to_route('form-private', 'Nouveau salon') }}</li>
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
        <h1>| Rejoindre un salon</h1>
        <div class="content__title--intro">
            <p>Choisissez votre premier choix sur deux. </p>
        </div>
        <div class="content__title--explain">
            <p>
                Vous avez le choix entre drums, bass, ambiance et lead, chacun de ces rôles est important et l’un ne peut aller sans l’autre. Choississez selon votre préférence !
            </p>
        </div>
    </div>
    <div class="content__selection">
        <div class="content__selection--role">
            <ul>
                <a href="" class="categories">
                    <li>
                        <p>DRUM</p>
                    </li>
                </a>
                <a href="" class="categories">
                    <li>
                        <p>BASS</p>
                    </li>
                </a>
                <a href="" class="categories">
                    <li>
                        <p>AMBIANCE</p>
                    </li>
                </a>
                <a href="" class="categories">
                    <li>
                        <p>LEAD</p>
                    </li>
                </a>
            </ul>
        </div>
        <div class="content__selection--action">
            <a href="/home"> <button type="button"><img src="/css/img/multiply.png" alt=""> Annuler</button></a>
            <a href="/room/public/select" class="find-room"><button type="button" class="right"><img src="/css/img/success.png" alt=""> Jouer</button></a>
        </div>
    </div>
</div>
<script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
<script src="/js/index.js"></script>
<script>
    var choices = ['', ''];
    var as = document.querySelectorAll('.categories');
    var link = document.querySelector('.find-room');
    var baseLink = link.href + '?';

    for (var i = 0; i < as.length; i++) {
        as[i].addEventListener('click', function(e) {
            e.preventDefault();
        });

        as[i].childNodes[1].addEventListener('click', function(e) {
            var element = e.currentTarget;
            var isActive = element.classList.contains('active');
            var index;

            if (isActive) {
                index = choices.indexOf(element.childNodes[1].innerText.toLowerCase());

                if (index == -1) return;

                choices[index] = '';
                element.classList.remove('active');
            } else {
                index = choices.indexOf('');

                if (index == -1) return;

                choices[index] = element.childNodes[1].innerText.toLowerCase();
                element.classList.add('active');
            }

            link.href = baseLink;

            for (var i = 0; i < choices.length; i++) {
                if (choices[i] == '') continue;

                link.href += 'choix' + (i + 1) + '=' + choices[i] + '&';
            }

            link.href = link.href.substr(0, (link.href.length - 1));

            console.log(link.href);
        });
    }
</script>
</body>
</html>
