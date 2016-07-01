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
            <a href="" class="disabled"><li data-role="2">LEAD</li></a>
            <a href="" class="disabled"><li data-role="3">PADS</li></a>
            <a href="" class="disabled"><li data-role="0">BASS</li></a>
            <a href="" class="disabled"><li data-role="1">DRUM</li></a>
        </ul>
    </div>
    <div class="content__boxpartitions">
        <div class="content__partitions">
            <table>
                <tr data-category="lead" data-categoryid="2" class="lead">

                </tr>
                <tr data-category="ambiance" data-categoryid="3" class="ambiance">

                </tr>
                <tr data-category="bass" data-categoryid="0" class="bass">

                </tr>
                <tr data-category="drum" data-categoryid="1" class="drum">

                </tr>

            </table>

        </div>
    </div>
    <div class="content__user">

        <div class="content__user--player">
            <ul>
                <a href="" class="disabled">
                    <li class="theplayer">
                        <img src="/css/img/precedent.png" alt="">
                        <img src="/css/img/Play.png" alt="">
                        <img src="/css/img/suivant.png" alt="">
                    </li>
                </a>
                <a href="" class="disabled">
                    <li data-role="2"><p>Lead : {{ $users[2]->name or '' }}</p></li>
                </a>
                <a href="" class="disabled">
                    <li data-role="0"><p>Bass : {{ $users[0]->name or '' }}</p></li>
                </a>
                <a href="" class="disabled">
                    <li data-role="3"><p>Ambiance : {{ $users[3]->name or '' }}</p></li>
                </a>
                <a href="" class="disabled">
                    <li data-role="1"><p>Drum : {{ $users[1]->name or '' }}</p></li>
                </a>
            </ul>
        </div>
        <h3>Choisissez votre son et glissez le !</h3>
        <div class="content__user--sample">
            <ul>

            </ul>

        </div>
        <div class="content__user--timer">
            <ul>
                <a href="" class="disabled">
                    <li><p>Valider</p></li>
                </a>
                <a href="" class="disabled">
                    <li><p>Passer</p></li>
                </a>
                <a href="" class="disabled">
                    <li class="active"><p>Temps restant : 0:40</p></li>
                </a>
            </ul>
        </div>
    </div>
    </div>
    <script src='/js/jquery-3.0.0.min.js'></script>
    <script src="http://localhost:3000/socket.io/socket.io.js"></script>
    <script src="/js/index.js"></script>
    <script>
        $(document).ready(function() {
            var socket = io.connect('http://localhost:3000');
            var music = {};

            socket.emit('ready', {id: {{ $user->id }}});

            socket.on('game start', function(data) {
                music = data.music;
                console.log(music);
            });

            var samples = [];
            var userRole = {{ $role }};
            var currentlyPlayed = null;
            var currentTurn = 0;
            var physicalTds = [
                document.querySelector('.bass'),
                document.querySelector('.drum'),
                document.querySelector('.lead'),
                document.querySelector('.ambiance')
            ];

            var disabledLinks = document.querySelectorAll('.disabled');

            for (var u = 0; u < disabledLinks.length; u++) {
                disabledLinks[u].addEventListener('click', function(e) {
                    e.preventDefault();
                });
            }

            var toActivate = document.querySelectorAll('li[data-role="' + userRole + '"]');

            for (var o = 0; o < toActivate.length; o++) {
                toActivate[o].classList.add('active');
            }

            function setDroppable(td) {
                td.addEventListener('dragover', function(e) {
                    e.preventDefault();
                });

                td.addEventListener('drop', function(e) {
                    e.preventDefault();

                    var data = e.dataTransfer.getData('text/plain');
                    var sample = document.querySelector('li[data-id="' +  data + '"]').dataset.id;
                    var category = document.querySelector('li[data-id="' +  data + '"]').dataset.category;

                    if (category != e.currentTarget.dataset.category || userRole != category || currentTurn != e.currentTarget.dataset.turn) return;

                    var li = document.createElement('li');
                    var p = document.createElement('p');
                    li.classList.add('samplette');
                    p.innerText = document.querySelector('li[data-id="' + sample + '"]').childNodes[0].innerText;
                    li.appendChild(p);
                    e.currentTarget.appendChild(li);
                });
            }

            for (var i = 0; i < 14; i++) {
                var td = document.createElement('td');
                td.dataset.turn = i;
                td.dataset.category = 0;
                physicalTds[0].appendChild(td);
                setDroppable(td);
                music.bass.push(td);
            }

            for (i = 0; i < 14; i++) {
                td = document.createElement('td');
                td.dataset.turn = i;
                td.dataset.category = 1;
                physicalTds[1].appendChild(td);
                setDroppable(td);
                music.drum.push(td);
            }

            for (i = 0; i < 14; i++) {
                td = document.createElement('td');
                td.dataset.turn = i;
                td.dataset.category = 2;
                physicalTds[2].appendChild(td);
                setDroppable(td);
                music.lead.push(td);
            }

            for (i = 0; i < 14; i++) {
                td = document.createElement('td');
                td.dataset.turn = i;
                td.dataset.category = 3;
                physicalTds[3].appendChild(td);
                setDroppable(td);
                music.ambiance.push(td);
            }

            $.get('/api/samples', {}, function(data) {
                var categories = ['bass', 'drum', 'lead', 'ambiance'];
                for (var i = 0; i < data.length; i++) {
                    var sample = new Audio('/samples/' + categories[data[i].category] + '/' + encodeURI(data[i].title + '.mp3'));

                    samples.push(sample);

                    if (userRole == data[i].category) {
                        var sampleElement = document.createElement('li');
                        sampleElement.draggable = true;
                        sampleElement.classList.add('samplette');
                        sampleElement.dataset.id = i;
                        sampleElement.dataset.category = data[i].category;
                        sampleElement.innerHTML = '<p>' + data[i].title + '</p>';
                        document.querySelector('.content__user--sample ul').appendChild(sampleElement);

                        sampleElement.addEventListener('click', function(e) {
                            if (currentlyPlayed != null) {
                                samples[currentlyPlayed].pause();
                                samples[currentlyPlayed].currentTime = 0;
                            }

                            samples[e.currentTarget.dataset.id].play();
                            currentlyPlayed = e.currentTarget.dataset.id;
                        });

                        sampleElement.addEventListener('dragstart', function(e) {
                            e.dataTransfer.setData('text/plain', e.currentTarget.dataset.id);
                        });
                    }
                }
            });
        });
    </script>
</body>

</html>
