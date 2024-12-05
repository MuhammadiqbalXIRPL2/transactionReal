<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DailyController extends Controller
{
    public function daily()
    {
        return view('daily.daily');
    }

    public function realTimeTable()
{
    $table = Transaction::whereNotIn('response_code', ['200'])
        ->orderBy('timestamp', 'desc')
        ->paginate(5);

    return response()->json($table);
}



    public function realTimeChart()
{
    $data = DB::table('transactions')
        ->select('response_code', DB::raw('COUNT(*) as total'))
        ->groupBy('response_code')
        ->get();

    $response_codes = $data->pluck('response_code');
    $totals = $data->pluck('total');

    return response()->json([
        'labels' => $response_codes,
        'series' => $totals,
    ]);
}

    
}
