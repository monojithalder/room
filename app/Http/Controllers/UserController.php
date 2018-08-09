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

    public function task(Request $request){
				$item_model = new Item();
				$id = $request->id;
        $curl = curl_init();
        $test = array("success"=>TRUE);
        /*$post_fields = array('item_no' => $request->id);*/
        $post_fields = array();
        $url = "http://".$request->ip_address.'/processRequest?item_no='.$id;
        $url = "http://".$request->ip_address.'/processRequest?item_no='.$id;
        $port = env('PYTHON_SERVER_PORT','');
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_POST, 1); // Do a regular HTTP POST
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
        curl_setopt($curl, CURLOPT_POSTFIELDS, $post_fields); // Set POST data
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
        $test = json_encode($test);
        $response = curl_exec($curl);
				//$response = '{"status" : "1"}';
				$response = str_replace("'",'"',$response);
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
						$item_model->where('item_code','=',$item['item_code'])->update(['on_off_status' => 'OFF']);
        	}
        	echo '{"success" : 0,"status" : "OFF","refresh_status" : 1}';
				}
        //var_dump($response);
    }

		public function taskStatus(Request $request) {
			$item_model = new Item();
			$i = 0;
			$items = $item_model->where('room_id','=',$request->id)->get()->toArray();
			$return_array = array();
			foreach ($items as $item) {
				$curl = curl_init();
				$test = array("success" => TRUE);
				/*$post_fields = array('item_no' => $request->id);*/
				$post_fields = array();
				$url = "http://" . $request->ip_address . '/status?item_no=' . $request->id;
				$port = env('PYTHON_SERVER_PORT', '');
				curl_setopt($curl, CURLOPT_URL, $url);
				curl_setopt($curl, CURLOPT_POST, 1); // Do a regular HTTP POST
				curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type:multipart/form-data"));
				curl_setopt($curl, CURLOPT_POSTFIELDS, $post_fields); // Set POST data
				curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
				//$test = json_encode($test);
				$response = curl_exec($curl);
				//$response = '{"status" : 0}';
				$response = str_replace("'", '"', $response);
				$response = json_decode($response, 1);
				$item_data['id'] = $item['item_code'];
				$item_data['status'] = $response['status'];
				$return_array[$i] = $item_data;
				$i++;
			}
			return json_encode($return_array);
    }

}
