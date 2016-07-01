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
        $user = \Auth::user();

        if (\Auth::check() && ($user->score)==null) {
            \App\Score::create([
                'user_id' => $user->id,
                'lvl_total' => 1,
                'xp' => 1,
                'lvl_bass' => 1,
                'lvl_drum' => 1,
                'lvl_lead' => 1,
                'lvl_ambiance' => 1,
                'room_id' => 1
            ]);
        }

        return view('rooms.roomSelect', compact('user'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function joinPrivateRoom()
    {
        $user = \Auth::user();

        return view('rooms.roomPlayPrivate', compact('user'));
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
        $user = \Auth::user();

        return view('rooms.roomCreatePrivate', compact('user'));
    }

    /**
     * @param FindRoomRequest $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\View\View
     */
    public function play(FindRoomRequest $request)
    {
        $categories = ['bass', 'drum', 'lead', 'ambiance'];

        $choices = ['', ''];

        $choices[0] = $request->input('choix1');
        $choices[1] = $request->input('choix2');

        do {
            for ($i = 0; $i < count($choices); $i++) {
                if ($choices[$i] == null || $choices[0] == $choices[1]) {
                    $choices[$i] = $categories[rand(0, 3)];
                }
            }
        } while ($choices[0] == $choices[1]);

        $room = \App\Room::where('public', 1)
            ->where($choices[0], null)
            ->orWhere($choices[1], null)
            ->first();
        if (!$room) {
            $room = \App\Room::create([
                'name' => $this->createName(),
                'slug' => $this->createSlug($this->createName()),
                'public' => 1,
                $choices[0] => \Auth::user()->id,
                'id_users' => \Auth::user()->id
            ]);
        } else {
            if ($room->{$choices[0]} === NULL) {
                $room->{$choices[0]} = \Auth::user()->id;
            } else {
                $room->{$choices[1]} = \Auth::user()->id;
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
        $user = \App\User::with('score', 'room')->find(\Auth::user()->id);
        $role = 0;
        
        $users = [];
        $users[0] = \App\User::find($user->room->bass);
        $users[1] = \App\User::find($user->room->drum);
        $users[2] = \App\User::find($user->room->lead);
        $users[3] = \App\User::find($user->room->ambiance);

        switch ($user->id) {
            case $user->room->bass:
                $role = 0;
                break;
            case $user->room->drum:
                $role = 1;
                break;
            case $user->room->lead:
                $role = 2;
                break;
            case $user->room->ambiance:
                $role = 3;
                break;
            default:
                break;
        }

        return  view('rooms.roomPublicPlay', compact('user', 'role', 'users'));
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile()
    {
        return view('rooms.roomProfile', compact('user_room'));
    }
}
