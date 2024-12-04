<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{

    function index()
    {
        // $chart1Data = $this->timeChart();
        $chart2Data = $this->response();
        // $chart3Data = $this->hoursChart();
        // dd($chart1Data);
        // return view('chart.mainChart', compact('chart2Data'));
        $chart3Data = $this->hoursChart();
        // $chart4Data = $this->cardChart();
        return view('chart.mainChart', compact('chart2Data'));
    }

    public function timeChart()
    {
        $data2 = Transaction::selectRaw('
            DATE_FORMAT(timestamp, "%Y-%m-%d %H:00:00") as date_hour, 
            response_code, 
            COUNT(*) as count
        ')
            ->groupByRaw('DATE_FORMAT(timestamp, "%Y-%m-%d %H:00:00"), response_code')
            ->orderBy('date_hour', 'asc')
            ->get();

        $responseData = [];
        foreach ($data2 as $item) {
            $responseData[$item->date_hour][$item->response_code] = $item->count;
        }

        $datesAndHours = array_keys($responseData);
        $responseCodes = Transaction::select('response_code')->distinct()->get();
        $chartData = [];

        foreach ($responseCodes as $responseCode) {
            $counts = [];
            foreach ($datesAndHours as $dateHour) {
                $counts[] = isset($responseData[$dateHour][$responseCode->response_code])
                    ? $responseData[$dateHour][$responseCode->response_code]
                    : 0;
            }
            $chartData[] = [
                'name' => $responseCode->response_code,
                'data' => $counts,
            ];
        }

        // return [
        //     'datesAndHours' => $datesAndHours,
        //     'chartData' => $chartData,
        // ];

        return response()->json([
            'datesAndHours' => $datesAndHours,
            'chartData' => $chartData,
        ]);
    }



    public function response()
    {
        $data = DB::table('transactions')
            ->select('response_code', DB::raw('count(*) as total'))
            ->groupBy('response_code')
            ->get();

        $labels = $data->pluck('response_code');
        $counts = $data->pluck('total');
        // dd($labels, $counts);
        return [
            'labels' => $labels,
            'counts' => $counts,
        ];
    }

    public function hoursChart()
    {
        $data5 = Transaction::selectRaw('
           HOUR(timestamp) as hour, 
           COUNT(*) as total_requests
        ')
            ->groupByRaw('HOUR(timestamp)')
            ->orderBy('hour', 'asc')
            ->get();

        $hours = $data5->pluck('hour');
        $totals = $data5->pluck('total_requests');

        // dd($hours, $totals);
        return response()->json([
            'hours' => $hours,
            'totals' => $totals
        ]);
    }



    public function components()
    {
        $time = DB::table('transactions')
            ->select(DB::raw('DATE_FORMAT(timestamp, "%d %b") as date'), DB::raw('COUNT(id) as transaction_count'))
            ->groupBy(DB::raw('DATE_FORMAT(timestamp, "%d %b")'))
            ->orderByRaw('MAX(timestamp) DESC')
            ->take(7)
            ->get();

        $weekly = Transaction::where('timestamp', '>=', Carbon::now()->subWeek())
            ->count();

        $transactionData = DB::table('transactions')
            ->select('type_transaksi', DB::raw('COUNT(*) as total'))
            ->groupBy('type_transaksi')
            ->get();

        $transactionAmount = DB::table('transactions')
            ->select('type_transaksi')
            ->distinct()
            ->count('type_transaksi');

        $except = ['200', '404'];
        $failed = DB::table('transactions')
            ->select('response_code', DB::raw('COUNT(*) as total'))
            ->whereNotIn('response_code', $except)
            ->groupBy('response_code')
            ->get();

        $totalFailed = $failed->sum('total');

        // dd($time, $transaction, $transactionAmount, $failed, $transactionData);

        return response()->json([
            'time' => $time,
            'weekly' => $weekly,
            'transactionAmount' => $transactionAmount,
            'failed' => $failed,
            'transactionData' => $transactionData,
            'totalFailed' => $totalFailed
        ]);
    }



    public function store(Request $request)
    {
        try {
            $validatedData = $request->validate([
                'type_transaksi' => 'required|string',
                'response_code' => 'required|string',
                'url' => 'required|url',
                'response_message' => 'nullable|string',
            ]);

            $data = new Transaction([
                'type_transaksi' => $validatedData['type_transaksi'],
                'response_code' => $validatedData['response_code'],
                'url' => $validatedData['url'],
                'response_message' => $validatedData['response_message'],
                'timestamp' => Carbon::now(),
            ]);

            $data->save();

            return response()->json(['message' => 'Insert success'], 201);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to insert data', 'message' => $e->getMessage()], 500);
        }
    }
}
