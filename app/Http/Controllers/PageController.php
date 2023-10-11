<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){

        $categories  = Category::orderBy('id','asc')->get();

        return view('index', compact('categories'));
    }

    public function services(){

        return view('services');
    }
    
}
