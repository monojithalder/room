<?php

namespace App\Http\Controllers;

use App\Floor;
use App\Room;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
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
    public function index(Request $request)
    {
        if(Auth::user()->role == 'ADMIN'){
            return view('admin.dashboard');
        }

        if(Auth::user()->role == 'USER'){

            $fid = $request->input('fid');

            $floors = Floor::all();
            $rooms = Room::where('floor_id', '=', $fid)->get();
            return view('dashboard')->with('floors',$floors)->with('rooms',$rooms);
        }
    }
}
