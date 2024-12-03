<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    function index() {
        // $chart1Data = $this->timeChart();
        $chart2Data = $this->response();
        // $chart3Data = $this->hoursChart();
        // dd($chart1Data);
        // return view('chart.mainChart', compact('chart2Data'));
        $chart3Data = $this->hoursChart();
        $chart4Data = $this->cardChart();
        return view('chart.mainChart', compact('chart2Data', 'chart4Data'));
    }

    public function timeChart() {
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
    
    

    public function response() {
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

    public function hoursChart () {
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

    function cardChart() {
        $card = DB::table('transactions')->count();
        $datas = DB::table('transactions')            
            ->select('response_code', DB::raw('count(*) as total'))
            ->groupBy('response_code')
            ->get();

        $datass = DB::table('transactions')
            ->whereNotIn('response_code', ['Sukses'])
            ->get();

        $card2 = $datass->pluck('response_code')->count();

        $card3 = $datas->pluck('response_code')->count();

        return [
            'card' => $card,
            'card2' => $card2,
            'card3' => $card3,
        ];
    }


    

    // test for realtime

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
