<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Favourite;
use App\Models\Order;
use App\Models\Review;
use App\Models\Service;
use App\Models\View;
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

        if ($price <= 0){
            return back()
                ->withErrors(['price_error'=>'Некорректные данные'])
                ->withInput();
        }

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
        ]);

        if ($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $price = str_replace(' ','', str_replace(',','.', $serviceData['price']));

        if ($price <= 0){
            return back()
                ->withErrors(['price_error'=>'Некорректные данные'])
                ->withInput();
        }

        $service = Service::findOrFail($id);
        $service->title = $serviceData['title'];
        $service->description = $serviceData['description'];
        if($request->input('category')){
            $service->category_id = $serviceData['category'];
        }
        if($request->input('unit')){
            $service->unit_id = $serviceData['unit'];
        }
        $service->price = $price;
        $service->save();

        return redirect(route('service-page', ['id' => $service->id]));
    }

    public function delservice($id){

        Service::findOrFail($id)->delete();

        return back();
    }

    public function addreview(Request $request, $id){
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

    public function delreview($id){

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

    public function addcategory(Request $request){
        $categoryData = $request->all();
        $validator = Validator::make($categoryData, [
            'category' => 'required|max:30',
        ]);

        if ($validator->fails()){
            return back()
                ->withErrors($validator)
                ->withInput();
        }

        $category = new Category();
        $category->title = $categoryData['category'];
        $category->save();

        return redirect('/');
    }

    public function delcategory($id){

        Category::findOrFail($id)->delete();

        return back();
    }

    public function filter(Request $request){
        $filterInfo = $request->all();

        if ($request->input('search')) {
            $services = Service::search($filterInfo['search'])->get()->shuffle();
        } else{
            $services = Service::all()->shuffle();
        }

        if ($request->input('category')) {
            $services = $services->where('category_id', $filterInfo['category']);
        }

        $services = $services->where('price', '>=', $filterInfo['minPrice'])->where('price', '<=', $filterInfo['maxPrice']);

        $categories  = Category::orderBy('id','asc')->get();

        $max = $filterInfo['max'];
        $minPrice = $filterInfo['minPrice'];
        $maxPrice = $filterInfo['maxPrice'];

        return view('services', compact('categories', 'services', 'max', 'minPrice', 'maxPrice'));
        
    }
}
