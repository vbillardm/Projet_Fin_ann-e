<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Auth\AuthController;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = \Auth::user();
        if (\Auth::check() && ($user->score)==null) {
           \App\Score::create([
               'user_id'=> $user->id,
               'lvl_total' => 1,
               'xp' => 1,
               'lvl_bass' => 1,
               'lvl_drum' => 1,
               'lvl_lead' => 1,
               'lvl_ambiance' => 1,
               'room_id' => 1
           ]);
        }
        
        return view('home');
    }

}
