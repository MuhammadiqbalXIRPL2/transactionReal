<?php

use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/tran', function () {
    return view('chart.mainChart');
});

Route::get('/trans', [TransactionController::class, 'index']);