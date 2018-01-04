@extends('layouts.master')
@php($title = config('app.name'))
@section('page-title','Dashboard - '.$title)
@section('custom-include')
    <link rel="stylesheet" href="{{asset('css/custom_css/alertmessage.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/Hover/css/hover.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/Buttons/css/buttons.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom_css/advbuttons.css')}}">
@endsection
@section('custom-internal-css')
    <style>
        .flex-grid {
            display: flex;
            flex-wrap: wrap;
            text-align: center;
        }

        .col {
            display: flex;
            align-items: center;
            justify-content: center;
            flex: 1;
            margin: 10px;
            min-width: 80px;
            min-height: 80px;
            background-color: #d3be2c;
            cursor: pointer;
        }

        .col > h3 {
            margin: 0;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">

                    <div class="panel-heading">
                        <h3 class="panel-title">User - Dashboard</h3>
                    </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="panel panel-lightgreen">
                            <div class="panel-heading">
                                <h4 class="panel-title">List of Floors</h4>
                            </div>
                            <div class="panel-body">
                                <div class="flex-grid">
                                    @foreach($floors as $floor)
                                        @php($url = '/dashboard?fid='.$floor->id)
                                        <div class="col" onclick="location.href='{{ url($url) }}'">
                                            <h3>{{ $floor->name }}</h3></div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                        @if(sizeof($rooms) > 0)
                            <div class="panel panel-lightgreen">
                                <div class="panel-heading">
                                    <h4 class="panel-title">List of Floors</h4>
                                </div>
                                <div class="panel-body">
                                    <div class="flex-grid">
                                        @foreach($rooms as $room)
                                            <div class="col"><h3>{{ $room->name }}</h3></div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
