<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TableController extends Controller
{
    function index() {
        $table2 = Transaction::Paginate(6);
        return view('table.index', compact('table2'));
    }
}
