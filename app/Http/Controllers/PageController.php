<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Review;
use App\Models\Role;
use App\Models\Service;
use App\Models\Unit;
use App\Models\View;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function index(){

        $categories  = Category::orderBy('id','asc')->get();

        $services = Service::all();

        return view('index', compact('categories', 'services'));
    }

    public function login(){

        return view('login');
    }

    public function signup($id){

        if ($id==1){

            return back();
        }

        $role = Role::findOrfail($id);

        return view('sign-up', compact('role'));
    }

    public function settings(){

        return view('settings');
    }

    public function myservices(){

        $services = Auth::user()->services()->orderBy('id', 'desc')->get();

        return view('my-services', compact('services'));
    }

    public function addservice(){

        $categories  = Category::orderBy('id','asc')->get();

        $units = Unit::orderBy('id','asc')->get();

        return view('add-service', compact('categories', 'units'));
    }

    public function editservice($id){

        $categories  = Category::orderBy('id','asc')->get();

        $units = Unit::orderBy('id','asc')->get();

        $service = Service::findOrFail($id);

        return view('edit-service', compact('categories', 'service', 'units'));
    }

    public function services(){

        $categories  = Category::orderBy('id','asc')->get();

        $services = Service::all();

        return view('services', compact('categories', 'services'));
    }

    public function service($id){

        $service = Service::findOrFail($id);

        $reviews = $service->reviews()->orderBy('id', 'desc')->get();

        if(Auth::user()){
            $view = new View();
            $view->user_id = Auth::id();
            $view->service_id = $id;
            $view->viewing_date = now();
            $view->save();
        }
        

        return view('single-service', compact('service', 'reviews'));
    }

    public function contacts(){

        return view('contacts');
    }

    public function wallet(){

        return view('wallet');
    }

    public function favourites(){

        $favourites = Auth::user()->favourites()->orderBy('id', 'desc')->get();

        return view('favourites', compact('favourites'));
    }

    public function orders(){

        $orders = Auth::user()->orders()->orderBy('id', 'desc')->get();

        return view('orders', compact('orders'));
    }
    
}
