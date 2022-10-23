 
 @extends('template.app')
 
 
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

        <div class="card">
            <div class="card-header">Form Produk Baru</div>
            <div class="card-body">
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <strong>Whoops!</strong> Sepertinya ada beberapa masalah dengan inputan mu.<br><br>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                        
                    <form action="{{ route('produk.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label text-right"><strong>Nama Produk</strong></label>
                            <div class="col-sm-10">
                                <input type="text" name="nama" class="form-control" placeholder="Nama Produk">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label text-right "><strong>Deskripsi</strong></label>
                            <div class="col-sm-10">
                                <textarea class="form-control" style="height:70px" name="deskripsi" placeholder="Detail"></textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label text-right "><strong>Foto</strong></label>
                            <div class="col-sm-10">
                                <input type="file" name="foto" class="form-control" placeholder="foto">
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="nama" class="col-sm-2 col-form-label text-right "><strong>Harga</strong></label>
                            <div class="col-sm-10">
                                <input type="text" name="harga" class="form-control " placeholder="Harga" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-12 col-md-12 text-center">
                            
                                <a style="width: 80px" class="btn btn-primary" href="{{ url('produk')}}">Batal</a>
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                        
                    </form>
                </div>
                
            </div>
            <div class="card-footer"> </div>
        </div>
       

    </div>
    <!-- /.container-fluid -->

</div>

 @endsection
