<div id="chart" class="card shadow"></div>
<div id="totalResponses" style="margin-top: 20px;"></div>

<script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
<script>
    let chart;

    function fetchData() {
        fetch('/realTimeChart')
            .then(response => response.json())
            .then(data => {
                const options = {
                    series: data.series, // Use totals for series
                    chart: {
                        type: 'pie',
                        height: 350,
                        responsive: [{
                            breakpoint: 480,
                            options: {
                                chart: { width: 250 },
                                legend: { position: 'bottom' }
                            }
                        }]
                    },
                    labels: data.labels, // Use response codes for labels
                    legend: {
                        position: 'right',
                        horizontalAlign: 'center'
                    },
                    title: {
                        text: 'Response Code Distribution',
                        align: 'center'
                    }
                };

                if (!chart) {
                    chart = new ApexCharts(document.querySelector("#chart"), options);
                    chart.render();
                } else {
                    chart.updateOptions(options);
                }

                const totalContainer = document.getElementById('totalResponses');
                const totalHtml = data.data.map(item =>
                    `<p>Response Code ${item.response_code}: ${item.total}</p>`
                ).join('');
                totalContainer.innerHTML = `<h4>Total per Response Code</h4>${totalHtml}`;
            })
            .catch(error => console.error('Error fetching chart data:', error));
    }

    fetchData();
    setInterval(fetchData, 60000);
</script>
