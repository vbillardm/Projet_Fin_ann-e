<!doctype html>
<html lang=fr>
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
salle de jeu en public
<h1>End, go to profile !</h1>
<a href="/room/{!! Auth::user()->room->slug !!}/profile">Récap de la room</a>
a refaire vic ! {!! Auth::user()->room !!}
</body>
</html>