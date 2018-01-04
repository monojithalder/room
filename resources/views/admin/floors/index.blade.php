@extends('layouts.master')
@php($title = config('app.name'))
@section('page-title','Floors - '.$title)
@section('custom-include')
    <link rel="stylesheet" href="{{asset('css/custom_css/alertmessage.css')}}">
@endsection
@section('content')
    <div class="container">
        @include('inc.messages')
        <div class="jumbotron">
            <h2>List of Floors</h2>
        </div>
        <table id="mytable" class="table table-bordred table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($floors as $floor)
                <tr>
                    <td>{{ $floor->id }}</td>
                    <td>{{ $floor->name }}</td>
                    <td>{{ $floor->status }}</td>
                    <td>
                        <p>
                            <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal"
                                    data-target="#edit"
                                    data-placement="top" rel="tooltip" onclick="location.href='{{ url('/admin/floor/edit/'.$floor->id) }}'">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </button>
                        </p>
                    </td>
                    <td>
                        <p>
                            @php($deleteUrl = "/admin/floor/delete/" . $floor->id)
                            <button class="btn btn-danger btn-xs" data-title="Delete" data-toggle="modal"
                                    data-target="#delete" data-placement="top" rel="tooltip" onclick="return confirmDelete('{{ $deleteUrl }}')">
                                <span class="glyphicon glyphicon-trash"></span>
                            </button>
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
