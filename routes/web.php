<?php

use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [PageController::class, 'index'])->name('main-page');

Route::get('/login', [PageController::class, 'login'])->name('login-page');
Route::post('/login', [UserController::class, "login"])->name('login');

Route::get('/sign-up/{id}', [PageController::class, 'signup'])->name('signup-page');
Route::post('/sign-up/{id}', [UserController::class, "signup"])->name('signup');

Route::get('/forget-password', [PageController::class, "forgetpassword"])->name('forgetpassword-page');
Route::post('/forget-password', [UserController::class, "forgetpassword"])->name('forgetpassword');

Route::get('/reset-password/{token}', [PageController::class, "resetpassword"])->name('resetpassword-page');
Route::post('/reset-password', [UserController::class, "resetpassword"])->name('resetpassword');

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/settings', [PageController::class, 'settings'])->name('settings-page');
Route::post('/personal-settings', [UserController::class, "personalsettings"])->name('personalsettings');
Route::post('/password-settings', [UserController::class, "passwordsettings"])->name('passwordsettings');

Route::get('/addcategory', [PageController::class, 'addcategory'])->name('addcategory-page');
Route::post('/addcategory', [ServiceController::class, 'addcategory'])->name('addcategory');
Route::get('/delcategory/{id}', [ServiceController::class, 'delcategory'])->name('delcategory');

Route::get('/myservices', [PageController::class, 'myservices'])->name('myservices-page');
Route::get('/addservice', [PageController::class, 'addservice'])->name('addservice-page');
Route::post('/addservice', [ServiceController::class, 'addservice'])->name('addservice');
Route::get('/editservice/{id}', [PageController::class, 'editservice'])->name('editservice-page');
Route::post('/editservice/{id}', [ServiceController::class, 'editservice'])->name('editservice');
Route::get('/delservice/{id}', [ServiceController::class, 'delservice'])->name('delservice');

Route::get('/services', [PageController::class, 'services'])->name('services-page');
Route::get('/service/{id}', [PageController::class, 'service'])->name('service-page');
Route::post('/services', [ServiceController::class, 'filter'])->name('filter');
Route::get('/services/{id}', [PageController::class, 'catservices'])->name('catservices-page');

Route::post('/addreview/{id}', [ServiceController::class, 'addreview'])->name('addreview');
Route::get('/delreview/{id}', [ServiceController::class, 'delreview'])->name('delreview');

Route::get('/posts', [PageController::class, 'posts'])->name('posts-page');
Route::post('/posts', [PostController::class, 'search'])->name('search');
Route::get('/post/{id}', [PageController::class, 'post'])->name('post-page');

Route::get('/myposts', [PageController::class, 'myposts'])->name('myposts-page');
Route::get('/addpost', [PageController::class, 'addpost'])->name('addpost-page');
Route::post('/addpost', [PostController::class, 'addpost'])->name('addpost');
Route::get('/editpost/{id}', [PageController::class, 'editpost'])->name('editpost-page');
Route::post('/editpost/{id}', [PostController::class, 'editpost'])->name('editpost');
Route::get('/delpost/{id}', [PostController::class, 'delpost'])->name('delpost');

Route::post('/addcomment/{id}', [PostController::class, 'addcomment'])->name('addcomment');
Route::get('/delcomment/{id}', [PostController::class, 'delcomment'])->name('delcomment');

Route::get('/contacts', [PageController::class, 'contacts'])->name('contacts-page');

Route::get('/favourites', [PageController::class, 'favourites'])->name('favourites-page');
Route::get('/addfavourite/{id}', [ServiceController::class, 'addfavourite'])->name('addfavourite');
Route::get('/delfavourite/{id}', [ServiceController::class, 'delfavourite'])->name('delfavourite');

Route::get('/orders', [PageController::class, 'orders'])->name('orders-page');
Route::post('/addorder/{id}', [OrderController::class, 'addorder'])->name('addorder');
Route::get('/delorder/{id}', [OrderController::class, 'delorder'])->name('delorder');
Route::get('/changestatus/{id}', [OrderController::class, 'changestatus'])->name('changestatus');

Route::get('/wallet', [PageController::class, 'wallet'])->name('wallet-page');
Route::post('/plus', [UserController::class, "plusbalance"])->name('plus');
Route::post('/minus', [UserController::class, "minusbalance"])->name('minus');

Route::get('/profiles', [PageController::class, 'profiles'])->name('profiles-page');
Route::get('/profile/{id}', [PageController::class, 'profile'])->name('profile-page');
Route::post('/profile-settings/{id}', [UserController::class, "profilesettings"])->name('profilesettings');
Route::post('/password-profile/{id}', [UserController::class, "passwordprofile"])->name('passwordprofile');
Route::get('/delprofile/{id}', [UserController::class, 'delprofile'])->name('delprofile');

Route::get('/chats', [PageController::class, 'chats'])->name('chats-page');