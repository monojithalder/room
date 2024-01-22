<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\HomeSecurity;
use Carbon\Carbon;

class HomeSecurityController extends Controller
{
    //
    public function getAlert(Request $request)
    {
        $home_security_model = new HomeSecurity();
        $code_array = [
          1 => "2nd Floor 1st Door",
          2 => "2nd Floor 2nd Door",
          3 => "2nd Floor Balcony Door",
          4 => "3rd Floor Main Door"
        ];

        $code = $request->query("code");
        $status = $request->query("status");
        $distance = $request->query("distance");
        $log = $code_array[$code]. " is ". ($status == 1 ? "closed" : "opened");
        $timestamp = Carbon::now();
        $home_security_model->create([
            "code" => $code,
            "log" => $log,
            "distance" => $distance,
            "created_at" => $timestamp,
            "updated_at" => $timestamp
        ]);
        $message = "Someone ".($status == 1 ? "closed" : "opened")." ".$code_array[$code]." With distance: ".$distance;
        $bot_id = config('app.telegram_bot_id');
        $group_id = "-4153633550";
        $cURLConnection = curl_init();
        curl_setopt($cURLConnection, CURLOPT_URL, 'https://api.telegram.org/bot' . $bot_id . '/sendMessage?chat_id=' .
            $group_id . '&parse_mode=Markdown&text=' . $message);
        curl_setopt($cURLConnection, CURLOPT_RETURNTRANSFER, true);
        $return_data = curl_exec($cURLConnection);
        curl_close($cURLConnection);
        echo '{"success" : "1"}';

    }

}
