<section class="container">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped" id="realTimeTable">
                            <thead>
                                <tr>
                                    <th>No Transaksi</th>
                                    <th>Type Transaksi</th>
                                    <th>Response Code</th>
                                    <th>Tanggal</th>
                                    <th>Response Message</th>
                                    <th style="display: none;">URL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <!-- Rows will be inserted dynamically -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function fetchData() {
            fetch('/timeTable', {
                method: 'GET',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                }
            })
                .then(response => response.json())
                .then(data => {
                    console.log("Fetched table data:", data);

                    const tableBody = document.querySelector("#realTimeTable tbody");
                    tableBody.innerHTML = '';

                    data.table.forEach((item, index) => {
                        const row = `
                            <tr>
                                <td>${index + 1}</td>
                                <td>${item.type_transaksi}</td>
                                <td>${item.response_code}</td>
                                <td>${item.timestamp}</td>
                                <td>${item.response_message || '-'}</td>
                                <td style="display: none;">${item.url || '-'}</td>
                            </tr>
                        `;
                        tableBody.innerHTML += row;
                    });
                })
                .catch(error => {
                    console.error('Error fetching table data:', error);
                });
        }

        fetchData();
        setInterval(fetchData, 15000);
    </script>
</section>
