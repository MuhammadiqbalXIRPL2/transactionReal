<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    function index() {
        $chart1Data = $this->timeChart();
        $chart2Data = $this->response();

        return view('chart.mainChart', compact('chart1Data', 'chart2Data'));
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
                $counts[] = isset($responseData[$dateHour][$responseCode->response_code]) ? $responseData[$dateHour][$responseCode->response_code] : 0;
            }
            $chartData[] = [
                'name' => $responseCode->response_code,
                'data' => $counts,
            ];
        }

        return [
            'datesAndHours' => $datesAndHours,
            'chartData' => $chartData,
        ];
    }

    public function response() {
        $data = DB::table('transactions')
            ->select('response_code', DB::raw('count(*) as total'))
            ->groupBy('response_code')
            ->get();

        $labels = $data->pluck('response_code');
        $counts = $data->pluck('total');

        return [
            'labels' => $labels,
            'counts' => $counts,
        ];
    }
}
