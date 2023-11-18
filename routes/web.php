<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
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

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/settings', [PageController::class, 'settings'])->name('settings-page');
Route::post('/personal-settings', [UserController::class, "personalsettings"])->name('personalsettings');
Route::post('/password-settings', [UserController::class, "passwordsettings"])->name('passwordsettings');

Route::get('/myservices', [PageController::class, 'myservices'])->name('myservices-page');
Route::get('/addservice', [PageController::class, 'addservice'])->name('addservice-page');
Route::post('/addservice', [ServiceController::class, 'addservice'])->name('addservice');
Route::get('/editservice/{id}', [PageController::class, 'editservice'])->name('editservice-page');
Route::post('/editservice/{id}', [ServiceController::class, 'editservice'])->name('editservice');
Route::get('/delservice/{id}', [ServiceController::class, 'delservice'])->name('delservice');

Route::get('/services', [PageController::class, 'services'])->name('services-page');
Route::get('/service/{id}', [PageController::class, 'service'])->name('service-page');

Route::post('/addcomment/{id}', [ServiceController::class, 'addcomment'])->name('addcomment');
Route::get('/delcomment/{id}', [ServiceController::class, 'delcomment'])->name('delcomment');

Route::get('/contacts', [PageController::class, 'contacts'])->name('contacts-page');

Route::get('/favourites', [PageController::class, 'favourites'])->name('favourites-page');
Route::get('/addfavourite/{id}', [ServiceController::class, 'addfavourite'])->name('addfavourite');
Route::get('/delfavourite/{id}', [ServiceController::class, 'delfavourite'])->name('delfavourite');
