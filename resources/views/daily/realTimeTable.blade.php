<section class="container">
    <div class="row">
        <div class="col-12">
            <div class="card shadow">
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-striped font-sm table-sm" id="realTimeTable">
                            <thead>
                                <tr>
                                    <th>Type Transaksi</th>
                                    <th>Response Code</th>
                                    <th>Tanggal</th>
                                    <th>Response Message</th>
                                    <th class="overflow-hidden">URL</th>
                                </tr>
                            </thead>
                            <tbody>
                            </tbody>
                        </table>
                        
                        <nav>
                            <ul class="pagination-sm pagination justify-content-center" id="paginationControls"></ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    let currentPage = 1;

    // Fetch data for the table
    function fetchData(page = 1) {
        fetch(`/timeTable?page=${page}`, {
            method: 'GET',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        })
        .then(response => response.json())
        .then(data => {
            // Check if 'data.data' exists and is an array
            if (data && Array.isArray(data.data)) {
                console.log("Fetched table data:", data);

                const tableBody = document.querySelector("#realTimeTable tbody");
                tableBody.innerHTML = '';

                // Loop through the data and populate the table
                data.data.forEach(item => {
                    const row = `
                        <tr>
                            <td>${item.type_transaksi}</td>
                            <td>${item.response_code}</td>
                            <td>${item.timestamp}</td>
                            <td>${item.response_message || '-'}</td>
                            <td>${item.url || '-'}</td>
                        </tr>
                    `;
                    tableBody.innerHTML += row;
                });

                // Update the pagination controls
                updatePagination(data.current_page, data.last_page);
            } else {
                console.error('Data format error: data.data is not an array');
            }
        })
        .catch(error => {
            console.error('Error fetching table data:', error);
        });
    }

    // Update pagination controls
    function updatePagination(currentPage, totalPages) {
        const paginationControls = document.querySelector("#paginationControls");
        paginationControls.innerHTML = '';

        // Generate pagination links
        for (let i = 1; i <= totalPages; i++) {
            const isActive = i === currentPage ? 'active' : '';
            paginationControls.innerHTML += `
                <li class="page-item ${isActive}">
                    <a class="page-link" href="#" onclick="fetchData(${i})">${i}</a>
                </li>
            `;
        }
    }

    // Fetch the first page on load
    fetchData(currentPage);

    // Optionally refresh data every 15 seconds
    setInterval(() => fetchData(currentPage), 15000);
</script>

