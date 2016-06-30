<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;

class APIController extends Controller
{
    /**
     * @param $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function gain( $request)
    {

        $user_room = \App\Room::where("id_users", "=", \Auth::user()->id)->get();
        if (\Auth::user()->score->lvl_total < 10) {
            \Auth::user()->score->xp += 50;
            \Auth::user()->score->save();

        } elseif (\Auth::user()->score->lvl_total < 20) {
            \Auth::user()->score->xp += 25;
            \Auth::user()->score->save();

        } elseif (\Auth::user()->score->lvl_total < 25) {
            \Auth::user()->score->xp += 10;
            \Auth::user()->score->save();
        }

        if (\Auth::user()->score->xp >= 100) {
            \Auth::user()->score->lvl_total += 1;
            \Auth::user()->score->xp -= 100;
            \Auth::user()->score->save();

           //  return redirect()->route('room-profile', ['slug' => $request->input('slug')]);

        } else {
           // return redirect()->route('room-profile', ['slug' => $request->input('slug')]);
        }
    }
    public function sample(Request $request) {
        // réponse au JS ==> envois des samples
        // $request->session()->put('users', '1, 4, 5, 6');
    }
    public function samples() {
        $samples = \App\Sample::all();
        
        return response()->json($samples);
    }
    public function redirection() {
        // envois de l'url de redirection
    }
}
