{{-- 
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
                </div>
            </div>
        </div>
    </div>
</div> --}}
















<section class="container">
    <div class="row" id="realTimeData">
        <!-- Card for Total Transactions -->
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-stats">
                    <div class="card-stats-items" id="totalTransactions"></div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fa-solid fa-arrow-right-arrow-left" style="color: #ffffff;"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Transaksi (past week)</h4>
                    </div>
                    <div class="card-body" id="totalTransactionCard"></div>
                </div>
            </div>
        </div>

        <!-- Card for Total Transaction Types -->
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-stats">
                    <div class="card-stats-items" id="transactionTypes"></div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fa-solid fa-money-bill" style="color: #ffffff;"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Jenis Transaksi</h4>
                    </div>
                    <div class="card-body" id="transactionAmountCard"></div>
                </div>
            </div>
        </div>

        <!-- Card for Total Failed Responses -->
        <div class="col-lg-4 col-md-4 col-sm-12">
            <div class="card card-statistic-2">
                <div class="card-stats">
                    <div class="card-stats-items" id="failedResponses"></div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                    <i class="fa-solid fa-circle-exclamation" style="color: #ffffff;"></i>
                </div>
                <div class="card-wrap">
                    <div class="card-header">
                        <h4>Total Failed Respon</h4>
                    </div>
                    <div class="card-body" id="failedResponsesCard"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function fetchData() {
    fetch('/components', {
        method: 'GET',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        console.log('Fetched Data:', data);
        updateCards(data);
    })
    .catch(error => {
        console.error('Error fetching data:', error);
    });
}

function updateCards(data) {
    const totalTransactions = data.time.map(transaction => `
        <div class="card-stats-item">
            <div class="card-stats-item-count mt-3">${transaction.transaction_count}</div>
            <div class="card-stats-item-label">${transaction.date}</div>
        </div>
    `).join('');
    document.querySelector('#totalTransactions').innerHTML = totalTransactions;
    document.querySelector('#totalTransactionCard').textContent = data.weekly;

    let transactionTypes = data.transactionData.slice(0, 2).map(t => `
        <div class="card-stats-item">
            <div class="card-stats-item-count mt-3">${t.total}</div>
            <div class="card-stats-item-label">${t.type_transaksi}</div>
        </div>
    `).join('');

    if (data.transactionData.length > 3) {
        const dropdownItems = data.transactionData.slice(2).map(t => `
            <li class="dropdown-item">${t.total} (${t.type_transaksi})</li>
        `).join('');

        transactionTypes += `
            <div class="card-stats-item">
                <div class="card-stats-item-count mt-3 dropdown row">
                    <div class="card-stats-item-label">Other</div>
                    <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#"></a>
                    <ul class="dropdown-menu dropdown-menu-sm">
                        ${dropdownItems}
                    </ul>
                </div>
            </div>
        `;
    }

    document.querySelector('#transactionTypes').innerHTML = transactionTypes;
    document.querySelector('#transactionAmountCard').textContent = data.transactionAmount;




    let failedResponses = data.failed.slice(0, 3).map(t => `
        <div class="card-stats-item">
            <div class="card-stats-item-count mt-3">${t.total}</div>
            <div class="card-stats-item-label">${t.response_code}</div>
        </div>
    `).join('');

    if (data.failed.length > 3) {
        const dropdownItems2 = data.failed.slice(3).map(t => `
            <li class="dropdown-item">${t.total} (${t.response_code})</li>
        `).join('');

        failedResponses += `
            <div class="card-stats-item">
                <div class="card-stats-item-count mt-3 dropdown row">
                    <div class="card-stats-item-label">Other</div>
                    <a class="font-weight-600 dropdown-toggle" data-toggle="dropdown" href="#"></a>
                    <ul class="dropdown-menu dropdown-menu-sm">
                        ${dropdownItems2}
                    </ul>
                </div>
            </div>
        `;
    }




    // const failedResponses = data.failed.map(f => `
    //     <div class="card-stats-item">
    //         <div class="card-stats-item-count mt-3">${f.total}</div>
    //         <div class="card-stats-item-label">${f.response_code}</div>
    //     </div>
    // `).join('');
    document.querySelector('#failedResponses').innerHTML = failedResponses;
    document.querySelector('#failedResponsesCard').textContent = data.totalFailed;
}

fetchData();
setInterval(fetchData, 60000);

</script>
