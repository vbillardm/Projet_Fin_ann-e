<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProfileController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function details($name)
    {
        $user = \App\User::where('name', '=', $name)
            ->first();
        if ($user != NULL) {
            return view('profile.detail', compact('user'));
        } else {
            return redirect()->route('home');
        }
    }
}
