
 @extends('template.app')
 @section('title', 'User')

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
            <h1 class="h3 mb-0 text-gray-800">User</h1>

        </div>


        {{-- datatable --}}
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Data User</h6>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Email</th>
                                <th>Nomor What App</th>
                                <th>Alamat</th>
                                <th>ID</th>
                                <th>Tanggal Registrasi</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php $no= 1 @endphp
                            @foreach($data as $data)
                            <tr>
                                <td>{{ $no++ }}</td>
                                <td>{{ $data->nama }}</td>
                                <td>{{ $data->email }}</td>
                                <td>{{ $data->no_wa }}</td>
                                <td>{{ $data->alamat }}</td>
                                <td>{{ $data->id }}</td>
                                <td>{{ $data->created_at->format('d-m-Y H:i:s') }}</td>

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

</div>

 @endsection
