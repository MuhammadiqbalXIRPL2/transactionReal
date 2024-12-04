<div class="card shadow w-full">
    <div class="card-body">
        <canvas id="responseChart" style="width: 100%; height: auto;"></canvas>
    </div>
</div>


<script>
    const labels = @json($chart2Data['labels']);
    const counts = @json($chart2Data['counts']);

    const ctx11 = document.getElementById('responseChart').getContext('2d');
    new Chart(ctx11, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: 'Jumlah Transaksi',
                data: counts,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.7)',
                    'rgba(75, 192, 192, 0.7)',
                    'rgba(255, 205, 86, 0.7)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(75, 192, 192, 1)',
                    'rgba(255, 205, 86, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                },
                title: {
                    display: true,
                    text: 'Jumlah Transaksi per Response Code'
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
</script>