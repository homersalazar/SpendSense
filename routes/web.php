<?php

use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\IncomeController;
use App\Http\Controllers\ReportController;
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
Route::get('/logout', [UserController::class, 'logout']);

//income
Route::resource('/income', IncomeController::class); // first
Route::post('/decrement', [IncomeController::class, 'decrement'])->name('income.decrement');
Route::post('/increment', [IncomeController::class, 'increment'])->name('income.increment');
Route::match(['get', 'post'],'/view', [IncomeController::class, 'view'])->name('income.view'); // second
Route::match(['get', 'post'],'/add', [IncomeController::class, 'add']); // third

//expense
Route::resource('/expense', ExpenseController::class);
Route::match(['get', 'post'],'/viewExpense', [ExpenseController::class, 'viewExpense']);
Route::match(['get', 'post'],'/createExpense', [ExpenseController::class, 'createExpense']);

//report
Route::resource('/report', ReportController::class);
Route::match(['get', 'post'],'/basic', [ReportController::class, 'basic']);
