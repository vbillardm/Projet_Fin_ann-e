<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProfileController extends Controller
{
    public function details()
    {

        $user = \Auth::user();

        $user_score = \App\Score::where("id_users", "=",\Auth::user()->id)->firstOrFail();
        $user_song = \App\Song::where("id_users", "=",\Auth::user()->id)->get();

        return view('profile.detail', compact('user', 'user_score', 'user_song'));
    }
}
