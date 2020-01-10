<?php

namespace App\Http\Controllers;

use App\Floor;
use App\Room;
use App\User;
use App\Item;
use App\Pump;
use Illuminate\Http\Request;
use App\PumpSettings;

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
			$room->ip_address = $request->ip_address;
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
			$room->ip_address = $request->ip_address;
			$room->floor_id = $request->input('floor_id');
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

	public function items(){
		$items = Item::all();
		return view('admin.items.index')->with('items',$items);
	}

	public function itemInsertForm(){
		$rooms = Room::all();
		return view('admin.items.insert',compact('rooms'));
	}

	public function itemEditForm($id){
		$item = Item::find($id);
		$rooms = Room::all();
		return view('admin.items.edit',compact('item','rooms'));
	}

	public function itemUpdate(Request $request){

		$redirect = '/admin/items';

		if($request->id == null){
			$item = new Item();
			$item->name = $request->input('name');
			$item->room_id = $request->input('room_id');
			$item->item_code	 = $request->input('item_code');
			$item->on_off_status = $request->input('on_off_status');
			$item->output_pin = $request->input('output_pin');
			$item->input_pin = $request->input('input_pin');
			$item->status = $request->input('status');
			$item->save();
			return redirect($redirect)->with('success','Item Inserted Successfully.');
		}
		else{
			$item = Item::find($request->id);
			if($item == null){
				return redirect($redirect)->with('error','Item Does Not Exist');
			}
			$item->name = $request->input('name');
			$item->room_id = $request->input('room_id');
			$item->item_code	 = $request->input('item_code');
			$item->on_off_status = $request->input('on_off_status');
			$item->output_pin = $request->input('output_pin');
			$item->input_pin = $request->input('input_pin');
			$item->status = $request->input('status');
			$item->save();
			return redirect($redirect)->with('success','Item Updated Successfully.');
		}
	}

	public function itemDelete(Request $request){

		$redirect = '/admin/items';

		$item = Item::find($request->id);
		if($item == null){
			return redirect($redirect)->with('error','Item Does Not Exist');
		}
		$item->delete();
		return redirect($redirect)->with('success','Item Deleted Successfully.');
	}

    public function showPumpIpForm()
    {
        $pump = new Pump();
        $pump_data = $pump->get()->toArray();
        $data = array();
        if(!empty($pump_data)) {
            $data['ip'] = $pump_data[0]['ip'];
        }
        else {
            $pump->create([
                'ip' => '0.0.0.0',
                'status' => 1

            ]);
            $data['ip'] = '0.0.0.0';
        }
        return view('admin.pump.insert',compact('data'));
	}

    public function insertPumpIp(Request $request)
    {
        $ip =  $request->ip;
        $pump = new Pump();
        $pump->find(1)->update([
            'ip' => $ip
        ]);
        return redirect('/admin/pump-ip/insert')->with('success','Pump Ip Added Successfully.');
	}

    public function viewWaterLevel()
    {
        $pump = new Pump();
        $pump_data = $pump->where('id','=',1)->get()->toArray();
        $data['ip'] = $pump_data[0]['ip'];
        $pump_settings = new PumpSettings();
        $pump_settings_data = $pump_settings->get()->toArray();
        $master_control = 0;
        if(empty($pump_settings_data[0]['master_control'])) {
            $pump_settings->find(1)->update([
                'master_control' => 0,
            ]);
        }
        else {
            $master_control = $pump_settings_data[0]['master_control'];
        }
        $data['master_control'] = $master_control;
        return view('admin.pump.show',compact('data'));
	}

    public function pumpSettingsForm()
    {
        $pump_settings = new PumpSettings();
        $pump_data = $pump_settings->get()->toArray();
        $data = array();
        if(!empty($pump_data)) {
            $data['tank_high_value'] = $pump_data[0]['tank_high_value'];
            $data['tank_low_value'] = $pump_data[0]['tank_low_value'];
            $data['pump_mode'] = $pump_data[0]['pump_mode'];
            $data['select_pump'] = $pump_data[0]['select_pump'];
        }
        else {
            $pump_settings->create([
                'tank_high_value' => 0,
                'tank_low_value' => 0

            ]);
            $data['tank_low_value']  = 0;
            $data['tank_high_value'] = 0;
        }
        return view('admin.pump.settings',compact('data'));
	}

    public function pumpSettings(Request $request)
    {
        $tank_high_value =  $request->tank_high_value;
        $tank_low_value =  $request->tank_low_value;
        $pump_mode =  $request->pump_mode;
        $select_pump =  $request->select_pump;
        $pump_settings = new PumpSettings();
        $pump = new Pump();
        $pump_data = $pump->where('id','=',1)->get()->toArray();
        $ip = $pump_data[0]['ip'];
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://'.$ip.'/setTankHighLevel?level='.$tank_high_value,
            CURLOPT_USERAGENT => 'Pump Settings'
        ]);
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://'.$ip.'/setTankLowLevel?level='.$tank_low_value,
            CURLOPT_USERAGENT => 'Pump Settings'
        ]);
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://'.$ip.'/set-pump-controll-mode?pump_mode='.$pump_mode.'&select_pump='.$select_pump,
            CURLOPT_USERAGENT => 'Pump Settings'
        ]);
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        // Close request to clear up some resources
        curl_close($curl);
        $pump_settings->find(1)->update([
            'tank_high_value' => $tank_high_value,
            'tank_low_value' => $tank_low_value,
            'pump_mode' => $pump_mode,
            'select_pump' => $select_pump
        ]);
        return redirect('/admin/pump/settings')->with('success','Pump Ip Added Successfully.');
	}

    public function pumpMasterControl()
    {
        $pump_settings = new PumpSettings();
        $pump_settings_data = $pump_settings->get()->toArray();
        $master_control = $pump_settings_data[0]['master_control'];
        $pump = new Pump();
        $pump_data = $pump->where('id','=',1)->get()->toArray();
        $ip = $pump_data[0]['ip'];
        $curl = curl_init();
        // Set some options - we are passing in a useragent too here
        curl_setopt_array($curl, [
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://'.$ip.'/masterControl?item_no='.!$master_control,
            CURLOPT_USERAGENT => 'Master Control'
        ]);
        // Send the request & save response to $resp
        $resp = curl_exec($curl);
        $resp = json_decode($resp,1);
        if($resp['success'] == 1) {
            $pump_settings->find(1)->update([
                'master_control' => !$master_control
            ]);
        }
        return '{"master_control" : '.!$master_control.'}';
	}

    public function pumpDebug()
    {
        $pump = new Pump();
        $pump_data = $pump->where('id','=',1)->get()->toArray();
        $ip = $pump_data[0]['ip'];

        $cURLConnection = curl_init();

        curl_setopt($cURLConnection, CURLOPT_URL, 'http://'.$ip.'/debug');
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

        $debug_data = curl_exec($cURLConnection);
        curl_close($cURLConnection);
        $data = json_decode($debug_data,1);
        return view('admin.pump.debug',compact('data'));
	}
}
