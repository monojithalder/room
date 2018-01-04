@extends('layouts.master')
@php($title = config('app.name'))
@section('page-title','Update Room - '.$title)
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
                            Update Room
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" action="{{ url('/admin/room/edit/'.$room->id) }}"
                              method="post">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Room Name" value="{{ $room->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-sm-2 control-label">Floor</label>
                                <div class="col-sm-10">
                                    <select id="status" class="form-control" name="status" required>
                                        @foreach($floors as $key =>  $value)
                                            <option value="{{ $value->id }}" @if($value->id == $room->floor_id) selected="selected" @endif>{{ $value->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10">
                                    <select id="status" class="form-control" name="status" required>
                                        <option value="ACTIVE" @if($room->status == 'ACTIVE'){{ 'selected'}}@endif>
                                            ACTIVE
                                        </option>
                                        <option value="INACTIVE" @if($room->status == 'INACTIVE'){{ 'selected'}}@endif>
                                            INACTIVE
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <div class="col-sm-12" style="display: flex;justify-content: flex-end">
                                    <a class="btn btn-info" style="margin-right: 20px;"
                                       href="{{ url('/admin/room') }}">
                                        BACK
                                    </a>
                                    @php($deleteUrl = "/admin/room/delete/" . $room->id)
                                    <a class="btn btn-danger" style="margin-right: 20px;"
                                       onclick="return confirmDelete('{{ $deleteUrl }}')">
                                        DELETE
                                    </a>
                                    <button type="submit" class="btn btn-primary" style="margin-right: 20px;">
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
@section('custom-script')
    <script>
        function confirmDelete(url) {
            swal({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.value) {
                    location.href = url;
                }
            })
        }
    </script>
@endsection