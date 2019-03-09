@extends('layouts.master')
@php($title = config('app.name'))
@section('page-title','Show Floor - '.$title)
@section('custom-include')
    <link rel="stylesheet" href="{{asset('css/custom_css/alertmessage.css')}}">
@endsection
<style>
    #watertank{
        background: url({{ URL::asset('images/tank.png') }}) no-repeat;
        height: 229px;
        padding-top: 34px;
        position: relative;
    }

    .fill {
        width: 168px;
        height: 0px;
        border: 1px solid #000;
        background: green;
        left: 4px;
        border-radius: 11px;
        position: absolute;
        bottom: 37px;
    }
</style>
@section('content')
    <div class="container">
        <div>
            <p>Reserver Water Lavel: <span id="reserver-status">...</span></p>
            <p>Pump: <span id="pump-on-status">...</span></p>
        </div>
        <div id="watertank">
            <div class="fill">


            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        function fetch_water_level() {
            var url = "http://"+"{{ $data['ip'] }}" + "/waterLavel";
            $.ajax({
                url: url, success: function (result) {
                    result = result.replace("'", '"');
                    result = result.replace("'", '"');
                    result = JSON.parse(result);
                    var result_full = 100;
                    var result_percentage = 0;
                    result_percentage = (100 * result.water_level) / 100;
                    result_percentage = 100 - result_percentage;
                    var css_full = 152;
                    var css_water_lavel = (152 * result_percentage) / 100;
                    if(css_water_lavel < 0) {
                        css_water_lavel = 0;
                    }
                    $(".fill").height(css_water_lavel)
                    console.log(result);
                }
            });
        }

        function fetch_pump_status() {
            var url = "http://"+"{{ $data['ip'] }}" + "/status?type=PUMP";
            $.ajax({
                url: url, success: function (result) {
                    result = result.replace("'", '"');
                    result = result.replace("'", '"');
                    result = JSON.parse(result);

                    if(result.pump_on_status == 1) {
                        $("#pump-on-status").html("ON");
                    }
                    else {
                        $("#pump-on-status").html("OFF");
                    }
                    console.log(result);
                }
            });
        }
        function fetch_reserver_status() {
            var url = "http://"+"{{ $data['ip'] }}" + "/status?type=RESERVER";
            $.ajax({
                url: url, success: function (result) {
                    result = result.replace("'", '"');
                    result = result.replace("'", '"');
                    result = JSON.parse(result);
                    if(result.reserver_status == 0) {
                        $("#reserver-status").html("OK");
                    }
                    else {
                        $("#reserver-status").html("LOW");
                    }
                }
            });
        }
        setInterval(fetch_water_level,1000);
        setInterval(fetch_pump_status,1000);
        setInterval(fetch_reserver_status,1000);
    </script>
@endsection

