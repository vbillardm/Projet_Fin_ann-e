<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProfileController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details()
    {
        $user = \App\User::where('id', '=', \Auth::user()->id)
            ->with('score', 'song')
            ->first();

        return view('profile.detail', compact('user'));
    }
}
