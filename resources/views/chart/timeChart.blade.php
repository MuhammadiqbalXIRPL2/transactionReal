<div class="card shadow">
    <div id="chart" class="card-body"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    var chartData = @json($chart1Data['chartData']);
    var datesAndHours = @json($chart1Data['datesAndHours']);

    var options = {
        chart: {
            type: 'line',
            height: 350
        },
        series: chartData,
        xaxis: {
            categories: datesAndHours,
            title: {
                text: 'Date and Hour'
            }
        },
        yaxis: {
            title: {
                text: 'Total Responses'
            }
        },
        title: {
            text: 'Total Response Codes per Date and Hour',
            align: 'center'
        },
        tooltip: {
            shared: true,
            intersect: false
        }
    };

    var chart = new ApexCharts(document.querySelector("#chart"), options);
    chart.render();
</script>
