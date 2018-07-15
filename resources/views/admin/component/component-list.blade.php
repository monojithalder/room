@extends('layouts.master')
@php($title = config('app.name'))
@section('page-title','Buy Component List - '.$title)
@section('custom-include')
    <link rel="stylesheet" href="{{asset('css/custom_css/alertmessage.css')}}">
@endsection
@section('content')
    <div class="container">
        @include('inc.messages')
        <div class="jumbotron">
            <h2>Component Buy List</h2>
        </div>

        <div class="form-group">
            <div class="col-sm-10">
                <a href="{{ URL::to('admin/create-component-list') }}" class="btn btn-primary">Add List</a>
            </div>
        </div>
        <br>
        <br>
        <table id="mytable" class="table table-bordred table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $value)
                <tr>
                    <td>{{ $value['id'] }}</td>
                    <td>{{ $value['name'] }}</td>
                    <td>{{ $value['status'] }}</td>
                    <td>
                        <p>
                            <a href="{{ URL::to('admin/edit-component-list').'/'.$value['id'] }}" class="btn btn-primary">Edit</a>
                            <a href="{{ URL::to('admin/add-component').'/'.$value['id'] }}" class="btn btn-primary">Add Component</a>
                            <a href="{{ URL::to('admin/view-component').'/'.$value['id'] }}" class="btn btn-primary">View Components</a>
                        </p>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
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
