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
    .percentage {
        margin-left: 66px;
        color: #fff;
    }
</style>

@section('content')
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Condition</th>
                <th scope="col">Counter</th>
                <th scope="col">Else Part Distance</th>
                <th scope="col">Check Water Counter</th>
                <th scope="col">master_status</th>
                <th scope="col">Pump1 Pin Status</th>
                <th scope="col">Pump On Condition</th>
                <th scope="col">Master Control</th>
                <th scope="col">Pump2 Pin Status</th>
                <th scope="col">Pump Control Mode</th>
                <th scope="col">Select Pump</th>
                <th scope="col">Last Pump On</th>
                <th scope="col">Pump Start Height</th>
                <th scope="col">Low Level</th>
                <th scope="col">High Level</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>{{ $data['Condition'] }}</td>
                <td>{{ $data['Counter'] }}</td>
                <td>{{ $data['else_part_distance'] }}</td>
                <td>{{ $data['check_water_counter'] }}</td>
                <td>{{ $data['master_status'] }}</td>
                <td>{{ $data['Pump1 Pin Status'] }}</td>
                <td>{{ $data['Pump On Condition'] }}</td>
                <td>{{ $data['Master Control'] }}</td>
                <td>{{ $data['Pump2 Pin Status'] }}</td>
                <td>{{ $data['Pump Controll Mode'] }}</td>
                <td>{{ $data['Select Pump'] }}</td>
                <td>{{ $data['Last Pump On'] }}</td>
                <td>{{ $data['Pump Start Height'] }}</td>
                <td>{{ $data['Low Level'] }}</td>
                <td>{{ $data['High Level'] }}</td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection


