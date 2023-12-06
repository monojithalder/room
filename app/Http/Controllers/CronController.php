<?php

namespace App\Http\Controllers;

use App\Pump;
use App\PumpSettings;
use Illuminate\Http\Request;
use App\TreePumpSettings;
use App\TreePumpStatus;

class CronController extends Controller
{
    //
    public function selectPump()
    {
        $pump = new Pump();
        $pump_data = $pump->where('id','=',1)->get()->toArray();
        $pump_settings = new PumpSettings();
        $pump_settings_data = $pump_settings->get()->toArray();
        $pump_control_mode = $pump_settings_data[0]['pump_mode'];
        $pump_running_status = $pump_data[0]['pump_running_status'];
        $last_selected_pump  = $pump_data[0]['last_selected_pump'];
        $last_selected_pump_time = $pump_data[0]['last_selected_pump_time'];
        $ip = $pump_data[0]['ip'];
        if($pump_running_status == 0 && $pump_control_mode == 2) {
            if(($last_selected_pump_time + 10800) < time()) {
                $select_pump = 1;
                if($last_selected_pump == 1) {
                    $select_pump = 2;
                }
                $cURLConnection = curl_init();

                curl_setopt($cURLConnection, CURLOPT_URL, 'http://'.$ip.'/selectPump?select_pump='.$select_pump);
                curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

                $debug_data = curl_exec($cURLConnection);
                curl_close($cURLConnection);
                $data = json_decode($debug_data,1);
                Pump::where("id",'=',1)->update(['last_selected_pump' => $select_pump,
                    "last_selected_pump_time" => time()]);
            }
        }
        echo "{\"success\" : \"1\"}";
    }

    public function onOffTreePump()
    {
        /*$tree_pump_status_model = new TreePumpStatus();
        $tree_pump_settings_model = new TreePumpSettings();
        $tree_pump_settings = $tree_pump_settings_model->get()->toArray();
        $tree_pump_status = $tree_pump_status_model->get()->toArray();
        if (!empty($tree_pump_status)) {
            $status = $tree_pump_status[0]['status'];
            if ($status == 1) {
                $interval = $tree_pump_settings[0]['interval'];
                $last_status_time = $tree_pump_status[0]['last_status_time'];
                $off_time = $last_status_time + $interval;
                if ($off_time > time()) {
                    //off the pump call esp8266 api

                    $tree_pump_status_model->where('id','=',1)->update([
                        'status' => 0,
                        'last_status_time' => time()
                    ]);
                }
            }
            else {
                $on_time1 = $tree_pump_settings[0]['time1'];
                $on_time2 = $tree_pump_settings[0]['time2'];
                $on_time1_str = date('Y-m-d ')."".$on_time1;
                $on_time2_str = date('Y-m-d ')."".$on_time2;
                $on_time1_obj = \DateTime::createFromFormat("Y-m-d H:i:s",$on_time1_str);
                $on_time2_obj = \DateTime::createFromFormat("Y-m-d H:i:s",$on_time2_str);

            }
        }
        else {

        }*/
        $tree_pump_status_model = new TreePumpStatus();
        $tree_pump_settings_model = new TreePumpSettings();
        $tree_pump_settings = $tree_pump_settings_model->get()->toArray();
        $ip = $tree_pump_settings[0]['ip_address'];
        $cURLConnection = curl_init();

        curl_setopt($cURLConnection, CURLOPT_URL, 'http://tree.evotechies.com/fetch.php');
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);

        $response = curl_exec($cURLConnection);
        curl_close($cURLConnection);


        if (!empty($response)) {
            $data = json_decode($response,1);
            $cURLConnection = curl_init();
            curl_setopt($cURLConnection, CURLOPT_URL, 'http://'.$ip.'/processRequest?item_no='.$data['status']);
            curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($cURLConnection);
            curl_close($cURLConnection);
            $bot_id = config('app.telegram_bot_id');
            $group_id = config('app.telegram_group_id');
            $message = "Tree Pump Is ";
            if ($data['status'] == 1) {
                $tree_pump_status = $tree_pump_status_model->get()->toArray();
                if ($tree_pump_status[0]['status'] == 0) {
                    $tree_pump_status_model->where('id', '=', 1)->update([
                        'status' => 1,
                        'last_status_time' => time()
                    ]);
                    $message .= " On.";
                    $cURLConnection = curl_init();
                    curl_setopt($cURLConnection, CURLOPT_URL, 'https://api.telegram.org/bot' . $bot_id . '/sendMessage?chat_id=' .
                        $group_id . '&parse_mode=Markdown&text=' . $message);
                    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
                    $return_data = curl_exec($cURLConnection);
                    curl_close($cURLConnection);
                }
            }
            else {
                $tree_pump_status = $tree_pump_status_model->get()->toArray();
                if ($tree_pump_status[0]['status'] == 1) {
                    $tree_pump_status_model->where('id','=',1)->update([
                        'status' => 0,
                        'last_status_time' => time()
                    ]);
                    $message .= " Off.";
                    $cURLConnection = curl_init();
                    curl_setopt($cURLConnection, CURLOPT_URL, 'https://api.telegram.org/bot' . $bot_id . '/sendMessage?chat_id=' .
                        $group_id . '&parse_mode=Markdown&text=' . $message);
                    curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
                    $return_data = curl_exec($cURLConnection);
                    curl_close($cURLConnection);
                }

            }
        }
    }
}
