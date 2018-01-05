<?php

namespace App\Http\Controllers;

use App\Floor;
use App\Item;
use App\Room;
use Illuminate\Http\Request;

class UserController extends Controller
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

    public function index(Request $request){
        $fid = $request->input('fid');
        $floors = Floor::all();
        $rooms = Room::where('floor_id', '=', $fid)->get();
        return view('floors.index')->with('floors',$floors)->with('rooms',$rooms);
    }

    public function room($id){
        $room = Room::find($id);
        $items = Item::where('room_id', '=', $id)->get();
        return view('rooms.index')->with('room',$room)->with('items',$items);
    }
}
