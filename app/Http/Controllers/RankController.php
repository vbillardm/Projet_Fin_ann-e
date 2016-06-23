<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;


class RankController extends Controller
{
    public function listage()
    {
        $all = \App\User::all();

        return view('rank.list', compact('all'));
    }
}
