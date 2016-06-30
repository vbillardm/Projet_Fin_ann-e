<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Sandsound</title>
    <link rel="stylesheet" href="/css/reset./css">
    <link rel="stylesheet" href="/css/style./css">

</head>

<body>

<canvas id="canvas" class="background"></canvas>

<!-- Ne s'affiche que si sur mobile :) -->
<div class="mobile">
    <a href="index.html"><img class="logo" src="/css/img/logo.png" alt="SandSound"></a>
    <p>Pour profiter de l'expérience SandSound, rendez-vous sur une tablette ou desktop !</p>
</div>


<div class="sidebar">
    <a href="index.html"><img class="logo" src="/css/img/logo.png" alt="SandSound"></a>

    <nav>
        <ul>
            <li><a href="{{ route('profile', ['name' => $user->name]) }}">Profil</a></li>
            <li>{{ link_to_route('room', 'Rejoindre un salon') }}</li>
            <li>{{ link_to_route('join-private', 'Nouveau salon') }}</li>
            <li>{{ link_to_route('rank', 'Classement') }}</li>
        </ul>
    </nav>
</div>
<div class="notif"></div>
<div class="content">
    <div class="content__infos">
        <ul>
            <li class="content__infos--pseudo">{{ $user->name }}</li>
            <li class="content__infos--pts">{{ $user->score->xp }}<span> pts </span></li>
            <li class="content__infos--niv"><span>Niv :</span> {{ $user->score->lvl_total }}</li>


        </ul>
    </div>
    <div class="content__control">
        <ul>
            <a href=""><li class="active">LEAD</li></a>
            <a href=""><li>PADS</li></a>
            <a href=""><li>BASS</li></a>
            <a href=""><li>DRUM</li></a>
        </ul>
    </div>
    <div class="content__boxpartitions">
        <div class="content__partitions">
            <table>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>
                <tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                </tr>

            </table>

        </div>
    </div>
    <div class="content__user">

        <div class="content__user--player">
            <ul>
                <a href="">
                    <li class="theplayer">
                        <img src="/css/img/precedent.png" alt="">
                        <img src="/css/img/Play.png" alt="">
                        <img src="/css/img/suivant.png" alt="">
                    </li>
                </a>
                <a href="">
                    <li class="active"><p>Lead : Wladouche</p></li>
                </a>
                <a href="">
                    <li><p>Bass : Manu</p></li>
                </a>
                <a href="">
                    <li><p>Pads : Tieg</p></li>
                </a>
                <a href="">
                    <li><p>Drum : Fbad</p></li>
                </a>
            </ul>
        </div>
        <h3>Choisissez votre son et glissez le !</h3>
        <div class="content__user--sample">
            <ul>
                <a class="resizable" draggable="true" href="">
                    <li><p>Drum78</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>
                <a class="resizable" draggable="true" href="">
                    <li><p>Cajon</p></li>
                </a>

            </ul>

        </div>
        <div class="content__user--timer">
            <ul>
                <a href="">
                    <li><p>Valider</p></li>
                </a>
                <a href="">
                    <li><p>Passer</p></li>
                </a>
                <a href="">
                    <li class="active"><p>Temps restant : 0:40</p></li>
                </a>
            </ul>
        </div>
    </div>
    <script src='/js/jquery-3.0.0.min./js'></script>
    <script src="/js/index./js"></script>
</body>

</html>
