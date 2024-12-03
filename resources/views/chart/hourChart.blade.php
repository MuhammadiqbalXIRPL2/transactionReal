
<div class="card shadow">
    <div class="card-body">
        <div class="card" id="requestsChart"></div>
    </div>
</div>

<script>
    var hours = @json($chart3Data['hours']);
    var totals = @json($chart3Data['totals']);

    if (hours.length === 0 || totals.length === 0) {
        console.error("Data is empty or invalid");
    }

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
        },
        tooltip: {
            shared: true,
            intersect: false
        }
    };

    var chart = new ApexCharts(document.querySelector("#requestsChart"), options);
    chart.render();
</script>
