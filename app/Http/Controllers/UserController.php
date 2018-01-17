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

    public function task($id){
        $curl = curl_init();
        $test = array("success"=>TRUE);
        $post_fields = array('pinNo' => $id);
        $url = env('PYTHON_SERVER_URL', '');
        $port = env('PYTHON_SERVER_PORT','');
        curl_setopt($curl, CURLOPT_PORT, $port);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1); // Do a regular HTTP POST
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_fields); // Set POST data
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $test = json_encode($test);
        $response = curl_exec($curl);
        $response = json_decode($response, 1);
				$item_model = new Item();
        if($response['success'] == 1) {
        	$item = $item_model->where('item_code','=',$id)->get()->toArray();
        	$on_off_status = $item[0]['on_off_status'];
        	if($on_off_status == 'OFF') {
        		$item_model->where('item_code','=',$id)->update(['on_off_status' => 'ON']);
						$on_off_status = 'ON';
					}
					else {
						$item_model->where('item_code','=',$id)->update(['on_off_status' => 'OFF']);
						$on_off_status = 'OFF';
					}
        	echo '{"success": 1,"status" : "'.$on_off_status.'","refresh_status" : 0}';
				}
				else {
        	$items = $item_model->get()->toArray();
					foreach ($items as $item) {
						$item_model->where('item_code','=',$item['id'])->update(['on_off_status' => 'OFF']);
        	}
        	echo '{"success" : 0,"status" : "OFF","refresh_status", 1}';
				}
        //var_dump($response);
    }
}
