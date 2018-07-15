<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ComponentList;
use App\BuyComponent;
use url;
use Illuminate\Support\Facades\Storage;

class ComponentController extends Controller
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

		public function showComponentList() {
			$data = ComponentList::get()->toArray();
			return view('admin.component.component-list',compact('data'));
    }

		public function showCreateComponentListForm() {
    	return view('admin.component.create-component-list');
    }

		public function editComponentList(Request $request) {
			$id = $request->id;
			$data = ComponentList::find($id);
			return view('admin.component.create-component-list',compact('data'));
    }

		public function createComponentList(Request $request) {
			$name = $request->name;
			$status = $request->status;
			if(empty($request->id)) {
				ComponentList::create([
					'name' => $name,
					'status' => $status
				]);
			}
			else {
				ComponentList::where('id','=',$request->id)->update([
					'name' => $name,
					'status' => $status
				]);
			}
			return redirect('admin/list-component');
    }

		public function showCreateBuyComponentForm(Request $request) {
    	$list_id = $request->list_id;
			return view('admin.component.create-buy-component',compact('list_id'));
    }

		public function createBuyComponent(Request $request) {
			if(empty($request->id)) {
				$list_id 	= $request->list_id;
				$name    	= $request->name;
				$quantity = $request->quantity;
				$image = $request->file('image');
				$path = '';
				if(!empty($request->file('image'))) {
					$path = Storage::putFile('public', $request->file('image'));
					$path = str_replace('public/', '', $path);
				}
				BuyComponent::create([
					'name' => $name,
					'quantity' => $quantity,
					'list_id' => $list_id,
					'image' => $path
				]);
				return redirect('admin/list-component');

			}
			else {
				$name    	= $request->name;
				$quantity = $request->quantity;
				$data = array();
				$data['name'] = $name;
				$data['quantity'] = $quantity;
				if(!empty($request->file('image'))) {
					$path = Storage::putFile('public', $request->file('image'));
					$path = str_replace('public/', '', $path);
					$data['image'] = $path;
				}
				BuyComponent::where('id','=',$request->id)->update($data);
				$buy_component = BuyComponent::find($request->id);
				return redirect('admin/view-component/'.$buy_component->list_id);
			}
    }

		public function viewBuyComponent(Request $request) {
			$list_id = $request->list_id;
			$data = BuyComponent::where('list_id','=',$list_id)->get()->toArray();
			return view('admin.component.buy-component-list',compact('data','list_id'));
		}

		public function editBuyComponent(Request $request) {
			$id = $request->id;
			$data = BuyComponent::where("id",'=',$id)->get()->toArray();
			$data = $data[0];
			return view('admin.component.create-buy-component',compact('data'));
		}

		public function deleteBuyComponent(Request $request) {
			$id = $request->id;
			BuyComponent::where("id",'=',$id)->delete();
			return redirect(url()->previous());
		}
}
