 
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

    
<table class="table table-responsive table-hover">
    <thead>
          <tr><th>Column</th><th>Column</th><th>Column</th><th>Column</th></tr>
      </thead>
      <tbody>
          <tr class="clickable" data-toggle="collapse" id="row1" data-target=".row1">
              <td><i class="glyphicon glyphicon-plus"></i></td>
              <td>data</td>
                <td>data</td>  
              <td>data</td>
          </tr>
          <tr class="collapse row1">
              <td>- child row</td>
              <td>data</td>
                <td>data</td>  
              <td>data</td>
          </tr>
          <tr class="collapse row1">
              <td>- child row</td>
              <td>data</td>
                <td>data</td>  
              <td>data</td>
          </tr>
          <tr class="clickable" data-toggle="collapse" id="row2" data-target=".row2">
              <td><i class="glyphicon glyphicon-plus"></i></td>
              <td>data</td>
                <td>data</td>  
              <td>data</td>
          </tr>
          <tr class="collapse row2">
              <td>- child row</td>
              <td>data 2</td>
                <td>data 2</td>  
              <td>data 2</td>
          </tr>
          <tr class="collapse row2">
              <td>- child row</td>
              <td>data 2</td>
                <td>data 2</td>  
              <td>data 2</td>
          </tr>
      </tbody>
  </table>
  

</div>

 @endsection

 


 
 




