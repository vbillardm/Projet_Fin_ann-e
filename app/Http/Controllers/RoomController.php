<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class RoomController extends Controller
{
    public function joinRoom()
    {
        return view('rooms.roomSelect');
    }
    public function createPrivateRoom()
    {
        return view('rooms.roomPrivate');
    }
    public function play()
    {
        return view('rooms.roomPlay');
    }
    public function profile()
    {
        return view('rooms.roomProfile');
    }

}
