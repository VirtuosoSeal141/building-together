<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Order;
use App\Models\Review;
use App\Models\Role;
use App\Models\Service;
use App\Models\Unit;
use App\Models\User;
use App\Models\View;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index(){

        $categories  = Category::orderBy('id','asc')->get();

        $services = Service::all();

        $recomendations = array();

        if (count($services) !== 0) {
            if (Auth::user() && count(Auth::user()->views()->where('viewing_date', '>=', now()->subDays(7))->get()) !== 0) {
                $viewsCounts = array();
                foreach ($categories as $category) {
                    $viewsCounts[$category->id] = count(Auth::user()->views()->where('category_id', $category->id)->get());
                }
                $favservices = $services->where('category_id', array_search(max($viewsCounts), $viewsCounts));
            } else {
                $favservices = $services;
            }
    
            $prices = array();
            $orders = array();
            $reviews = array();
            $views = array();
            $days = array();
    
            foreach ($favservices as $favservice) {
                $prices[$favservice->id] = $favservice->price;
                $orders[$favservice->id] = count(Order::where('service_id', $favservice->id)->get());
                $reviews[$favservice->id] = count(Review::where('service_id', $favservice->id)->where('rating', '>=', 4)->get());
                $faviews = View::where('service_id', $favservice->id)->orderBy('user_id', 'asc')->orderBy('viewing_date', 'asc')->get();
                $numviews1 = array();
                $numviews2 = array();
                $daysviews = array();
                foreach ($faviews as $faview) {
                    $numviews2[] = [$faview->user_id, $faview->viewing_date];
                }
                foreach ($numviews2 as $key => $value) {
                    $numviews1[$key+1] = $value;
                }
                for ($i=1; $i < count($faviews); $i++) {
                    if ($numviews1[$i][0]===$numviews2[$i][0]) {
                        $daysviews[$numviews2[$i][0]][] = Carbon::parse($numviews1[$i][1])->diffInDays(Carbon::parse($numviews2[$i][1]));
                    }
                }
                foreach ($daysviews as $key => $value) {
                    $daysviews[$key] = array_sum($daysviews[$key])/count($daysviews[$key]);
                }
                $views[$favservice->id] = array_sum($daysviews);
                $days[$favservice->id] = now()->diffInDays($favservice->user->foundation_date);
            }
    
            $maxPrice = max($prices);
            $maxorder = max($orders);
            $maxreview = max($reviews);
            $maxview = max($views);
            $maxday = max($days);
    
            $additive = array();
            foreach ($favservices as $favservice) {
                $prices[$favservice->id] = $prices[$favservice->id]/$maxPrice;
                if ($maxorder !== 0){
                    $orders[$favservice->id] = $orders[$favservice->id]/$maxorder;
                }
                if ($maxreview !== 0){
                    $reviews[$favservice->id] = $reviews[$favservice->id]/$maxreview;
                }
                if ($maxview !== 0){
                    $views[$favservice->id] = $views[$favservice->id]/$maxview;
                }
                $days[$favservice->id] = $days[$favservice->id]/$maxday;
    
                $additive[$favservice->id] = (-$prices[$favservice->id]*1)+($orders[$favservice->id]*1)+($reviews[$favservice->id]*0.75)+($views[$favservice->id]*0.25)+($days[$favservice->id]*0.5);
            }
    
            arsort($additive);
    
            foreach ($additive as $key => $value) {
                $recomendations[] = Service::findOrFail($key);
            }
            $recomendations = array_slice($recomendations, 0, 5);
        }

        return view('index', compact('categories', 'services', 'recomendations'));
    }

    public function forgetpassword(){

        return view('forget-password');
    }
    public function resetpassword(Request $request, $token){

        return view('reset-password', ['email' => $request->email, 'token' => $token]);
    }

    public function signup($id){

        if ($id==1){

            return back();
        }

        $role = Role::findOrfail($id);

        return view('sign-up', compact('role'));
    }

    public function login(){

        return view('login');
    }

    public function settings(){

        return view('settings');
    }

    public function addcategory(){

        return view('add-category');
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

        $services = Service::all()->shuffle();
        
        if (count($services) > 0) {
            $prices = array();
            foreach ($services as $service) {
                $prices[$service->id] = $service->price;
            }
            $max = round(max($prices));
            $minPrice = round(min($prices));
            $maxPrice = $max;
        } else{
            $max = 0;
            $minPrice = 0;
            $maxPrice = $max;
        }

        return view('services', compact('categories', 'services', 'max', 'minPrice', 'maxPrice'));
    }

    public function catservices($id){

        $categories  = Category::orderBy('id','asc')->get();

        $allservices = Service::all();

        if (count($allservices) > 0) {
            $prices = array();
            foreach ($allservices as $service) {
                $prices[$service->id] = $service->price;
            }
            $max = round(max($prices));
            $minPrice = round(min($prices));
            $maxPrice = $max;
        } else{
            $max = 0;
            $minPrice = 0;
            $maxPrice = $max;
        }

        $category = Category::findOrFail($id);
        $services = $category->services->shuffle();

        return view('services', compact('categories', 'services', 'max', 'minPrice', 'maxPrice'));
    }

    public function service($id){

        $service = Service::findOrFail($id);

        $reviews = $service->reviews()->orderBy('id', 'desc')->get();

        if(Auth::user()){
            $view = new View();
            $view->user_id = Auth::id();
            $view->service_id = $id;
            $view->category_id = $service->category_id;
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

        if (Auth::user()->role->title === "Клиент"){
            $orders = Auth::user()->clientOrders()->orderBy('id', 'desc')->get();
        } elseif (Auth::user()->role->title === "Подрядчик"){
            $orders = Auth::user()->companyOrders()->orderBy('id', 'desc')->get();
        } else{
            $orders = Order::all();
        }

        return view('orders', compact('orders'));
    }
    
    public function profiles(){

        $users = User::where('role_id', 2)->get();

        return view('profiles', compact('users'));
    }

    public function profile($id){

        $user = User::findOrFail($id);

        return view('single-profile', compact('user'));
    }
}
