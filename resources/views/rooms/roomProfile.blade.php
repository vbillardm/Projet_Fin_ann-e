<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
</head>
<body>
Name : {{Auth::user()->name}}
Xp : {{Auth::user()->score->xp}}
Xp gagné : 50/partie
lvl_total: {{Auth::user()->score->lvl_total}}
Room_id : {{Auth::user()->room_id}}
<a href="/">Get back Home</a>
</body>
</html>