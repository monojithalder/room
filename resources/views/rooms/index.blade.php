@extends('layouts.master')
@php($title = config('app.name'))
@section('page-title','Room - '.$title)
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
        .hide {
            display: none;
        }
        .show {
            display: block;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="alert alert-success hide" id="alert-success">
                    <strong>Success!</strong> Request Process Successfully Done.
                </div>
                <div class="alert alert-danger hide" id="alert-error">
                    Something Wrong
                </div>
                <div class="panel panel-info">

                    <div class="panel-heading">
                        <input type="hidden" name="room_id" id="room_id" value="{{ $room->id }}">
                        <h3 class="panel-title">Room - {{ $room->name }}</h3>
                    </div>
                    <input type="hidden" id="ip_address" name="ip_address" value="{{ $room->ip_address }}" >


                    <div class="panel-body" style="text-align: center">

                        <div class="panel ">
                            <div id="loader" style="display: none">
                                <img class="loader-img" src="{{ URL::asset('images/loader.gif') }}" >
                            </div>
                            <div class="panel-heading">
                                <h4 class="panel-title">List of Items</h4>
                            </div>
                            <div class="panel-body">
                                <div class="flatbuttons">
                                    <ul>
                                    @foreach($items as $item)
                                        <li>
                                            <a href="#" id="{{ $item->item_code }}" onclick="task('{{ $item->item_code }}')" class="button button-rounded @if($item->on_off_status == 'ON')button-flat-primary @else button-flat-caution @endif">{{ $item->name }}</a>
                                        </li>

                                    @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
@section('custom-script')
    <script>
        function task(id) {
            var ip_address = $('#ip_address').val();
            var url = "{{ URL::to('/task') }}" + "/" + id + "/" + ip_address;
            $("#loader").css("display","block");
            $.ajax({
                url: url, success: function (result) {
                    result = JSON.parse(result);
                    $("#loader").css("display","none");
                    if(result.success == 1) {
                        $("#alert-success").addClass('show');
                        $("#alert-success").removeClass('hide');

                        $("#alert-error").addClass('hide');
                        $("#alert-error").removeClass('show');
                        if(result.status == 'ON') {
                            $("#"+id).removeClass('button-flat-caution');
                            $("#"+id).addClass('button-flat-primary');
                        }
                        else {
                            $("#"+id).addClass('button-flat-caution');
                            $("#"+id).removeClass('button-flat-primary');
                        }
                        setTimeout(function () {
                            $("#alert-success").addClass('hide');
                            $("#alert-success").removeClass('show');
                        }, 3000);
                    }
                    else {
                        $("#alert-success").addClass('hide');
                        $("#alert-success").removeClass('show');

                        $("#alert-error").addClass('show');
                        $("#alert-error").removeClass('hide');
                        setTimeout(function () {
                            $("#alert-error").addClass('hide');
                            $("#alert-error").removeClass('show');
                        }, 3000);
                    }
                    if(result.refresh_status == 1 ){
                        location.reload();
                    }
                    console.log(result);
                }
            });
        }

        setInterval(function(){
            var ip_address = $('#ip_address').val();
            var id = $("#room_id").val();
            var url = "{{ URL::to('/item-status') }}" + "/" + id + "/" + ip_address;
            $("#loader").css("display","block");
            $.ajax({
                url: url, success: function (result) {
                    result = JSON.parse(result);
                    var i = 0;
                    for(i=0;i<result.length;i++) {
                        if(result[i]['status'] == 1) {
                            $("#"+result[i]['id']).removeClass('button-flat-caution');
                            $("#"+result[i]['id']).addClass('button-flat-primary');
                        }
                        else {
                            $("#"+result[i]['id']).addClass('button-flat-caution');
                            $("#"+result[i]['id']).removeClass('button-flat-primary');
                        }
                    }
                    $("#loader").css("display","none");
                    console.log(result);
                }
            });
        }, 20000);

        function status_update() {
            var ip_address = $('#ip_address').val();
            var id = $("#room_id").val();
            var url = "{{ URL::to('/item-status') }}" + "/" + id + "/" + ip_address;
            $("#loader").css("display","block");
            $.ajax({
                url: url, success: function (result) {
                    result = JSON.parse(result);
                    var i = 0;
                    for(i=0;i<result.length;i++) {
                        if(result[i]['status'] == 1) {
                            $("#"+result[i]['id']).removeClass('button-flat-caution');
                            $("#"+result[i]['id']).addClass('button-flat-primary');
                        }
                        else {
                            $("#"+result[i]['id']).addClass('button-flat-caution');
                            $("#"+result[i]['id']).removeClass('button-flat-primary');
                        }
                    }
                    $("#loader").css("display","none");
                    console.log(result);
                }
            });
        }
        status_update();
    </script>
@endsection