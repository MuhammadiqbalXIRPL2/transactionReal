<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TransactionController extends Controller
{
    function index () {
        return view('chart.cardReport');
    }
}
