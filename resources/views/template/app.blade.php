
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Toko Kue Ku - @yield('title')</title>
   

    @include('template.partials._styles')

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

            @include('template.partials._navbar')

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

             <!-- Topbar -->
            {{-- <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow " >
                @include('template.partials._topbar')
            </nav> --}}
            <!-- End of Topbar -->

           @yield('content')

            @include('template.partials._footer')

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

   

    @include('template.partials._script')

</body>

</html>