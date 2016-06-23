<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class ProfileController extends Controller
{
    public function details($name)
    {
        $user = \App\User::where('name', $name)->get();

        return view('profile.detail', compact('user'));
    }
}
