@extends('layouts.master')
@php($title = config('app.name'))
@section('page-title','Add Room - '.$title)
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
                            Create New List
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" action="{{ url('admin/create-component-list') }}" method="post" >
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name" value="@if(isset($data['name'])) {{ $data['name'] }} @endif" placeholder="List Name">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10">
                                    <select id="status" class="form-control" name="status" required>
                                        <option value="OPEN" @if(isset($data['status']) && $data['status'] == 'OPEN') selected="selected" @endif>OPEN</option>
                                        <option value="CLOSED" @if(isset($data['status']) && $data['status'] == 'CLOSED') selected="selected" @endif>CLOSED</option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
