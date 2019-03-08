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
        height: 152px;
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
            <p>Reserver Water Lavel: <span id="reserver-status">OK</span></p>
            <p>Pump: <span id="pump-on-status">ON</span></p>
        </div>
        <div id="watertank">
            <div class="fill">


            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        var url = "http://"+"{{ $data['ip'] }}" + "/waterLavel/";
        $.ajax({
            url: url, success: function (result) {
                result = JSON.parse(result);
                var result_full = 240;
                var result_percentage = 0;
                result_percentage = (100 * result.distance) / 240;

                var css_full = 152;
                var css_water_lavel = (152 * result_percentage) / 100;
                $(".fill").height(css_water_lavel)
                console.log(result);
            }
        });
        url = "http://"+"{{ $data['ip'] }}" + "/status/type=PUMP";
        $.ajax({
            url: url, success: function (result) {
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
        url = "http://"+"{{ $data['ip'] }}" + "/status/type=RESERVER";
        $.ajax({
            url: url, success: function (result) {
                result = JSON.parse(result);
                if(result.reserver_status == 0) {
                    $("#reserver-status").html("OK");
                }
                else {
                    $("#reserver-status").html("LOW");
                }
            }
        });
    </script>
@endsection

