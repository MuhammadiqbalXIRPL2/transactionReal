<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class TableController extends Controller
{
    function index()
    {
        $table2 = Transaction::Paginate(6);
        return view('table.index', compact('table2'));
    }

    // public function realTimeTable()
    // {
    //     $table = Transaction::whereNotIn('response_code', ['200', '404'])
    //         ->orderBy('timestamp', 'desc')
    //         ->get();

    //     return response()->json([
    //         'table' => $table
    //     ]);
    // }

    // public function realTimeChart()
    // {
    //     $now = Carbon::now();
    //     $startTime = $now->subHours(3);
    
    //     $data = DB::table('transactions')
    //         ->selectRaw("
    //             DATE_FORMAT(timestamp, '%Y-%m-%d %H:%i:00') as time_interval,
    //             MIN(transaction_value) as low,
    //             MAX(transaction_value) as high,
    //             AVG(transaction_value) as close
    //         ")
    //         ->whereBetween('timestamp', [$startTime, $now])
    //         ->groupBy(DB::raw("FLOOR(UNIX_TIMESTAMP(timestamp) / (5 * 60))"))
    //         ->orderBy('time_interval')
    //         ->get();
    
    //     $formattedData = $data->map(function ($item) {
    //         return [
    //             'x' => strtotime($item->time_interval) * 1000,
    //             'y' => [0, $item->low, $item->high, $item->close]
    //         ];
    //     });
    
    //     return response()->json([
    //         'data' => $formattedData
    //     ]);
    // }
}
