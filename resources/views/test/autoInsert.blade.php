<script>
    function getRandomInt(min, max) {
        return Math.floor(Math.random() * (max - min + 1)) + min;
    }

    function getRandomTransactionType() {
        const types = ['purchase', 'refund', 'payment', 'withdrawal', 'transfer'];
        return types[getRandomInt(0, types.length - 1)];
    }

    function getRandomResponseCode() {
        const codes = ['200', '400', '404', '500', '502'];
        return codes[getRandomInt(0, codes.length - 1)];
    }

    function getRandomUrl() {
        const urls = [
            'https://example.com/api/purchase',
            'https://example.com/api/refund',
            'https://example.com/api/payment',
            'https://example.com/api/withdrawal',
            'https://example.com/api/transfer'
        ];
        return urls[getRandomInt(0, urls.length - 1)];
    }

    function getRandomResponseMessage() {
        const messages = [
            'Transaction completed successfully',
            'Transaction failed due to server error',
            'Page not found',
            'Bad request, please check your input',
            'Server is temporarily unavailable'
        ];
        return messages[getRandomInt(0, messages.length - 1)];
    }

    function generateRandomData() {
        return {
            type_transaksi: getRandomTransactionType(),
            response_code: getRandomResponseCode(),
            url: getRandomUrl(),
            response_message: getRandomResponseMessage(),
        };
    }


    function autoInsertData() {
        const randomData = generateRandomData();

        fetch('/transaksi', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify(randomData),
            })
            .then(response => response.json())
            .then(data => {
                console.log(data.message);
            })
            .catch(error => {
                console.error('Error:', error);
            });
    }

    setInterval(autoInsertData, 180000);

    autoInsertData();
</script>