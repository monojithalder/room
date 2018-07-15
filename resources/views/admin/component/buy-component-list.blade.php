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
                <a href="{{ URL::to('admin/add-component').'/'.$list_id }}" class="btn btn-primary">Add Component</a>
                <a href="#" onclick="print_list();" class="btn btn-primary">Print</a>
            </div>
        </div>
        <br>
        <br>
        <div id="mytable">
        <table  class="table table-bordred table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Quantity</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $value)
                <tr>
                    <td>{{ $value['id'] }}</td>
                    <td>{{ $value['name'] }}</td>
                    <td>{{ $value['quantity'] }}</td>
                    <td>@if($value['image'] != '')<img src="{{ url('storage/'.$value['image']) }}" width="100" height="100"> @endif</td>
                    <td>
                        <p>
                            <a href="{{ URL::to('admin/edit-buy-component').'/'.$value['id'] }}" class="btn btn-primary">Edit</a>
                            <a href="{{ URL::to('admin/delete-buy-component').'/'.$value['id'] }}" class="btn btn-primary">Delete</a>
                        </p>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
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
        
        function print_list() {
            var content = document.getElementById("mytable").innerHTML;
            var mywindow = window.open('', 'Print', 'height=600,width=800');
            var test = "{{ asset('css/bootstrap.min.css') }}";
            var css = "@media print { #mytable {\n" +
                "    font-family: \"Trebuchet MS\", Arial, Helvetica, sans-serif;\n" +
                "    border-collapse: collapse;\n" +
                "    width: 100%;\n" +
                "}\n" +
                "\n" +
                "td, th {\n" +
                "    border: 1px solid #ddd;\n" +
                "    padding: 8px;\n" +
                "}\n" +
                "\n" +
                " tr:nth-child(even){background-color: #f2f2f2;}\n" +
                "\n" +
                " tr:hover {background-color: #ddd;}\n" +
                "\n" +
                " th {\n" +
                "    padding-top: 12px;\n" +
                "    padding-bottom: 12px;\n" +
                "    text-align: left;\n" +
                "    background-color: #4CAF50;\n" +
                "    color: white;\n" +
                "}}";
            mywindow.document.write('<html><head>');
            mywindow.document.write('<link  rel="stylesheet" href="'+test+'">');
            mywindow.document.write('<style>'+css+'</style>');
            mywindow.document.write('<title>Print</title>')
            mywindow.document.write('</head><body >');
            mywindow.document.write(content);
            mywindow.document.write('</body></html>');

            mywindow.document.close();
            mywindow.focus()
            mywindow.print();
            //mywindow.close();
            return true;
        }
    </script>
@endsection
