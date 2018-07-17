@extends('layouts.master')
@php($title = config('app.name'))
@section('page-title','Resistor List - '.$title)
@section('custom-include')
    <link rel="stylesheet" href="{{asset('css/custom_css/alertmessage.css')}}">
    <style>
        #value {
            width: 482px;
            float: left;
            margin-right: 22px;
        }
        #unit {
            width: 70px;
        }
    </style>
@endsection
@section('content')
    <div class="container">
        @include('inc.messages')
        <div class="jumbotron">
            <h2>Resistor List</h2>
        </div>

        <div class="form-group">
            <div class="col-sm-10">
                <a href="{{ URL::to('admin/create-resistor') }}" class="btn btn-primary">Add Resistor</a>
            </div>
        </div>
        <br>
        <br>
        <div id="mytable">
        <table  class="table table-bordred table-striped">
            <thead>
            <tr>
                <th>ID</th>
                <th>Value</th>
                <th>Stock</th>
                <th>Packet No</th>
                <th>Color Code</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($data as $value)
                <tr>
                    <td>{{ $value['id'] }}</td>
                    <td>{{ $value['value_str'] }}</td>
                    <td>{{ $value['stock'] }}</td>
                    <td>{{ $value['packet_no'] }}</td>
                    <td><div>@foreach($value['color_code_array'] as $code_value) <div style="background-color: {{ $code_value }};float:left;height: 20px;width: 30px;"></div> @endforeach</div></td>
                    <td>
                        <p>
                            <a href="{{ URL::to('admin/edit-resistor').'/'.$value['id'] }}" class="btn btn-primary">Edit</a>
                            <a href="{{ URL::to('admin/delete-resistor').'/'.$value['id'] }}" class="btn btn-primary">Delete</a>
                        </p>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
        </div>
        <br>
        <br>
        <br>
        <div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Check Available Resistors
                    </h3>
                </div>
                <div class="panel-body">
            <div class="form-horizontal">
                <div class="form-group">
                    <label class="col-sm-2 control-label">Resistor Value</label>
                <div class="col-sm-10">
                    <input type="text" name="value" id="value" class="form-control">
                    <select class="form-control" name="unit" id="unit">
                        <option value="1" @if(isset($data['unit']) && $data['unit'] == 1) selected="selected" @endif>Ω</option>
                        <option value="1000" @if(isset($data['unit']) && $data['unit'] == 1000) selected="selected" @endif>KΩ</option>
                        <option value="1000000" @if(isset($data['unit']) && $data['unit'] == 1000000) selected="selected" @endif>MΩ</option>
                    </select>
                </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-2">
                    </div>
                    <div class="col-sm-10">
                        <input type="button" class="btn btn-primary" value="Check" id="check_resistors">
                        <input type="button" class="btn btn-primary" value="Reset" id="reset">
                    </div>
                </div>
                <div id="show_resistors">
                </div>
            </div>
        </div>
            </div>
    </div>
@endsection
@section('custom-script')
            <script>
                $("#check_resistors").click(function () {
                    var value = $("#value").val();
                    var unit  = $("#unit option:selected").val();
                    var token = "{{ csrf_token() }}";
                    $.post("{{ URL::to('admin/show-resistors') }}",
                        {
                            resistor_value: value,
                            unit: unit,
                            _token: token
                        },
                        function(data, status){
                            $("#show_resistors").html(data);
                        });
                });
                $("#reset").click(function () {
                   $("#show_resistors").html('');
                });
            </script>

@endsection
