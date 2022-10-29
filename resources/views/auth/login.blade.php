@extends('template.auth')

@section('title', 'Login')

@section('content')
    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div
                                class="col-lg-6 d-none d-lg-block bg-login-image"style=" background-image: url('{{ asset('assets_landing/img/stats-bg.jpg') }}'); background-repeat: no-repeat; background-size: cover;">
                            </div>
                            <div class="col-lg-6">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Selamat Datang!</h1>
                                    </div>
                                    <form class="user" action="{{ url('/login') }}" method="POST">
                                        @csrf
                                        @if (session('status'))
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong>Maaf!</strong> {{ session('status') }}
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                        @if (session('success'))
                                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                                <strong>Berhasil!</strong> {{ session('success') }}
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                        <div class="form-group">
                                            <input type="email" class="form-control form-control-user" id="email"
                                                name="email" aria-describedby="emailHelp"
                                                placeholder="Enter Email Address..." tabindex="0" required>
                                        </div>
                                        <div class="form-group">
                                            <input type="password" class="form-control form-control-user" id="password"
                                                name="password" placeholder="Password" tabindex="1" required>
                                        </div>

                                        <button class="btn btn-primary btn-user btn-block" tabindex="2">Sign in</button>
                                    </form>
                                    <hr>

                                    <div class="text-center">
                                        <a class="small" href="{{ url('register') }}">Belum punya akun? Daftar Akun!</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
@endsection
