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

        $user_id = \Auth::user()->id;

        $user_score = \App\Score::where("id_users", "=" ,$user_id)->get();

        if (\Auth::check() === true && ($user_score->isEmpty()))
        {
           // dd($user_score);
           $score_user =  \App\Score::create(['id_users'=> $user_id, 'lvl_total'=>1, 'xp'=>1,'lvl_bass'=>1,'lvl_drum'=>1,'lvl_lead'=>1,'lvl_ambiance'=>1 ]);
        }else{
            return view('home');
        }
        return view('home');
    }

}
