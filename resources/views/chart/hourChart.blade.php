<div class="shadow">
    <div class="card" id="requestChart"></div>
</div>


<script>
    var hours = @json($hours);
    var totals = @json($totals);

    var formattedHours = hours.map(function(hour) {
        return hour + ':00';
    });

    var options = {
        chart: {
            type: 'bar',
            height: 350
        },
        series: [{
            name: 'Total Requests',
            data: totals
        }],
        xaxis: {
            categories: formattedHours,
            title: {
                text: 'Hour of the Day'
            }
        },
        yaxis: {
            title: {
                text: 'Number of Requests'
            }
        },
        title: {
            text: 'Number of Requests per Hour',
            align: 'center'
        }
    };

    var chart = new ApexCharts(document.querySelector("#requestsChart"), options);
    chart.render();
</script>