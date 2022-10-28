<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
</head>

<body onload="pay()">
    <form action="{{ route('order.callback', $order) }}" method="POST" id="form-callback">
        @csrf
        <input type="hidden" name="callback" id="callback-input">
    </form>

    <script type="text/javascript">
        function pay() {
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    handleCallback(result);
                },
                onPending: function(result) {
                    handleCallback(result);
                },
                onError: function(result) {
                    handleCallback(result);
                },
                onClose: function() {
                    window.location.href = "{{ route('order.unfinish', ['order_id' => $order->id]) }}"
                }
            })
        }

        function handleCallback(params) {
            let response = JSON.stringify(params);

            const form = document.getElementById('form-callback');
            const input = document.getElementById('callback-input');
            input.value = response;

            form.submit()
        }
    </script>
</body>

</html>
