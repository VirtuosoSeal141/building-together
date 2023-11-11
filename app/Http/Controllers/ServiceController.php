<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ServiceController extends Controller
{
    public function addservice(Request $request){
        $serviceData = $request->all();
        $validator = Validator::make($serviceData, [
            'title' => 'required|max:100',
            'price' => 'required',
            'category' => 'required',
        ]);

        if ($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $price = str_replace(' ','', str_replace(',','.', $serviceData['price']));

        $service = new Service();
        $service->title = $serviceData['title'];
        $service->user_id = Auth::id();
        $service->category_id = $serviceData['category'];
        $service->price = $price;
        $service->save();

        return redirect('myservices');
    }

    public function editservice(Request $request, $id){
        $serviceData = $request->all();
        $validator = Validator::make($serviceData, [
            'title' => 'required|max:100',
            'price' => 'required',
            'category' => 'required',
        ]);

        if ($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $price = str_replace(' ','', str_replace(',','.', $serviceData['price']));

        $service = Service::findOrFail($id);
        $service->title = $serviceData['title'];
        $service->category_id = $serviceData['category'];
        $service->price = $price;
        $service->save();

        return back();
    }

    public  function delservice($id){

        Service::findOrFail($id)->delete();

        return redirect('myservices');
    }
}
