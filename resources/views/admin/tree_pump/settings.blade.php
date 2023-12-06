@extends('layouts.master')
@php($title = config('app.name'))
@section('page-title','Add Item - '.$title)
@section('custom-include')
    <link rel="stylesheet" href="{{asset('css/custom_css/alertmessage.css')}}">
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Tree Pump Settings
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" action="{{ url('/admin/tree-pump/settings') }}" method="post" >
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Time1</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="time1" name="time1" placeholder="Water Time 1" value="{{ $data['time1'] }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Time2</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="time2" name="time2" placeholder="Water Time 2" value="{{ $data['time2'] }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Interval</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="interval" name="interval" placeholder="Interval" value="{{ $data['interval'] }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Ip Address</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="ip_address" name="ip_address" placeholder="Ip Address" value="{{ $data['ip_address'] }}">
                                </div>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <div class="col-sm-12" style="display: flex;justify-content: flex-end">
                                    <button type="submit" class="btn btn-info">
                                        UPDATE
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-sm-2"></div>
        </div>
    </div>
@endsection
