@extends('layouts.master')
@php($title = config('app.name'))
@section('page-title','Update Floor - '.$title)
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
                            Update Floor
                        </h3>
                    </div>
                    <div class="panel-body">
                        <form class="form-horizontal" role="form" action="{{ url('/admin/floor/edit/'.$floor->id) }}"
                              method="post">
                            <div class="form-group">
                                <label for="name" class="col-sm-2 control-label">Name</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control" id="name" name="name"
                                           placeholder="Floor Name" value="{{ $floor->name }}">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="status" class="col-sm-2 control-label">Status</label>
                                <div class="col-sm-10">
                                    <select id="status" class="form-control" name="status" required>
                                        <option value="ACTIVE" @if($floor->status == 'ACTIVE'){{ 'selected'}}@endif>
                                            ACTIVE
                                        </option>
                                        <option value="INACTIVE" @if($floor->status == 'INACTIVE'){{ 'selected'}}@endif>
                                            INACTIVE
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            <div class="form-group">
                                <div class="col-sm-12" style="display: flex;justify-content: flex-end">
                                    <a class="btn btn-info" style="margin-right: 20px;"
                                       href="{{ url('/admin/floors') }}">
                                        BACK
                                    </a>
                                    @php($deleteUrl = "/admin/floor/delete/" . $floor->id)
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