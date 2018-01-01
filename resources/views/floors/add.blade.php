@extends('layouts.master')
@php($title = config('app.name'))
@section('page-title','Add Floor - '.$title)
@section('custom-include')
    <link rel="stylesheet" href="{{asset('css/custom_css/alertmessage.css')}}">
@endsection
@section('content')
    <div class="container">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">
                    Add New Floor
                </h3>
            </div>
            <div class="panel-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">
                        <label for="input-text" class="col-sm-2 control-label">Input text</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="input-text" placeholder="Input text">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
