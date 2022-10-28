 @extends('template.app')
 <link href="{{ asset('assets/css/sweetalert2.min.css') }}">
 @section('title', 'Order Pelanggan')
 @section('content')

     <div id="content">

         <!-- Topbar -->
         <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
             @include('template.partials._topbar')
         </nav>
         <!-- End of Topbar -->

         <!-- Begin Page Content -->
         <div class="container-fluid">

             <!-- Page Heading -->
             <div class="d-sm-flex align-items-center justify-content-between mb-4">
                 <h1 class="h3 mb-0 text-gray-800">Detail Order </h1>

             </div>

             @if ($message = Session::get('success'))
                 <div class="alert alert-success">
                     <p>{{ $message }}</p>
                 </div>
             @endif
             {{-- datatable --}}
             <div class="card shadow mb-4">
                 <div class="card-header py-3">
                     <div class="row">
                         <div class="col-sm-9 col-12">
                             <h6 class="m-0 font-weight-bold text-primary float-left mt-2">Data Order : </h6>
                         </div>
                     </div>
                 </div>

                 <div class="card-body">
                     <div class="row mb-3">
                         <div class="col-lg-6">
                             <ul class="list-group list-group-flush">
                                 <li class="list-group-item d-flex justify-content-between flex-wrap pl-0">
                                     <strong>Nomor Pesanan</strong>
                                     <span>{{ $order->id }}</span>
                                 </li>
                                 <li class="list-group-item d-flex justify-content-between flex-wrap pl-0">
                                     <strong>Tanggal Order</strong>
                                     <span>{{ $order->tgl_order }}</span>
                                 </li>
                                 <li class="list-group-item d-flex justify-content-between flex-wrap pl-0">
                                     <strong>Nama Pelanggan</strong>
                                     <span>{{ $order->user->nama }}</span>
                                 </li>
                                 <li class="list-group-item d-flex justify-content-between flex-wrap pl-0">
                                     <strong>Total Item</strong>
                                     <span>{{ $order->total_qty }}</span>
                                 </li>
                                 <li class="list-group-item d-flex justify-content-between flex-wrap pl-0">
                                     <strong>Total Bayar</strong>
                                     <span style="float:right">Rp.
                                         {{ number_format($order->total_harga, 0, ',', '.') }},-</span>
                                 </li>
                                 <li class="list-group-item d-flex justify-content-between flex-wrap pl-0">
                                     <strong>Catatan</strong>
                                     <span>{{ $order->catatan ? $order->catatan : '-' }}</span>
                                 </li>
                             </ul>
                         </div>
                     </div>

                     <div class="table-responsive">
                         <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                             <thead>
                                 <tr>
                                     <th>No</th>
                                     <th>Nama Makanan</th>
                                     <th>Harga per item</th>
                                     <th>Qty</th>
                                     <th>Total</th>

                                 </tr>
                             </thead>

                             <tbody>

                                 @php $no = 1 @endphp

                                 @foreach ($order->orderDetail as $data)
                                     <tr>
                                         <td>{{ $no++ }}</td>
                                         <td>{{ $data->nama_makanan }}</td>
                                         <td>Rp. <span
                                                 style="float:right">{{ number_format($data->harga_makanan, 0, ',', '.') }},-</span>
                                         </td>
                                         <td>{{ $data->qty }}</td>
                                         <td>Rp. <span
                                                 style="float:right">{{ number_format($data->harga_total, 0, ',', '.') }},-</span>
                                         </td>


                                     </tr>
                                     </tr>
                                 @endforeach
                             </tbody>
                         </table>
                     </div>
                 </div>
             </div>


         </div>
         <!-- /.container-fluid -->
         <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
         <!--<script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>-->
         <!--<script type="text/javascript">
             -- >
             <
             !--$('.konfirmasi-delete').click(function(event) {
                 -- >
                 <
                 !--
                 var form = $(this).closest("form");
                 -- >
                 <
                 !--
                 var nama = $(this).attr('data-nama');
                 -- >

                 <
                 !--event.preventDefault();
                 -- >
                 <
                 !--swal({
                     -- >
                     <
                     !--title: `Yakin Menghapus ${nama} ?`,
                     -- >
                     <
                     !--text: "Data dihapus permanen.",
                     -- >
                     <
                     !--icon: "warning",
                     -- >
                     <
                     !--type: "warning",
                     -- >
                     <
                     !--buttons: ["Batal", "Iya!"],
                     -- >
                     <
                     !--confirmButtonColor: '#3085d6',
                     -- >
                     <
                     !--cancelButtonColor: '#d33',
                     -- >
                     <
                     !--confirmButtonText: 'Yes, delete it!'-- >
                         <
                         !--
                 }).then((willDelete) => {
                     -- >
                     <
                     !--
                     if (willDelete) {
                         -- >
                         <
                         !--form.submit();
                         -- >
                         <
                         !--
                     }-- >
                     <
                     !--
                 });
                 -- >
                 <
                 !--
             });
             -- >

             <
             !--
         </script>-->


     </div>

 @endsection
