<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
<h1>Room de play Private</h1></br>
Invitez vos potes avec le slug :  {!!  \Auth::user()->room->slug !!}
<a href="/room/private/profile/{!! Auth::user()->room->slug !!}">Récap de la room</a></br>

</body>
</html>