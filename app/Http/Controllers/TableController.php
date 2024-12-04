<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;

class TableController extends Controller
{
    function index()
    {
        $table2 = Transaction::Paginate(6);
        return view('table.index', compact('table2'));
    }

    public function realTimeTable()
    {
        $table = Transaction::whereNotIn('response_code', ['200', '404'])
            ->orderBy('timestamp', 'desc')
            ->get();

        return response()->json([
            'table' => $table
        ]);
    }
}
