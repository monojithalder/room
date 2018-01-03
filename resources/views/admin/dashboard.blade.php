@extends('layouts.master')
@php($title = config('app.name'))
@section('page-title','Dashboard - '.$title)
@section('custom-include')
    <link rel="stylesheet" href="{{asset('css/custom_css/alertmessage.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/Hover/css/hover.css')}}">
    <link rel="stylesheet" href="{{asset('vendors/Buttons/css/buttons.css')}}">
    <link rel="stylesheet" href="{{asset('css/custom_css/advbuttons.css')}}">
@endsection
@section('content')
    <div class="container">
        @include('inc.messages')
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-info">

                    <div class="panel-heading">
                        <h3 class="panel-title">Admin - Dashboard</h3>
                    </div>

                    <div class="panel-body">
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="panel panel-lightgreen">
                            <div class="panel-heading">
                                <h4 class="panel-title">USER</h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-1 col-sm-6 col-xs-6 text-center">
                                        <button class="button button-rounded button-flat-action sink"
                                                onclick="location.href='{{ url('/register') }}'">
                                            Insert
                                        </button>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">
                                        <button class="button button-rounded button-flat-action sink"
                                                onclick="location.href='{{ url('/admin/users') }}'">
                                            View
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-lightgreen">
                            <div class="panel-heading">
                                <h4 class="panel-title">FLOOR</h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-1 col-sm-6 col-xs-6 text-center">
                                        <button class="button button-rounded button-flat-action sink"
                                                onclick="location.href='{{ url('/admin/floor/insert') }}'">
                                            Insert
                                        </button>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">
                                        <button class="button button-rounded button-flat-action sink"
                                                onclick="location.href='{{ url('/admin/floors') }}'">
                                            View
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-lightgreen">
                            <div class="panel-heading">
                                <h4 class="panel-title">ROOM</h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-1 col-sm-6 col-xs-6 text-center">
                                        <button class="button button-rounded button-flat-action sink">
                                            Insert
                                        </button>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">
                                        <button class="button button-rounded button-flat-action sink">
                                            View
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="panel panel-lightgreen">
                            <div class="panel-heading">
                                <h4 class="panel-title">ITEM</h4>
                            </div>
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-lg-6 col-md-1 col-sm-6 col-xs-6 text-center">
                                        <button class="button button-rounded button-flat-action sink">
                                            Insert
                                        </button>
                                    </div>
                                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-6 text-center">
                                        <button class="button button-rounded button-flat-action sink">
                                            View
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
