<!doctype html>
<html lang=fr>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
salle de jeu en public
<h1>End, go to profile !</h1>
<a href="/room/public/profile/{!! Auth::user()->room->slug !!}">Récap de la room</a></br>
a refaire vic ! {!! Auth::user()->room !!}

</body>
</html>