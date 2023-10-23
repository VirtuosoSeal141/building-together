<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Service;
use Illuminate\Http\Request;

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

    public function services(){

        $categories  = Category::orderBy('id','asc')->get();

        $services = Service::all();

        return view('services', compact('categories', 'services'));
    }
    
}
