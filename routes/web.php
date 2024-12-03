<?php

use App\Http\Controllers\LoginController;
use App\Http\Controllers\TableController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tran', function () {
    return view('chart.timeChart');
});

Route::get('/transaction', [TransactionController::class, 'index']);


Route::get('/login',[LoginController::class,'login'])->name('login');
Route::post('/loginPros',[loginController::class,'loginPros'])->name('loginPros');

Route::get('/table', [TableController::class, 'index']);