@extends('template.auth')

@section('title', 'Register')

@section('content')

<div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
        <div class="card-body p-0">
            <!-- Nested Row within Card Body -->
            <div class="row">
                <div class="col-lg-5 d-none d-lg-block " style=" background-image: url('https://farizan.my.id/user_foto/login.jpg'); background-repeat: no-repeat; background-size: cover;"></div>
                <div class="col-lg-7">
                    <div class="p-5">
                        <div class="text-center">
                            <h1 class="h4 text-gray-900 mb-4">Buat Akun!</h1>
                        </div>
                        <form class="user" method="POST" action="{{ url('/register') }}">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="nama" name="nama"
                                    placeholder="Nama" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control form-control-user" id="alamat" name="alamat"
                                    placeholder="Alamat" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control form-control-user" id="email" name="email"
                                    placeholder="Email" required>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="text" class="form-control form-control-user"
                                        id="username" name ="username" placeholder="Username" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user"
                                        id="no_wa" name="no_wa"  placeholder="Nomor WhatApp Aktif" required>
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-sm-6 mb-3 mb-sm-0">
                                    <input type="password" class="form-control form-control-user"
                                        id="password" name ="password" placeholder="Password" required>
                                </div>
                                <div class="col-sm-6">
                                    <input type="password" class="form-control form-control-user"
                                        id="exampleRepeatPassword" placeholder="Ulangi Password" required>
                                </div>
                            </div>
                            <button class="btn btn-primary btn-user btn-block" >Daftar</button>

                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="small" href="{{ url('login') }}">Sudah punya akun? Login!</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection
