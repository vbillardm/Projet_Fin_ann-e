<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Auth;
use App\Http\Requests\SelectPrivateRequest;
use App\Http\Requests\FindRoomRequest;

class RoomController extends Controller
{
    /**
     * @param $str
     * @return mixed|string
     */
    protected function createSlug($str)
    {
        $slug = strtolower($str);

        $slug = preg_replace("/[^a-z0-9s-]/", "", $slug);
        $slug = trim(preg_replace("/[s-]+/", " ", $slug));
        $slug = preg_replace("/s/", "-", $slug);

        return $slug;
    }

    /**
     * @param int $len
     * @return string
     */
    protected function createName($len = 10)
    {
        $word = array_merge(range('a', 'z'), range('A', 'Z'));
        shuffle($word);
        
        return substr(implode($word), 0, $len);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function joinRoom()
    {
        return view('rooms.roomSelect');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function joinPrivateRoom()
    {
        return view('rooms.roomPlayPrivate');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function createPrivateRoom(Request $request)
    {
        $private = \App\Room::create([
            'name' => $request->input('name'),
            'slug' => $this->createSlug($this->createName()),
            'public' => 0,
            'id_users' => \Auth::user()->id
        ]);
        \App\User::where('id', '=', \Auth::user()->id)
            ->update(['room_id'=>$private->id]);

        return view('rooms.roomSelectprivate',compact('private'));
    }

    /**
     * @param SelectPrivateRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function selectPrivateRoom(SelectPrivateRequest $request)
    {
        return redirect()->route('room-private', ['slug' => $request->input('slug')]);
    }

    /**
     * @param $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function selectedPrivateRoom($slug)
    {
       $slug = \App\Room::where('slug','=',$slug)->firstOrFail();

        \Auth::User()->update(['room_id' => $slug->id]);
        \Auth::User()->save();

        return view('rooms.roomPrivate');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function formPrivateRoom()
    {
        return view('rooms.roomCreatePrivate');
    }

    /**
     * @param FindRoomRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function play(FindRoomRequest $request)
    {
        $room = \App\Room::where('public', 1)
            ->where($request->input('choix1'), null)
            ->orWhere($request->input('choix2'), null)
            ->first();
        if (!$room) {
            $room = \App\Room::create([
                'name' => $this->createName(),
                'slug' => $this->createSlug($this->createName()),
                'public' => 1,
                $request->input('choix1') => \Auth::user()->id,
                'id_users' => \Auth::user()->id
            ]);
        } else {
            if ($room->{$request->input('choix1')} === NULL) {
                $room->{$request->input('choix1')} = \Auth::user()->id;
            } else {
                $room->{$request->input('choix2')} = \Auth::user()->id;
            }

             $room->save();
        }

            \Auth::user()->room_id = $room->id;
            \Auth::user()->save();

        return redirect()->route('room-public', [
            'slug' => $room->slug
        ]);
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function routePlay()
    {
        return  view('rooms.roomPlay',compact('user_room'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function selectedPublicRoom()
    {
        return  view('rooms.roomPublicPlay');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {
        return view('rooms.roomProfile', compact('user_room'));
    }
}