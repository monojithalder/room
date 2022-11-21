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
        $item_model = new Item();
        $room = Room::find($id);
        $room_array = $room->get()->toArray();
        $ip = $room_array[0]['ip_address'];
        $items = Item::where('room_id', '=', $id)->get();
        $item_array = array();
        foreach ($items as $key => $item) {
            $command_string = $item['input_pin']."-pinstatus";
            if ($item['item_code'] == 1) {
                $curl = curl_init();
                $url = "http://" . $ip . '/status?item_no=' . $command_string;
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
                $response = curl_exec($curl);
                $response = json_decode($response,1);
                $item_status = "OFF";
                if ($response['pin_status'] == 0) {
                    $item_status = "ON";
                }
                $item_array[$key]['id'] = $item->id;
                $item_array[$key]['output_pin'] = $item->output_pin;
                $item_array[$key]['name'] = $item->name;
                $item_array[$key]['on_off_status'] = $item_status;
                $item_array[$key]['item_type'] = $item->item_type;
                $item_model->where('id', '=', $item->id)->update([
                    "on_off_status" => $item_status
                ]);
            }
            else {
                $curl = curl_init();
                $url = "http://" . $ip . '/status?item_no=' . $item['item_code'];
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
                $item_status = "OFF";
                $item_array[$key]['id'] = $item->id;
                $item_array[$key]['output_pin'] = $item->output_pin;
                $item_array[$key]['name'] = $item->name;
                $item_array[$key]['on_off_status'] = $item_status;
                $item_array[$key]['item_type'] = $item->item_type;
                $item_model->where('id', '=', $item->id)->update([
                    "on_off_status" => $item_status
                ]);
            }
            //sleep(4);
        }
        return view('rooms.index')->with('room',$room)->with('items',$item_array);
    }

    public function task(Request $request){
        $id = $request->id;
        $pin = $request->pin;
        $item = Item::find($id);
        $item_array = $item->get()->toArray();
        $item_array = $item_array[0];
        if ($item_array['item_code'] == 1) {
            $command_string = $item_array['output_pin']."-digitalstatus";
            $curl = curl_init();
            $url = "http://" . $request->ip_address . '/status?item_no=' . $command_string;
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($curl);
            $response = json_decode($response,1);
            $item_status = "off";
            if ($response['pin_status'] == 1) {
                $item_status = "on";
            }
            $task_command_string = $item_array['output_pin']."-".$item_status;
            $url = "http://" . $request->ip_address . '/processRequest?item_no=' . $task_command_string;
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($curl);
            $response = json_decode($response,1);
            if ($response['success'] == 1) {
                $command_string = $item_array['input_pin']."-pinstatus";
                $curl = curl_init();
                $url = "http://" . $request->ip_address . '/status?item_no=' . $command_string;
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
                $response = curl_exec($curl);
                $response = json_decode($response,1);
                $on_off_status = "OFF";
                if ($response['pin_status'] == 0) {
                    $on_off_status = "ON";
                }
                echo '{"success": 1,"status" : "' . $on_off_status . '","refresh_status" : 0,"request" : 0}';
            }

        }
        else {
            $curl = curl_init();
            $url = "http://" . $request->ip_address . '/processRequest?item_no=' . $pin;
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($curl);
            $response = str_replace("'", '"', $response);
            $response = json_decode($response, 1);
            $item_model = new Item();
            if ($response['success'] == 1) {
                $item = $item_model->where('id', '=', $id)->get()->toArray();
                $item_code = $item[0]['item_code'];
                $curl = curl_init();
                $url = "http://" . $request->ip_address . '/status?item_no=' . $item_code;
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($curl, CURLOPT_FRESH_CONNECT, TRUE);
                $response = curl_exec($curl);
                $response = str_replace("'", '"', $response);
                $response = json_decode($response, 1);
                $on_off_status = "OFF";
                if ($response['pin_status'] == 1) {
                    $on_off_status = "ON";
                }
                echo '{"success": 1,"status" : "' . $on_off_status . '","refresh_status" : 0,"request" : ' . $response['request'] . '}';
            } else {
                $items = $item_model->get()->toArray();
                foreach ($items as $item) {
                    $item_model->where('item_code', '=', $item['item_code'])->update(['on_off_status' => 'OFF']);
                }
                echo '{"success" : 0,"status" : "OFF","refresh_status" : 1}';
            }
        }
    }
    public function RegulateTask(Request $request){
        $item_model = new Item();
        $id = $request->id;
        $pin = $request->pin;
        $regulate_value = $request->regulate_value;
        $item = $item_model->where("id",'=',$id)->get()->toArray();
        if ($item[0]['item_code'] == 1) {
            $command_string = $item[0]['output_pin']."-digitalstatus";
            $curl = curl_init();
            $url = "http://" . $request->ip_address . '/status?item_no=' . $command_string;
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($curl);
            $response = json_decode($response,1);
            $item_status = "off";
            if ($response['pin_status'] == 0) {
                $item_status = "on";
            }
            $task_command_string = $item[0]['output_pin']."-value-255";
            $url = "http://" . $request->ip_address . '/processRequest?item_no=' . $task_command_string;
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($curl);
            $response = json_decode($response,1);

            $task_command_string = $item[0]['output_pin']."-".$item_status;
            $url = "http://" . $request->ip_address . '/processRequest?item_no=' . $task_command_string;
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($curl);
            $response = json_decode($response,1);
            if ($response['success'] == 1) {
                $command_string = $item[0]['input_pin']."-pinstatus";
                $curl = curl_init();
                $url = "http://" . $request->ip_address . '/status?item_no=' . $command_string;
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
                $response = curl_exec($curl);
                $response = json_decode($response,1);
                $on_off_status = "OFF";
                if ($response['pin_status'] == 0) {
                    $on_off_status = "ON";
                }
                echo '{"success": 1,"status" : "' . $on_off_status . '","refresh_status" : 0,"request" : 0}';
            }
        }
        else {
            $item_status = $item[0]['on_off_status'];
            $curl = curl_init();
            $url = "http://" . $request->ip_address . '/processRegulateRequest?item_no=' . $pin . '&regulate_value=' . $regulate_value . '&status=' . $item_status;
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($curl);
            $response = str_replace("'", '"', $response);
            $response = json_decode($response, 1);
            $item_model = new Item();
            if ($response['success'] == 1) {
                $item = $item_model->where('id', '=', $id)->get()->toArray();
                $item_code = $item[0]['item_code'];
                $curl = curl_init();
                $url = "http://" . $request->ip_address . '/status?item_no=' . $item_code;
                curl_setopt($curl, CURLOPT_URL, $url);
                curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
                curl_setopt($curl, CURLOPT_FRESH_CONNECT, TRUE);
                $response = curl_exec($curl);
                $response = str_replace("'", '"', $response);
                $response = json_decode($response, 1);
                $on_off_status = "OFF";
                if ($response['pin_status'] == 1) {
                    $on_off_status = "ON";
                }
                $item_model->where('id', '=', $id)->update([
                    "on_off_status" => $on_off_status
                ]);
                echo '{"success": 1,"status" : "' . $on_off_status . '","refresh_status" : 0,"request" : ' . $response['request'] . '}';
            } else {
                $items = $item_model->get()->toArray();
                foreach ($items as $item) {
                    $item_model->where('item_code', '=', $item['item_code'])->update(['on_off_status' => 'OFF']);
                }
                echo '{"success" : 0,"status" : "OFF","refresh_status" : 1}';
            }
        }
    }
    public function RegulateItem(Request $request){
        $item_model = new Item();
        $id = $request->id;
        $pin = $request->pin;
        $regulate_value = $request->regulate_value;
        $item = $item_model->where("id",'=',$id)->get()->toArray();
        if ($item[0]['item_code'] == 1) {
            $task_command_string = $item[0]['output_pin']."-value-".$regulate_value;
            $url = "http://" . $request->ip_address . '/processRequest?item_no=' . $task_command_string;
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($curl);
            $response = json_decode($response,1);
            if ($response['success'] == 1) {

                echo '{"success": 1}';
            } else {
                echo '{"success" : 0}';
            }
        }
        else {
            $item_status = $item[0]['on_off_status'];
            $curl = curl_init();
            $url = "http://" . $request->ip_address . '/processRegulateItemRequest?item_no=' . $pin . '&regulate_value=' . $regulate_value . '&status=' . $item_status;
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            $response = curl_exec($curl);
            $response = str_replace("'", '"', $response);
            $response = json_decode($response, 1);
            if ($response['success'] == 1) {

                echo '{"success": 1}';
            } else {
                echo '{"success" : 0}';
            }
        }
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
            $url = "http://" . $request->ip_address . '/status?item_no=' . $item['item_code'];
            $port = env('PYTHON_SERVER_PORT', '');
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, TRUE);
            curl_setopt($curl, CURLOPT_FRESH_CONNECT, TRUE);
            //$test = json_encode($test);
            $response = curl_exec($curl);
            //$response = '{"status" : 0}';
            $response = str_replace("'", '"', $response);
            $response = json_decode($response, 1);
            $item_data['id'] = $item['id'];
            $item_data['status'] = $response['pin_status'];
            $item_data['request'] = $response['request'];
            $return_array[$i] = $item_data;
            $item_status = "OFF";
            if($response['pin_status'] == 1) {
                $item_status = "ON";
            }
            if ($response['pin_status'] == 0) {
                $a = 0;
            }
            if($response['pin_status'] == 3) {
                $a = 0;
                if($response['temp'] == "79") {
                    $return_array[$i]['status'] = 1;
                }
            }
            $item_model->where('id','=',$item['id'])->update([
                "on_off_status" => $item_status
            ]);
            $i++;
            ///sleep(4);
        }
        return json_encode($return_array);
    }

}
