@if($matched == 1)
    <div id="available" style="font-size: 18px;color: green">
        <p>This resistor is available!</p>
    </div>
@endif
<br>
<br>
<div style="font-size: 18px;text-decoration: underline">
    Uppper Resistors
</div>
<table  class="table table-bordred table-striped">
    <thead>
    <tr>
        <th>Value</th>
        <th>Stock</th>
        <th>Color Code</th>

    </tr>
    </thead>
    <tbody>
    @foreach($grater_resistors as $value)
        <tr>
            <td>{{ $value['value_str'] }}</td>
            <td>{{ $value['stock'] }}</td>
            <td><div>@foreach($value['color_code_array'] as $code_value) <div style="background-color: {{ $code_value }};float:left;height: 20px;width: 30px;"></div> @endforeach</div></td>
        </tr>
    @endforeach
    </tbody>
</table>
<br>
<br>
<div style="font-size: 18px;text-decoration: underline">
    Lower Resistors
</div>
<table  class="table table-bordred table-striped">
    <thead>
    <tr>
        <th>Value</th>
        <th>Stock</th>
        <th>Color Code</th>
    </tr>
    </thead>
    <tbody>
    @foreach($lower_resistors as $value)
        <tr>
            <td>{{ $value['value_str'] }}</td>
            <td>{{ $value['stock'] }}</td>
            <td><div>@foreach($value['color_code_array'] as $code_value) <div style="background-color: {{ $code_value }};float:left;height: 20px;width: 30px;"></div> @endforeach</div></td>
        </tr>
    @endforeach
    </tbody>
</table>