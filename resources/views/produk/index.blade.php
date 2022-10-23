 
 @extends('template.app')
 <link href="{{ asset('assets/css/sweetalert2.min.css') }}">
 @section('title', 'Produk')
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
            <h1 class="h3 mb-0 text-gray-800">Produk</h1>
            
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
                        <h6 class="m-0 font-weight-bold text-primary float-left mt-2">Data Produk</h6> 
                    </div>
                    <div class="col-sm-3 col-12" style="float: right;">
                        <a href="{{ url('produk/create') }}" class="btn btn-primary btn-icon-split float-right">
                            <span class="icon text-white-50">
                                <i class="fas fa-flag"></i>
                            </span>
                            <span class="text">Tambah Produk</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Foto</th>
                                <th>Nama</th>
                                <th>Deskripsi</th>
                                <th>Harga</th>
                                <th>ID</th>
                                <th style="width: 150px">Aksi</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                            @php $no = 1 @endphp

                            @foreach($data as $data) 
                            <tr> 
                                <td>{{$no++}}</td>  
                                <td><img src="/foto/{{ $data->foto }}" width="100px"></td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->deskripsi }}</td>
                                <td>Rp <span style="float:right">{{number_format($data->harga,0,",",".")}},-</span></td>
                                <td>{{ $data->id }}</td>
                                <td>
                                    <form action="{{ route('produk.destroy',$data->id) }}" method="POST"> 
                                        <a class="btn btn-primary" href="{{ route('produk.edit',$data->id) }}">Edit</a>
                                        @csrf
                                        @method('DELETE')  
                                        <button style="height: 40px;" type="submit" class="btn btn-danger konfirmasi-delete btn-sm" data-toggle="tooltip" data-nama ={{ $data->nama }} title='Delete' >Delete</button>
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
        <script src="{{ asset('assets/js/sweetalert.min.js') }}"></script>
        <script type="text/javascript">
            $('.konfirmasi-delete').click(function(event){
                var form =  $(this).closest("form");
                var nama = $(this).attr('data-nama');

                event.preventDefault();
                swal({
                    title: `Yakin Menghapus ${nama} ?`,
                    text: "Data dihapus permanen.",
                    icon: "warning",
                    type: "warning",
                    buttons: ["Batal","Iya!"],
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((willDelete) => {
                    if (willDelete) {
                        form.submit();
                    }
                });
            });

        </script>
  

</div>

 @endsection

 


 
 
