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

        $datesAndHours = array_keys($responseData); // Label waktu
    
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

    function cardChart()
    {

        $timeTrans = Transaction::selectRaw('
        DATE(timestamp) as Tanggal,
        COUNT(*) as TotalTransaksi
    ')
        ->groupByRaw('DATE(timestamp)')
        ->orderBy('Tanggal', 'asc')
        ->get();


        $card = DB::table('transactions')->count();
        $datas = DB::table('transactions')
            ->select('response_code', DB::raw('count(*) as total'))
            ->groupBy('response_code')
            ->get();

        $transInfo = DB::table('transactions')
            ->select('type_transaksi', DB::raw('count(*) as totalTran'))
            ->groupBy('type_transaksi')
            ->get();

        $datass = DB::table('transactions')
            ->whereNotIn('response_code', ['200'])
            ->get();

        $datass1 = DB::table('transactions')
            ->where('response_code', ['0000'])
            ->get();

        $datass3 = DB::table('transactions')
            ->where('response_code', ['GAGAL'])
            ->get();

        $datass4 = DB::table('transactions')
            ->where('response_code', ['1002'])
            ->get();

        $datass5 = DB::table('transactions')
            ->where('response_code', ['mbb1001'])
            ->get();

        $datass6 = DB::table('transactions')
            ->where('response_code', ['WS1002'])
            ->get();

        $datass7 = DB::table('transactions')
            ->where('response_code', ['ERROR'])
            ->get();

        $dataTrans = DB::table('transactions')
            ->where('type_transaksi', ['DANA'])
            ->get();

        $dataTrans2 = DB::table('transactions')
            ->where('type_transaksi', ['shopee'])
            ->get();

        $dataTrans3 = DB::table('transactions')
            ->where('type_transaksi', ['balance Inquiry'])
            ->get();

        $dataTrans4 = DB::table('transactions')
            ->where('type_transaksi', ['connect websocket'])
            ->get();

        $dataTrans5 = DB::table('transactions')
            ->where('type_transaksi', ['QRIS'])
            ->get();

        $dataTrans6 = DB::table('transactions')
            ->where('type_transaksi', ['ERRORWSCONNECT'])
            ->get();

        $infoTrans = $dataTrans->pluck('type_transaksi')->count();
        $infoTrans2 = $dataTrans2->pluck('type_transaksi')->count();
        $infoTrans3 = $dataTrans3->pluck('type_transaksi')->count();
        $infoTrans4 = $dataTrans4->pluck('type_transaksi')->count();
        $infoTrans5 = $dataTrans5->pluck('type_transaksi')->count();
        $infoTrans6 = $dataTrans6->pluck('type_transaksi')->count();
        $infoFailed = $datass1->pluck('response_code')->count();
        $infoFailed3 = $datass3->pluck('response_code')->count();
        $infoFailed4 = $datass4->pluck('response_code')->count();
        $infoFailed5 = $datass5->pluck('response_code')->count();
        $infoFailed6 = $datass6->pluck('response_code')->count();
        $infoFailed7 = $datass7->pluck('response_code')->count();

        $card2 = $datass->pluck('type_transaksi')->count();

        $card3 = $datas->pluck('response_code')->count();

        $AllTrans = $transInfo->pluck('type_transaksi')->count();

        $waktu = $timeTrans->count();


        return [
            'timeTrans' => $timeTrans,
            'waktu' => $waktu,
            'AllTrans' => $AllTrans,
            'transInfo' => $transInfo,
            'card' => $card,
            'card2' => $card2,
            'card3' => $card3,
            'infoTrans' => $infoTrans,
            'infoTrans2' => $infoTrans2,
            'infoTrans3' => $infoTrans3,
            'infoTrans4' => $infoTrans4,
            'infoTrans5' => $infoTrans5,
            'infoTrans6' => $infoTrans6,
            'infoFailed' => $infoFailed,
            'infoFailed' => $infoFailed,
            'infoFailed3' => $infoFailed3,
            'infoFailed4' => $infoFailed4,
            'infoFailed5' => $infoFailed5,
            'infoFailed6' => $infoFailed6,
            'infoFailed7' => $infoFailed7,
        ];
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
