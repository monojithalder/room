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
                            Pump Settings
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" action="{{ url('/admin/pump/settings') }}" method="post" >
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Tank High Value</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tank_high_value" name="tank_high_value" placeholder="Tank High Value" value="{{ $data['tank_high_value'] }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Tank Low Value</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="tank_low_value" name="tank_low_value" placeholder="Tank Low Value" value="{{ $data['tank_low_value'] }}">
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
