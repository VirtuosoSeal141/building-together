<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
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

Route::get('/logout', [UserController::class, 'logout'])->name('logout');

Route::get('/services', [PageController::class, 'services'])->name('services-page');
