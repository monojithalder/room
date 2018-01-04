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
                            Add New Item
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" action="{{ url('/admin/item/insert') }}" method="post" >
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" placeholder="Item Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Item Code</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="item_code" placeholder="Item Code">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Output Pin</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="output_pin" placeholder="Output Pin">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Input Pin</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="input_pin" placeholder="Input Pin">
                                </div>
                            </div>
                            <input type="hidden" name="on_off_status" value="ON">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Room</label>
                                <div class="col-sm-10">
                                    <select id="status" class="form-control" name="floor_id" required>
                                        @foreach($rooms as $key => $value)
                                            <option value="{{ $value->id }}">{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10">
                                    <select id="status" class="form-control" name="status" required>
                                        <option value="ACTIVE">ACTIVE</option>
                                        <option value="INACTIVE">INACTIVE</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <div class="col-sm-12" style="display: flex;justify-content: flex-end">
                                    <button type="submit" class="btn btn-info">
                                        ADD
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
