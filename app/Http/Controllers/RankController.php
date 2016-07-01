<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


class RankController extends Controller
{
    public function rankingList()
    {
        $songs = \App\Song::orderBy('score')->limit(10)->get();
        $user = \Auth::user();
        
        return view('rank.list', compact('songs', 'user'));
    }
}
