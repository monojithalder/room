@extends('layouts.master')
@php($title = config('app.name'))
@section('page-title','Show Floor - '.$title)
@section('custom-include')
    <link rel="stylesheet" href="{{asset('css/custom_css/alertmessage.css')}}">
@endsection
<style>
    #customers {
        font-family: Arial, Helvetica, sans-serif;
        border-collapse: collapse;
        width: 100%;
        margin-bottom: 20px;
    }

    #customers td, #customers th {
        border: 1px solid #ddd;
        padding: 8px;
    }

    #customers tr:nth-child(even){background-color: #f2f2f2;}

    #customers tr:hover {background-color: #ddd;}

    #customers th {
        padding-top: 12px;
        padding-bottom: 12px;
        text-align: left;
        background-color: #4CAF50;
        color: white;
    }
    .container {
        margin-bottom: 50px;
    }
</style>

@section('content')
    <div class="container">
        <table id="customers">
            <thead>
            <tr>
                <th>Key</th>
                <th>Value</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $key => $value)
                <tr>
                    <td>{{ $key }}</td>
                    <td>{{ $value }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        <table id="customers">
            <thead>
            <tr>
                <th>Id</th>
                <th>Status</th>
                <th>Time</th>
                <th>Water Level</th>
                <th>Pump</th>
            </tr>
            </thead>
            <tbody>
            @foreach($log_data as $value)
                <tr>
                    <td>{{ $value->id }}</td>
                    <td>@if($value->status == 1) ON @else OFF @endif</td>
                    <td>{{ date('d-m-Y h:i:s a',$value->log_time) }}</td>
                    <td>{{ $value->water_level }}</td>
                    <td>Pump {{ $value->pump }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
        {{ $log_data->links() }}
    </div>
@endsection


