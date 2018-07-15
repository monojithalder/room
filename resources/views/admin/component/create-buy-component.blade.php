@extends('layouts.master')
@php($title = config('app.name'))
@section('page-title','Add Item Into List - '.$title)
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
                            Add Component Into List
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" action="{{ url('admin/add-component') }}" method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input value="@if(isset($data['name'])) {{ $data['name'] }} @endif" type="text" class="form-control" id="name" name="name" placeholder="Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Quantity</label>
                                <div class="col-sm-10">
                                    <input value="@if(isset($data['quantity'])) {{ $data['quantity'] }} @endif" type="text" class="form-control" id="quantity" name="quantity"
                                           placeholder="Quantity" value="">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Image</label>
                                <div class="col-sm-10">
                                    <input  type="file" class="form-control" id="image" name="image"
                                           placeholder="Image" >
                                </div>
                            </div>
                            {{ csrf_field() }}
                            <div class="form-group">
                                <div class="col-sm-12" style="display: flex;justify-content: flex-end">
                                    @if(!isset($data['id']))
                                        <button type="submit" class="btn btn-info">
                                            Create
                                        </button>
                                        <input type="hidden" name="list_id" value="{{ $list_id }}">
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
