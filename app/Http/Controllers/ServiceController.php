<?php

namespace App\Http\Controllers;

use App\Models\Favourite;
use App\Models\Review;
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
            'description' => 'required|max:600',
            'price' => 'required',
            'unit' => 'required',
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
        $service->description = $serviceData['description'];
        $service->user_id = Auth::id();
        $service->category_id = $serviceData['category'];
        $service->unit_id = $serviceData['unit'];
        $service->price = $price;
        $service->save();

        return redirect('myservices');
    }

    public function editservice(Request $request, $id){
        $serviceData = $request->all();
        $validator = Validator::make($serviceData, [
            'title' => 'required|max:100',
            'description' => 'required|max:600',
            'price' => 'required',
            'unit' => 'required',
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
        $service->description = $serviceData['description'];
        $service->category_id = $serviceData['category'];
        $service->unit_id = $serviceData['unit'];
        $service->price = $price;
        $service->save();

        return redirect(route('service-page', ['id' => $service->id]));
    }

    public function delservice($id){

        Service::findOrFail($id)->delete();

        return back();
    }

    public function addcomment(Request $request, $id){
        $revieweData = $request->all();
        $validator = Validator::make($revieweData, [
            'comment' => 'required|max:200',
            'rating' => 'required',
        ]);

        if ($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $review = new Review();
        $review->comment = $revieweData['comment'];
        $review->user_id = Auth::id();
        $review->service_id = $id;
        $review->rating = $revieweData['rating'];
        $review->save();

        return back();
    }

    public function delcomment($id){

        Review::findOrFail($id)->delete();

        return back();
    }

    public function addfavourite($id){

        $favourite = new Favourite();
        $favourite->user_id = Auth::id();
        $favourite->service_id = $id;
        $favourite->save();
    }

    public function delfavourite($id){

        Favourite::where('user_id', Auth::id())->where('service_id', $id)->delete();
    }
}
