
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
            <h1 class="h3 mb-0 text-gray-800">Order Pelanggan</h1>

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
                        <h6 class="m-0 font-weight-bold text-primary float-left mt-2">Data Order</h6>
                    </div>
                    {{-- <div class="col-sm-3 col-12" style="float: right;">
                        <a href="{{ url('order/update') }}" class="btn btn-primary btn-icon-split float-right">
                            <span class="icon text-white-50">
                                <i class="fas fa-flag"></i>
                            </span>
                            <span class="text">Tambah Produk</span>
                        </a>
                    </div> --}}
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal Order</th>
                                <th>Status Order</th>
                                <th>Catatan</th>
                                <th>Nama</th>
                                <th>Nomor WhatApp</th>
                                <th>Alamat Antar</th>
                                <th>Total Harga</th>
                                <th>Jumlah Item</th>
                                <th style="width: 50px">Aksi</th>
                            </tr>
                        </thead>

                        <tbody>

                            @php $no = 1 @endphp

                            @foreach($data as $data)
                            <tr>
                                <td>{{$no++}}</td>
                                <td>{{ $data->tgl_order }}</td>
                                <td>{{ $data->status }}</td>
                                <td>{{ $data->catatan }}</td>
                                <td>{{ $data->user->nama }}</td>
                                <td>{{ $data->user->no_wa }}</td>
                                <td>{{ $data->alamat_antar }}</td>
                                <td>Rp <span style="float:right">{{number_format($data->total_harga,0,",",".")}},-</span></td>
                                <td>{{ $data->total_qty }}</td>
                                <td>
                                    <form action="#" method="POST">
                                        <a style="width: 60px; height:30px ;" class="btn btn-sm btn-primary" href="{{ route('order.show',$data->id) }}">Show</a>
                                        @csrf
                                        {{-- @method('DELETE')
                                        <button style="height: 40px;" type="submit" class="btn btn-danger konfirmasi-delete btn-sm mt-1" data-toggle="tooltip" data-nama ={{ $data->nama }} title='Delete' >Detail</button> --}}
                                        @can('isAdmin')
                                        <button style="width: 60px; height:30px ;" data-id="{{ $data->id }}" data-status="{{ $data->status }}" type="button" class="btn-ubah-status btn btn-sm btn-warning mt-1">Status</button>
                                        @endcan
                                        <a style="width: 60px; height:30px ;" href="{{ route('order.print', $data->id) }}" class="btn btn-sm btn-outline-secondary mt-1" target="_blank">Print</a>
                                    </form>

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
        <script type="text/javascript">

            $('.btn-ubah-status').on('click', function() {
                const id = $(this).attr('data-id');
                const status = $(this).attr('data-status');
                const url = `/order/${id}/update-status`;
                const modal = $('#modalStatus');

                modal.find('form').attr('action', url);
                modal.find('select[name="status"]').val(status);

                modal.modal('show');
            });

        </script>


</div>

<!-- Modal -->
<div class="modal fade" id="modalStatus" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <form action="" method="POST">
            @csrf
            @method('PATCH')

            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Update Status</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="status">Status</label>
                    <select name="status" class="form-control">
                        <option value="dipesankan">Dipesankan</option>
                        <option value="dimasak">Dimasak</option>
                        <option value="dikirim">Dikirim</option>
                        <option value="selesai">Selesai</option>
                        <option value="batal">Batal</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
              <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </form>
      </div>
    </div>
  </div>
 @endsection






