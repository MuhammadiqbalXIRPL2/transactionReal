<?php

use App\Http\Controllers\DailyController;
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

Route::get('/timeChart', [TransactionController::class, 'timeChart']);
Route::get('/requestHours', [TransactionController::class, 'hoursChart']);

Route::post('/transaksi', [TransactionController::class, 'store']);
Route::get('/login',[LoginController::class,'login'])->name('login');
Route::post('/loginPros',[loginController::class,'loginPros'])->name('loginPros');

Route::get('/table', [TableController::class, 'index']);



Route::get('/components', [TransactionController::class, 'components']);
Route::get('/daily', [DailyController::class, 'daily']);
Route::get('/realTimeChart', [DailyController::class, 'realTimeChart']);
Route::get('/timeTable', [DailyController::class, 'realTimeTable']);

