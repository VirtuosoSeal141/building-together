<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Role;
use App\Models\Service;
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

        return view('add-service', compact('categories'));
    }

    public function editservice($id){

        $categories  = Category::orderBy('id','asc')->get();

        $service = Service::findOrFail($id);

        return view('edit-service', compact('categories', 'service'));
    }

    public function services(){

        $categories  = Category::orderBy('id','asc')->get();

        $services = Service::all();

        return view('services', compact('categories', 'services'));
    }
    
}
