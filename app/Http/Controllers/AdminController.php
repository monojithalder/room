<?php

namespace App\Http\Controllers;

use App\Floor;
use App\Room;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
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

    public function floors(){
        $floors = Floor::all();
        return view('admin.floors.index')->with('floors',$floors);
    }

    public function floorInsertForm(){
        return view('admin.floors.insert');
    }

    public function floorEditForm($id){
        $floor = Floor::find($id);
        return view('admin.floors.edit')->with('floor',$floor);
    }

    public function floorUpdate(Request $request){

        $redirect = '/admin/floors';

        if($request->id == null){
            $floor = new Floor;
            $floor->name = $request->input('name');
            $floor->status = $request->input('status');
            $floor->save();
            return redirect($redirect)->with('success','Floor Inserted Successfully.');
        }
        else{
            $floor = Floor::find($request->id);
            if($floor == null){
                return redirect($redirect)->with('error','Floor Does Not Exist');
            }
            $floor->name = $request->input('name');
            $floor->status = $request->input('status');
            $floor->save();
            return redirect($redirect)->with('success','Floor Updated Successfully.');
        }
    }

    public function floorDelete(Request $request){

        $redirect = '/admin/floors';

        $floor = Floor::find($request->id);
        if($floor == null){
            return redirect($redirect)->with('error','Floor Does Not Exist');
        }
        $floor->delete();
        return redirect($redirect)->with('success','Floor Deleted Successfully.');
    }

    public function users(){
        $users = User::all();
        return view('admin.users.index')->with('users',$users);
    }

    public function userEditForm($id){
        $user = User::find($id);
        return view('admin.users.edit')->with('user',$user);
    }

    public function userUpdate(Request $request){

        $redirect = '/admin/users';

        $user = User::find($request->id);
        if($user == null){
            return redirect($redirect)->with('error','User Does Not Exist');
        }

        $checkUserName = User::where('username',$request->input('username'))->where('id','<>',$request->id)->get()->toArray();
        if(sizeof($checkUserName) == 0){
            $user->name = $request->input('name');
            $user->role = $request->input('role');
            $user->username = $request->input('username');
            $user->save();
            return redirect($redirect)->with('success','User Updated Successfully.');
        }
        else{
            return redirect('/admin/user/edit/'.$request->id)->with('error','Username not available.');
        }

    }

    public function userDelete(Request $request){

        $redirect = '/admin/users';

        $user = User::find($request->id);
        if($user == null){
            return redirect($redirect)->with('error','User Does Not Exist');
        }
        $user->delete();
        return redirect($redirect)->with('success','User Deleted Successfully.');
    }

	public function rooms(){
		$rooms = Room::all();
		return view('admin.rooms.index')->with('rooms',$rooms);
	}

	public function roomInsertForm(){
		$floors = Floor::all();
		return view('admin.rooms.insert',compact('floors'));
	}

	public function roomEditForm($id){
		$room = Room::find($id);
		$floors = Floor::all();
		return view('admin.rooms.edit',compact('room','floors'));
	}

	public function roomUpdate(Request $request){

		$redirect = '/admin/rooms';

		if($request->id == null){
			$room = new Room();
			$room->name = $request->input('name');
			$room->floor_id = $request->input('floor_id');
			$room->status = $request->input('status');
			$room->save();
			return redirect($redirect)->with('success','Room Inserted Successfully.');
		}
		else{
			$room = Room::find($request->id);
			if($room == null){
				return redirect($redirect)->with('error','Room Does Not Exist');
			}
			$room->name = $request->input('name');
			$room->status = $request->input('status');
			$room->save();
			return redirect($redirect)->with('success','Room Updated Successfully.');
		}
	}

	public function roomDelete(Request $request){

		$redirect = '/admin/rooms';

		$room = Room::find($request->id);
		if($room == null){
			return redirect($redirect)->with('error','Room Does Not Exist');
		}
		$room->delete();
		return redirect($redirect)->with('success','Room Deleted Successfully.');
	}

}
