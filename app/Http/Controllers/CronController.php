<?php

namespace App\Http\Controllers;

use App\Pump;
use App\PumpSettings;
use Illuminate\Http\Request;

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
}
