<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DailyController extends Controller
{
    public function daily()
    {
        return view('daily.daily');
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
        $threeHoursAgo = now()->subHours(3);

        $transactionCounts = Transaction::where('created_at', '>=', $threeHoursAgo)
            ->selectRaw('DATE_FORMAT(created_at, "%H:%i") as minute, COUNT(*) as count')
            ->groupBy('minute')
            ->get();

        $totalCount = $transactionCounts->sum('count');

        return response()->json([
            'data' => $transactionCounts,
            'count' => $totalCount,
            'timestamp' => now()->toDateTimeString(),
        ]);
    }
}
