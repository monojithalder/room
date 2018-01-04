@extends('layouts.master')
@php($title = config('app.name'))
@section('page-title','Items - '.$title)
@section('custom-include')
    <link rel="stylesheet" href="{{asset('css/custom_css/alertmessage.css')}}">
@endsection
@section('content')
    <div class="container">
        @include('inc.messages')
        <div class="jumbotron">
            <h2>List of Items</h2>
        </div>
        <table id="mytable" class="table table-bordred table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Room ID</th>
                <th>Item Code</th>
                <th>On/Off Status</th>
                <th>Output Pin</th>
                <th>Input Pin</th>
                <th>Status</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            @foreach($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->room_id }}</td>
                    <td>{{ $item->item_code	 }}</td>
                    <td>{{ $item->on_off_status }}</td>
                    <td>{{ $item->output_pin }}</td>
                    <td>{{ $item->input_pin }}</td>
                    <td>{{ $item->status }}</td>
                    <td>
                        <p>
                            <button class="btn btn-primary btn-xs" data-title="Edit" data-toggle="modal"
                                    data-target="#edit"
                                    data-placement="top" rel="tooltip" onclick="location.href='{{ url('/admin/item/edit/'.$item->id) }}'">
                                <span class="glyphicon glyphicon-pencil"></span>
                            </button>
                        </p>
                    </td>
                    <td>
                        <p>
                            @php($deleteUrl = "/admin/item/delete/" . $item->id)
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
