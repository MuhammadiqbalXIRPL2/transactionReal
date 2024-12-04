<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;

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

    public function realTimeChart()
    {
        $currentMinute = Carbon::now()->format('Y-m-d H:i:00');
        $transactionCount = Transaction::whereBetween('created_at', [
            Carbon::parse($currentMinute)->startOfMinute(),
            Carbon::parse($currentMinute)->endOfMinute(),
        ])->count();

        return response()->json([
            'timestamp' => now()->format('H:i'),
            'count' => $transactionCount,
        ]);
    }
}
