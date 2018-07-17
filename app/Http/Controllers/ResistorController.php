<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Resistor;
use url;

class ResistorController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

		public function showResistorList() {
    	$data = Resistor::get()->toArray();
			foreach ($data as $key => $item) {
				$color_array = explode(',',$item['color_code']);
				$data[$key]['color_array'] = $color_array;
				$data[$key]['value_str'] = $this->resistorValueCalculator($item['value'])['value'];
				$data[$key]['color_code_array'] = explode(',',$item['color_code']);
    	}
			return view('admin.resistor.resistor-list',compact('data'));
		}


		public function showCreateResistorForm() {
			return view('admin.resistor.create-resistor');
		}
		public function createResistor(Request $request) {
			if(empty($request->id)) {
				$data = array();
				$data['value'] = $request->value;
				$data['stock'] = $request->stock;
				$color_code = array();
				$color_code [] = $request->color_code_1;
				$color_code [] = $request->color_code_2;
				$color_code [] = $request->color_code_3;
				$color_code [] = $request->color_code_4;
				$data['value'] = $data['value'] * $request->unit;
				$data['color_code'] = implode(',',$color_code);
				Resistor::create($data);
				return redirect('admin/resistor-list');
			}
			else {
				$data = array();
				$data['value'] = $request->value;
				$data['stock'] = $request->stock;
				$color_code = array();
				$color_code [] = $request->color_code_1;
				$color_code [] = $request->color_code_2;
				$color_code [] = $request->color_code_3;
				$color_code [] = $request->color_code_4;
				$data['color_code'] = implode(',',$color_code);
				Resistor::where('id','=',$request->id)->update($data);
				return redirect('admin/resistor-list');
			}
		}

		public function editResistor(Request $request) {
			$id = $request->id;
			$data = array();
			$data = Resistor::where('id','=',$request->id)->get()->toArray();
			$data = $data[0];
			$data['unit'] = $this->resistorValueCalculator($data['value'])['unit'];
			$data['color_code_array'] = explode(',',$data['color_code']);
			$data['color_code_1'] = $data['color_code_array'][0];
			$data['color_code_2'] = $data['color_code_array'][1];
			$data['color_code_3'] = $data['color_code_array'][2];
			$data['color_code_4'] = $data['color_code_array'][3];
			return view('admin.resistor.create-resistor',compact('data'));
		}

		public function deleteResistor(Request $request) {
			$id = $request->id;
			Resistor::where('id','=',$request->id)->delete();
			return redirect('admin/resistor-list');
		}

		public function showResistors(Request $request) {
			$value = $request->resistor_value;
			$unit  = $request->unit;
			$value = $value * $unit;
			$exact_resistor = Resistor::where("value",'=',$value)->get()->toArray();
			$matched = 0;
			if(!empty($exact_resistor)) {
				$matched = 1;
			}

			$grater_resistors = Resistor::where("value",">",$value)->orderBy("value")->limit(5)->get()->toArray();
			foreach ($grater_resistors as $key => $item) {
				$color_array = explode(',',$item['color_code']);
				$grater_resistors[$key]['color_array'] = $color_array;
				$grater_resistors[$key]['value_str'] = $this->resistorValueCalculator($item['value'])['value'];
				$grater_resistors[$key]['color_code_array'] = explode(',',$item['color_code']);
			}

			$lower_resistors = Resistor::where("value","<",$value)->orderBy("value","desc")->limit(5)->get()->toArray();
			foreach ($lower_resistors as $key => $item) {
				$color_array = explode(',',$item['color_code']);
				$lower_resistors[$key]['color_array'] = $color_array;
				$lower_resistors[$key]['value_str'] = $this->resistorValueCalculator($item['value'])['value'];
				$lower_resistors[$key]['color_code_array'] = explode(',',$item['color_code']);
			}
			return view("admin.resistor.show-resistors",compact('matched','grater_resistors','lower_resistors'));
		}

		public function resistorValueCalculator($value) {
			$return_value = array();
    	if($value < 1000) {
				$return_value['value'] = $value.' Ω';
				$return_value['unit']  = 1;
			}
			elseif ($value > 1000 && $value < 1000000) {
				$return_value['value'] = ($value / 1000).' KΩ';
				$return_value['unit']  = 1000;
			}
			elseif($value > 1000000) {
				$return_value['value'] = ($value / 1000000).' MΩ';
				$return_value['unit']  = 1000000;
			}
			return $return_value;
		}
}
