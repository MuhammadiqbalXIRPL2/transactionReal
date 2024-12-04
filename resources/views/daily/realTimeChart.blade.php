<div>
    <h4>Real-Time Transaction Count</h4>
    <p>Current Time: <span id="currentTime">--:--</span></p>
    <p>Total Transactions (Last 3 Hours): <span id="transactionCount">0</span></p>
</div>
<div id="chart" class="shadow card"></div>

<script>
    const data = [];
    const XAXISRANGE = 3 * 60 * 60 * 1000;

    const chart = new ApexCharts(document.querySelector("#chart"), {
    series: [{ data: data }],
    chart: {
        id: 'realtime',
        type: 'line',
        height: 350,
        animations: {
            enabled: true,
            easing: 'linear',
            dynamicAnimation: { speed: 1000 }
        },
        zoom: { enabled: false }
    },
    xaxis: { type: 'datetime' },
    yaxis: {
        min: 0,
        max: 100,
        forceNiceScale: true,
        labels: {
            offsetX: -10 // Mengatur jarak label dari garis
        }
    },
    stroke: { curve: 'smooth' },
    grid: {
        padding: {
            left: 20, // Tambahkan padding kiri
            right: 20 // Tambahkan padding kanan
        }
    }
});
chart.render();


    async function fetchChartData() {
        try {
            const response = await fetch('/realTimeChart', {
                headers: { 'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content }
            });
            const result = await response.json();

            const currentTime = new Date();
            document.getElementById('currentTime').textContent = currentTime.toLocaleTimeString([], { hour: '2-digit', minute: '2-digit' });
            document.getElementById('transactionCount').textContent = result.count;
            const currentTimestamp = currentTime.getTime();
            data.push({ x: currentTimestamp, y: result.count });

            const filteredData = data.filter(point => point.x >= currentTimestamp - XAXISRANGE);

            chart.updateSeries([{ data: filteredData }]);
        } catch (error) {
            console.error('Error fetching chart data:', error);
        }
    }

    fetchChartData();
    setInterval(fetchChartData, 15000);
</script>
