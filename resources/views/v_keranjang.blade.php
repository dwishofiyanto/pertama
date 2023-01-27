<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>Keranjang</title>
    <link href="{{asset('bootstrap-5.0.2-dist/css/bootstrap.min.css')}}" rel="stylesheet" >

<script src="{{asset('bootstrap-5.0.2-dist/js/bootstrap.min.js')}}" ></script>
<script src="{{asset('jquery-3.5.0.min.js')}}"></script>
<script src="{{asset('sweetalert.min.js')}}"></script>
</head>
<body>
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark fixed-top">
        <ul class="navbar-nav">
        <li>
            <a class="navbar-brand" href="#">Logo</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/keranjang">Keranjang</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#">Menu 2</a>
        </li>
        </ul>
        
      </nav>






<br><br>
    <div class="container py-5">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Keranjang Belanjan
               
                </h4>

                </div>
                <div class="card-body">
                   
<table class="table table-striped">
    <thead>
        <th>no</th>
        <th>id barang</th>
        <th>harga</th>
        <th>jumlah</th>
        <th>subtotal</th>
    </thead>
  
        @foreach ($keranjang as $keranjang)
        <tr>
        <td>1</td>
        <td>{{$keranjang->id_barang}}</td>
        <td>{{$keranjang->harga}}</td>
        <td>{{$keranjang->jumlah}}</td>
        <td>{{$keranjang->sub_total}}</td>
    </tr>
        @endforeach
       
   
</table>



                </div>

            </div>

        </div>
	</div>



</body>
</html>