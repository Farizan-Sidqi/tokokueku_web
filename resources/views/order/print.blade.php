<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice {{ $order->id }}</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <style>
        @media print {
            .btn {
                display: none;
            }
        }
    </style>
</head>
<body>
    <div class="container-fluid py-5">
        <div class="row">
            <div class="col-6">
                <h2>INVOICE</h2>
                <h5>No. {{ $order->id }}</h5>
                <button type="button" onclick="window.print()" class="btn btn-sm btn-outline-secondary">Print</button>
                <ul class="list-group list-group-flush mt-4">
                    <li class="list-group-item d-flex justify-content-between flex-wrap pl-0">
                        <strong>Tanggal Order</strong>
                        <span>{{ $order->tgl_order->format('d/m/Y H:i:s') }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between flex-wrap pl-0">
                        <strong>Nama Pelanggan</strong>
                        <span>{{ $order->user->nama }}</span>
                    </li>
                    <li class="list-group-item d-flex justify-content-between flex-wrap pl-0">
                        <strong>Catatan</strong>
                        <span>{{ $order->catatan ? $order->catatan : '-' }}</span>
                    </li>
                </ul>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-lg-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Makanan</th>
                            <th>Qty</th>
                            <th>Harga</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->orderDetail as $key => $detail)
                            <tr>
                                <td>{{ ++$key }}</td>
                                <td>{{ $detail->nama_makanan }}</td>
                                <td>{{ $detail->qty }}</td>
                                <td>Rp. {{number_format($detail->harga_total,0,",",".")}},-</td>
                            </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3" class="text-right">Total Harga :</th>
                            <td><b>Rp. {{number_format($order->total_harga,0,",",".")}},-</b></td>
                            {{-- <span style="float:right">Rp. {{number_format($order->total_harga,0,",",".")}},-</span> --}}
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <script>
        window.print();
    </script>
</body>
</html>