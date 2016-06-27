<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;


class RoomController extends Controller
{
    public static function  createSlug($str)
    {
        $slug = strtolower($str);

        $slug = preg_replace("/[^a-z0-9s-]/", "", $slug);
        $slug = trim(preg_replace("/[s-]+/", " ", $slug));
        $slug = preg_replace("/s/", "-", $slug);

        return $slug;
    }
    protected function createName($len = 10)
    {
        // function de création de name

            $word = array_merge(range('a', 'z'), range('A', 'Z'));
            shuffle($word);
            return substr(implode($word), 0, $len);

    }
    public function joinRoom()
    {
        $user_id = \Auth::user()->id;
        $user = \Auth::user();
        $user_score = \App\Score::where("id_users", "=",$user_id)->firstOrFail();
        $user_room=\App\Room::where("id_users", "=",$user_id)->firstOrFail();

        return view('rooms.roomSelect', compact('user_score','user','user_room'));
    }
    public function joinPrivateRoom()
    {
        $user_id = \Auth::user()->id;
        $user = \Auth::user();
        $user_room = \App\Room::where("id_users", "=",$user_id)->firstOrFail();

        return view('rooms.roomPlayPrivate', compact('user_id','user','user_room'));

    }
    public function createPrivateRoom()
    {
        if($_POST){
            $user_id = \Auth::user()->id;
            $user = \Auth::user();
            $user_score = \App\Score::where("id_users", "=",$user_id)->firstOrFail();

            $private = \App\Room::create(['name' => $_POST['name'], 'slug'=> $this->createSlug($this->createName()), 'public'=>'0', 'id_users'=>$user_id]);


            return view('rooms.roomSelectPrivate',compact('user','user_score','private'));
        }else{
            return view('rooms.roomCreatePrivate');
        }

    }
    public function SelectPrivateRoom()
    {
        // choix des roles dans la private room
        // renvois vers la page de jeu !

        if($_POST['slug']!= null){
            $user_id = \Auth::user()->id;
            $user = \Auth::user();
            $slug = $_POST['slug'];
            $user_room = \App\Room::where('slug',$slug)->firstOrfail();
            // redirect to au lieu de views, pr l'url boloss
            return redirect()->route('room-private',['slug' => $slug]);

        }else{
            return view('rooms.roomPlayPrivate');
        }
    }
    public function SelectedPrivateRoom()
    {
        return view('rooms.roomSelectprivate');
    }
    public function play()
    {
        // récuperer les données, pour générer la page de play en fonction de l'algorithme de tri
        // en POST et en fonction des roles de chacun !

        $user_id = \Auth::user()->id;
        $user = \Auth::user();

        $choix1 = $_POST['choix1'];
        $choix2 = $_POST['choix2'];

     //   dd($choix1,$choix2);
      //  die();

        $rooms = \App\Room::where('public',1)->get();

        foreach($rooms as $room)
        {

            //dd($room->$choix1,$choix1,$user_id,$room->lead,$room,$rooms);

            if(($room->$choix1) === null)
            {
                $room->update([$choix1 => $user_id]) ;
                $user_room = \App\Room::where("id_users", "=",$user_id)->firstOrFail();
               // dd($room->$choix1,$choix1,$user_id,$room->lead,$room,$rooms);
                return redirect()->route('room-private',['slug' => $slug]);
                return view('rooms.roomPlay',compact('user_room'));

            }

            elseif($room->$choix2 === null)
            {
                $room->update([$choix2 => $user_id]);
                $user_room = \App\Room::where("id_users", "=",$user_id)->firstOrFail();
                //dd($room->$choix2,$choix2,$user_id,$room->lead,$room,$rooms);

                return view('rooms.roomPlay',compact('user_room'));
            }
        }
         $room =  \App\Room::create(['name' => $this->createName(), 'slug'=> $this->createSlug($this->createName()), 'public'=>'1', 'id_users'=>$user_id]);
        $room->update([$choix1 => $user_id]) ;
        $user_room = \App\Room::where("id_users", "=",$user_id)->firstOrFail();

        return view('rooms.roomPlay',compact('user_room'));
    }
    public function routePlay()
    {
        return  view('rooms.roomPlay',compact('user_room'));
    }
    public function profile()
    {
        $user_id = \Auth::user()->id;
        $user= \Auth::user();
        $user_room = \App\Room::where("id_users", "=",$user_id)->get();

        return view('rooms.roomProfile', compact('user_id', 'user','user_room'));
    }

}
