<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $type }} - Toko Kue Ku</title>
    <link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{ asset('assets/css/sb-admin-2.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">
    <style type="text/css">
        body {
            background: #f2f2f2;
        }

        .payment {
            border: 1px solid #f2f2f2;
            border-radius: 20px;
            background: #fff;
        }

        .payment_header {
            padding: 20px;
            border-radius: 20px 20px 0px 0px;
        }

        .check {
            margin: 0px auto;
            width: 50px;
            height: 50px;
            border-radius: 100%;
            background: #fff;
            text-align: center;
        }

        .check i {
            vertical-align: middle;
            line-height: 50px;
            font-size: 30px;
        }

        .content {
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mx-auto mt-5">
                <div class="payment">
                    <div @class([
                        'payment_header',
                        'bg-success' => $type == 'Process',
                        'bg-warning' => $type == 'Unfinish',
                    ])>
                        <div class="check">
                            <i @class([
                                'fa fa-fw',
                                'text-success fa-check' => $type == 'Process',
                                'text-warning fa-times' => $type == 'Unfinish',
                            ]) aria-hidden="true"></i>
                        </div>
                    </div>
                    <div class="content py-4">
                        @if ($type == 'Process')
                            <h5>Pembayaran sedang diproses!</h5>
                            <small>{{ $message ?? 'Terima Kasih...' }}</small>
                        @endif
                        @if ($type == 'Unfinish')
                            <h5>Pembayaran belum diselesaikan!</h5>
                            <small>{{ $message ?? 'Mohon segera melakukan pembayaran!' }}</small>
                            @if (request()->has('order_id'))
                                <hr class="mt-3">
                                <a href="{{ route('order.pay', request('order_id')) }}"
                                    class="btn btn-sm btn-warning"><i class="fas fa-fw fa-credit-card"></i> Bayar
                                    Kembali</a>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
