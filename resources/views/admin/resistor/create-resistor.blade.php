@extends('layouts.master')
@php($title = config('app.name'))
@section('page-title','Add Item Into List - '.$title)
@section('custom-include')
    <link rel="stylesheet" href="{{asset('css/custom_css/alertmessage.css')}}">
    <style>
        #value {
            width: 482px;
            float: left;
            margin-right: 22px;
        }
        #unit {
            width: 70px;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-2"></div>
            <div class="col-sm-8">
                <div class="panel panel-primary">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            Add Resistor
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" action="{{ url('admin/create-resistor') }}" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Value</label>
                                <div class="col-sm-10">
                                    <input value="@if(isset($data['value'])) {{ $data['value'] / $data['unit'] }} @endif" type="text" class="form-control" id="value" name="value" placeholder="Name">
                                    <select class="form-control" name="unit" id="unit">
                                        <option value="1" @if(isset($data['unit']) && $data['unit'] == 1) selected="selected" @endif>Ω</option>
                                        <option value="1000" @if(isset($data['unit']) && $data['unit'] == 1000) selected="selected" @endif>KΩ</option>
                                        <option value="1000000" @if(isset($data['unit']) && $data['unit'] == 1000000) selected="selected" @endif>MΩ</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Stock</label>
                                <div class="col-sm-10">
                                    <input value="@if(isset($data['stock'])) {{ $data['stock'] }} @endif" type="text" class="form-control" id="stock" name="stock"
                                           placeholder="Quantity" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Color 1</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="color_code_1">
                                        <option value="#FF0000" @if(isset($data['color_code_1']) && $data['color_code_1'] == '#FF0000') selected="selected" @endif>Red</option>
                                        <option value="#A52A2A" @if(isset($data['color_code_1']) && $data['color_code_1'] == '#A52A2A') selected="selected" @endif>Brown</option>
                                        <option value="#FFA500" @if(isset($data['color_code_1']) && $data['color_code_1'] == '#FFA500') selected="selected" @endif>Orange</option>
                                        <option value="#FFFF00" @if(isset($data['color_code_1']) && $data['color_code_1'] == '#FFFF00') selected="selected" @endif>Yellow</option>
                                        <option value="#008000" @if(isset($data['color_code_1']) && $data['color_code_1'] == '#008000') selected="selected" @endif>Green</option>
                                        <option value="#0000FF" @if(isset($data['color_code_1']) && $data['color_code_1'] == '#0000FF') selected="selected" @endif>Blue</option>
                                        <option value="#800080" @if(isset($data['color_code_1']) && $data['color_code_1'] == '#800080') selected="selected" @endif>Violet</option>
                                        <option value="#808080" @if(isset($data['color_code_1']) && $data['color_code_1'] == '#808080') selected="selected" @endif>Gray</option>
                                        <option value="#FFFFFF" @if(isset($data['color_code_1']) && $data['color_code_1'] == '#FFFFFF') selected="selected" @endif>White</option>
                                        <option value="#CFB53B" @if(isset($data['color_code_1']) && $data['color_code_1'] == '#CFB53B') selected="selected" @endif>Glod</option>
                                        <option value="#C0C0C0" @if(isset($data['color_code_1']) && $data['color_code_1'] == '#C0C0C0') selected="selected" @endif>Siver</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Color 2</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="color_code_2">
                                        <option value="#FF0000" @if(isset($data['color_code_2']) && $data['color_code_2'] == '#FF0000') selected="selected" @endif>Red</option>
                                        <option value="#A52A2A" @if(isset($data['color_code_2']) && $data['color_code_2'] == '#A52A2A') selected="selected" @endif>Brown</option>
                                        <option value="#FFA500" @if(isset($data['color_code_2']) && $data['color_code_2'] == '#FFA500') selected="selected" @endif>Orange</option>
                                        <option value="#FFFF00" @if(isset($data['color_code_2']) && $data['color_code_2'] == '#FFFF00') selected="selected" @endif>Yellow</option>
                                        <option value="#008000" @if(isset($data['color_code_2']) && $data['color_code_2'] == '#008000') selected="selected" @endif>Green</option>
                                        <option value="#0000FF" @if(isset($data['color_code_2']) && $data['color_code_2'] == '#0000FF') selected="selected" @endif>Blue</option>
                                        <option value="#800080" @if(isset($data['color_code_2']) && $data['color_code_2'] == '#800080') selected="selected" @endif>Violet</option>
                                        <option value="#808080" @if(isset($data['color_code_2']) && $data['color_code_2'] == '#808080') selected="selected" @endif>Gray</option>
                                        <option value="#FFFFFF" @if(isset($data['color_code_2']) && $data['color_code_2'] == '#FFFFFF') selected="selected" @endif>White</option>
                                        <option value="#CFB53B" @if(isset($data['color_code_2']) && $data['color_code_2'] == '#CFB53B') selected="selected" @endif>Glod</option>
                                        <option value="#C0C0C0" @if(isset($data['color_code_2']) && $data['color_code_2'] == '#C0C0C0') selected="selected" @endif>Siver</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Color 3</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="color_code_3">
                                        <option value="#FF0000" @if(isset($data['color_code_3']) && $data['color_code_3'] == '#FF0000') selected="selected" @endif>Red</option>
                                        <option value="#A52A2A" @if(isset($data['color_code_3']) && $data['color_code_3'] == '#A52A2A') selected="selected" @endif>Brown</option>
                                        <option value="#FFA500" @if(isset($data['color_code_3']) && $data['color_code_3'] == '#FFA500') selected="selected" @endif>Orange</option>
                                        <option value="#FFFF00" @if(isset($data['color_code_3']) && $data['color_code_3'] == '#FFFF00') selected="selected" @endif>Yellow</option>
                                        <option value="#008000" @if(isset($data['color_code_3']) && $data['color_code_3'] == '#008000') selected="selected" @endif>Green</option>
                                        <option value="#0000FF" @if(isset($data['color_code_3']) && $data['color_code_3'] == '#0000FF') selected="selected" @endif>Blue</option>
                                        <option value="#800080" @if(isset($data['color_code_3']) && $data['color_code_3'] == '#800080') selected="selected" @endif>Violet</option>
                                        <option value="#808080" @if(isset($data['color_code_3']) && $data['color_code_3'] == '#808080') selected="selected" @endif>Gray</option>
                                        <option value="#FFFFFF" @if(isset($data['color_code_3']) && $data['color_code_3'] == '#FFFFFF') selected="selected" @endif>White</option>
                                        <option value="#CFB53B" @if(isset($data['color_code_3']) && $data['color_code_3'] == '#CFB53B') selected="selected" @endif>Glod</option>
                                        <option value="#C0C0C0" @if(isset($data['color_code_3']) && $data['color_code_3'] == '#C0C0C0') selected="selected" @endif>Siver</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Color 4</label>
                                <div class="col-sm-10">
                                    <select class="form-control" name="color_code_4">
                                        <option value="#FF0000" @if(isset($data['color_code_4']) && $data['color_code_4'] == '#FF0000') selected="selected" @endif>Red</option>
                                        <option value="#A52A2A" @if(isset($data['color_code_4']) && $data['color_code_4'] == '#A52A2A') selected="selected" @endif>Brown</option>
                                        <option value="#FFA500" @if(isset($data['color_code_4']) && $data['color_code_4'] == '#FFA500') selected="selected" @endif>Orange</option>
                                        <option value="#FFFF00" @if(isset($data['color_code_4']) && $data['color_code_4'] == '#FFFF00') selected="selected" @endif>Yellow</option>
                                        <option value="#008000" @if(isset($data['color_code_4']) && $data['color_code_4'] == '#008000') selected="selected" @endif>Green</option>
                                        <option value="#0000FF" @if(isset($data['color_code_4']) && $data['color_code_4'] == '#0000FF') selected="selected" @endif>Blue</option>
                                        <option value="#800080" @if(isset($data['color_code_4']) && $data['color_code_4'] == '#800080') selected="selected" @endif>Violet</option>
                                        <option value="#808080" @if(isset($data['color_code_4']) && $data['color_code_4'] == '#808080') selected="selected" @endif>Gray</option>
                                        <option value="#FFFFFF" @if(isset($data['color_code_4']) && $data['color_code_4'] == '#FFFFFF') selected="selected" @endif>White</option>
                                        <option value="#CFB53B" @if(isset($data['color_code_4']) && $data['color_code_4'] == '#CFB53B') selected="selected" @endif>Glod</option>
                                        <option value="#C0C0C0" @if(isset($data['color_code_4']) && $data['color_code_4'] == '#C0C0C0') selected="selected" @endif>Siver</option>
                                    </select>
                                </div>
                            </div>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="col-sm-12" style="display: flex;justify-content: flex-end">
                                    @if(!isset($data['id']))
                                        <button type="submit" class="btn btn-info">
                                            Create
                                        </button>
                                    @else
                                        <input type="hidden" name="id" value="{{ $data['id'] }}">
                                        <button type="submit" class="btn btn-info">
                                            Update
                                        </button>
                                    @endif
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
