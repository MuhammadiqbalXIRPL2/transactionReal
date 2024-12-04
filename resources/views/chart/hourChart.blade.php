<div class="card shadow w-full">

    <div id="requestsChart" class="card-body"></div>
</div>


<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
    let chart1;
    const chartContainer = document.querySelector("#requestsChart");

    function fetchChartData() {
        console.log('Fetching chart data...');
        fetch('/requestHours', {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log('Fetched data:', data);

            if (!data.hours || !data.totals || data.hours.length === 0 || data.totals.length === 0) {
                console.error("Data is empty or invalid");
                return;
            }

            const formattedHours = data.hours.map(hour => hour + ':00');
            console.log('Formatted hours:', formattedHours);
            console.log('Totals:', data.totals);

            if (!chart1) {
                const options = {
                    chart: {
                        type: 'bar',
                        height: 350
                    },
                    series: [{
                        name: 'Total Requests',
                        data: data.totals
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

                chart1 = new ApexCharts(chartContainer, options);
                chart1.render();
            } else {
                chart1.updateOptions({
                    series: [{
                        name: 'Total Requests',
                        data: data.totals
                    }],
                    xaxis: {
                        categories: formattedHours
                    }
                });
            }
        })
        .catch(error => {
            console.error('Error fetching data:', error);
        });
    }

    fetchChartData();

    setInterval(fetchChartData, 60000);
</script>
