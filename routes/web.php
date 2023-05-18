<?php

use App\Http\Controllers\CalendarController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('index');
});

//LOGIN & SIGNUP
Route::resource('/user', UserController::class);
Route::post('/login', [UserController::class, 'login'])->name('login');


Route::resource('/calendar', CalendarController::class);
Route::get('/view', [CalendarController::class, 'view']);
Route::post('/view', [CalendarController::class, 'view']);




