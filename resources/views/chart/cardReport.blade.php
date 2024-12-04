
<div class="row">
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-stats">
                <div class="card-stats-items">
                    @foreach (array_slice($chart4Data['timeTrans']->toArray(), 0, 2) as $transaction)
                        <div class="card-stats-item">
                            <div class="card-stats-item-count mt-3">{{ $transaction['TotalTransaksi'] }}</div>
                            <div class="card-stats-item-label">
                                {{ \Carbon\Carbon::parse($transaction['Tanggal'])->format('d M Y') }}
                            </div>
                        </div>
                    @endforeach
                    @if (count($chart4Data['timeTrans']) > 2)
                        <div class="card-stats-item">
                            <div class="card-stats-item-count mt-3 dropdown row">
                                <div class="card-stats-item-label">Other</div>
                                <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#"></a>
                                <ul class="dropdown-menu dropdown-menu-sm">
                                    @foreach (array_slice($chart4Data['timeTrans']->toArray(), 2) as $transaction)
                                        <li class="dropdown-item">
                                            {{ $transaction['TotalTransaksi'] }} 
                                            ({{ \Carbon\Carbon::parse($transaction['Tanggal'])->format('d M Y') }})
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
                
                
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fa-solid fa-arrow-right-arrow-left" style="color: #ffffff;"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Transaksi</h4>
                    </div>
                    <div class="card-body">{{ $chart4Data['card'] }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-stats">
                <div class="card-stats-items">
                    <div class="card-stats-item">
                        <div class="card-stats-item-count mt-3">{{ $chart4Data['infoTrans'] }}</div>
                        <div class="card-stats-item-label">DANA</div>
                    </div>
                    <div class="card-stats-item">
                        <div class="card-stats-item-count mt-3">{{ $chart4Data['infoTrans2'] }}</div>
                        <div class="card-stats-item-label">shopee</div>
                    </div>
                    <div class="card-stats-item">
                        <div class="card-stats-item-count mt-3 dropdown row">
                            <div class="card-stats-item-label">Other</div>
                            <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#"></a>
                            <ul class="dropdown-menu dropdown-menu-sm">         
                                <li class="dropdown-item">{{ $chart4Data['infoTrans3'] }} (balance Inquiry)</li>         
                                <li class="dropdown-item">{{ $chart4Data['infoTrans4'] }} (connect websocket)</li>         
                                <li class="dropdown-item">{{ $chart4Data['infoTrans5'] }} (QRIS)</li>         
                                <li class="dropdown-item">{{ $chart4Data['infoTrans6'] }} (ERRORWSCONNECT)</li>         
                            </ul>
                        </div>
                        <div class="card-stats-item-label"></div>
                    </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fa-solid fa-money-bill" style="color: #ffffff;"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Jenis Transaksi</h4>
                    </div>
                    <div class="card-body">{{ $chart4Data['AllTrans'] }}</div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12">
        <div class="card card-statistic-2">
            <div class="card-stats">
                <div class="card-stats-items">
                    <div class="card-stats-item">
                        <div class="card-stats-item-count mt-3">{{ $chart4Data['infoFailed'] }}</div>
                        <div class="card-stats-item-label">0000</div>
                    </div>
                    <div class="card-stats-item">
                        <div class="card-stats-item-count mt-3">{{ $chart4Data['infoFailed3'] }}</div>
                        <div class="card-stats-item-label">GAGAL</div>
                    </div>
                    <div class="card-stats-item">
                        <div class="card-stats-item-count mt-3 dropdown row">
                            <div class="card-stats-item-label">Other</div>
                            <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#"></a>
                            <ul class="dropdown-menu dropdown-menu-sm">         
                                <li class="dropdown-item">{{ $chart4Data['infoFailed4'] }} (1002)</li>         
                                <li class="dropdown-item">{{ $chart4Data['infoFailed5'] }} (mbb1001)</li>         
                                <li class="dropdown-item">{{ $chart4Data['infoFailed6'] }} (WS1002)</li>         
                                <li class="dropdown-item">{{ $chart4Data['infoFailed7'] }} (ERROR)</li>         
                            </ul>
                        </div>
                        <div class="card-stats-item-label"></div>
                    </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fa-solid fa-circle-exclamation" style="color: #ffffff;"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Failed Respon</h4>
                    </div>
                    <div class="card-body">{{ $chart4Data['card2'] }}</div>
                    <div class="card-body">{{ $chart4Data['card2'] }}</div>
                </div>
            </div>
        </div>
    </div>
</div>
