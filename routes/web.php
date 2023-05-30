<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\IncomeController;
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

//income
Route::resource('/income', IncomeController::class); // first
Route::post('/decrement', [IncomeController::class, 'decrement'])->name('income.decrement');
Route::post('/increment', [IncomeController::class, 'increment'])->name('income.increment');
Route::match(['get', 'post'],'/view', [IncomeController::class, 'view']); // second
Route::match(['get', 'post'],'/add', [IncomeController::class, 'add']); // third

Route::get('/create', [IncomeController::class, 'create']);
Route::post('/create', [IncomeController::class, 'create']);
