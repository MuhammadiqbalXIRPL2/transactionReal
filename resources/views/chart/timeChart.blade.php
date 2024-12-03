<div class="card shadow">
    <div id="chart" class="card-body"></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

<script>
let chart;

function fetchData() {
    fetch('/timeChart')
        .then(response => response.json())
        .then(data => {
            const options = {
                chart: {
                    type: 'line',
                    height: 350,
                    animations: {
                        enabled: true,
                        easing: 'easeinout',
                        speed: 800,
                        animateGradually: {
                            enabled: true,
                            delay: 150
                        }
                    }
                },
                series: data.chartData,
                xaxis: {
                    categories: data.datesAndHours,
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

            if (!chart) {
                chart = new ApexCharts(document.querySelector("#chart"), options);
                chart.render();
            } else {
                chart.updateOptions({
                    series: data.chartData,
                    xaxis: {
                        categories: data.datesAndHours
                    }
                });
            }
        })
        .catch(error => console.error('Error fetching data:', error));
}

fetchData();

setInterval(fetchData, 60000);
</script>
