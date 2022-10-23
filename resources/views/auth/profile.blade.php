 
 @extends('template.app')
 
 @section('title','Profile Pengguna')
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
            <h1 class="h3 mb-0 text-gray-800">Profile Pengguna</h1>
            
        </div>    
        
        <div class="container rounded bg-white mt-5 mb-5">
            <form class="form" method="POST" action="{{ route('user.profile-update') }}" enctype="multipart/form-data" >
                @csrf
                @method('PATCH')
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
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Berhasil!</strong> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-3 border-right">
                        <div class="d-flex flex-column align-items-center text-center p-3 py-5">
                            <img class="rounded-circle mt-5" width="150px" src="/user_foto/{{ auth()->user()->foto }}">
                            <span class="font-weight-bold">{{ auth()->user()->nama }}</span>
                            <span class="text-black-50">{{ auth()->user()->email }}</span>
                            <span> </span>
                        </div>
                    </div>
                    <div class="col-md-5 border-right">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h4 class="text-right">Profile Settings</h4>
                            </div>
                            <div class="row mt-3">
                                <div class="col-md-12 mt-1"><label class="labels"><strong>Nama</strong></label><input type="text" name="nama" class="form-control" placeholder="Nama Lengkap" value="{{ auth()->user()->nama }}"></div>
                                <div class="col-md-12 mt-1"><label class="labels"><strong>Alamat</strong></label><input type="text" name="alamat" class="form-control" placeholder="Alamat" value="{{ auth()->user()->alamat }}"></div>
                                <div class="col-md-12 mt-1"><label class="labels"><strong>Email</strong></label><input type="email" name="email" class="form-control" placeholder="email" value="{{ auth()->user()->email }}"></div>
                                <div class="col-md-12 mt-1"><label class="labels"><strong>Nomor WhatApp</strong></label><input type="text" name="no_wa" class="form-control" placeholder="Nomor WhatApp Aktif" value="{{ auth()->user()->no_wa }}"></div>
                                <div class="col-md-12 mt-1"><label class="labels"><strong>Photo</strong></label><input type="file" name="foto" class="form-control" placeholder="Foto" value="{{ auth()->user()->foto }}"></div>
                            </div>
                           
                            <div class="mt-5 text-center">
                                <a style="width: 130px" class="btn btn-primary" href="{{ url('/beranda') }}">Batal</a>
                                <button type="submit" class="btn btn-primary">Update Profile</button>
                            </div>
                             
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="p-3 py-5">
                            <div class="d-flex justify-content-between align-items-center experience"><span>Informasi</span><span class="border px-3 p-1 add-experience"><i class="fa fa-plus"></i>&nbsp;Terakhir</span></div><br>
                            <div class="col-md-12"><label class="labels">Pendaftaran Akun</label><input type="text" class="form-control" placeholder="experience" value="{{ auth()->user()->created_at->format('d-m-Y H:i:s') }}" disabled></div> <br>
                            <div class="col-md-12"><label class="labels">Pembaruan Akun</label><input type="text" class="form-control" placeholder="additional details" value="{{ auth()->user()->updated_at->format('d-m-Y H:i:s') }}" disabled></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
       
       
    </div>
    <!-- /.container-fluid -->

 </div>

 @endsection
