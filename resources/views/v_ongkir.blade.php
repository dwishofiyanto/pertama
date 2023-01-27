<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>ongkir</title>
    <link href="{{asset('bootstrap-5.0.2-dist/css/bootstrap.min.css')}}" rel="stylesheet" >

<script src="{{asset('bootstrap-5.0.2-dist/js/bootstrap.min.js')}}" ></script>
<script src="{{asset('jquery-3.5.0.min.js')}}"></script>
<script src="{{asset('sweetalert.min.js')}}"></script>
</head>
<body>
  
<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal">ONGKIR</h5>

    <nav class="my-2 my-md-0 mr-md-3">
        <a href="#" class="p-2 text-dark">keranjag</a>
        <a href="#" class="p-2 text-dark">keranjag</a>
        <a href="#" class="p-2 text-dark">keranjag</a>
        <a href="#" class="p-2 text-dark">keranjag</a>
    </nav>
<a href="#" class="btn btn-outline-primary">kana</a>
</div>


<br><br>
    <div class="container">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>CEK ONGKIR
 
                </h4>

                </div>
                <form action="/cek_ongkir" method="post" class="form-horizontal" role="form">
                    {{ csrf_field() }}
                <div class="card-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <h6>Nama Anda</h6>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                               <BR><h6>Di Kirim Dari</h6>
                                <select name="province_origin" id="" class="form-control">
                                    <option value="">PILIH PROVINSI PENGIRIMAN</option>
                                    @foreach ($provinsi as $provinsi)
                                    {<option value="{{$provinsi->id}}">{{$provinsi->province}}</option>}
                                     @endforeach
                                </select>
                            </div>
                            <BR><div class="form-group">
                             
                                <select name="city_origin" id="" class="form-control">
                                    <option value="">PILIH KOTA PENGIRIMAN</option>
                                </select>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                               <BR><h6>Alamat Tujuan</h6>
                                <select name="province_destination" id="" class="form-control">
                                    <option value="">PILIH PROVINSI TUJUAN</option>
                                    @foreach ($provinsi1 as $provinsi1)
                                    {
                                        <option value="{{$provinsi1->id}}">{{$provinsi1->province}}</option>
                                    }
                                        
                                    @endforeach
                                </select>

                            </div>
                           <BR> <div class="form-group">
                               
                                <select name="city_destination" id="" class="form-control">
                                    <option value="">PILIH KOTA TUJUAN</option>
                                  
                                </select>

                            </div>
                        </div>

                        
                          
                       


                    </div>
                  
                       

                    <div class="row">

                       

                        <div class="col-sm-6">
                            <div class="form-group">
                               <BR><h6>Kurir Pengiriman</h6>
                                <select name="courier" id="" class="form-control">
                                    <option value="">PILIH KURIR</option>
                                  @foreach ($kurir as $kurir)
                                  <option value="{{$kurir->code}}">{{$kurir->title}}</option>
                                      
                                  @endforeach
                                </select>

                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <BR><h6>Berat Paket (gr)</h6>
                                <input type="number" name="weight" class="form-control" value="1000">

                            </div>
                        </div>
                        

 
                   
                    </div>
                   
                    <BR><BR>
                    <div class="mb-3">
                 
                 
                        <div class="d-grid gap-2 mx-auto">
                            <button type="submit" class="btn btn-info btn-primary">CEK ONGKIR</button>
                         
                          </div>
                 
                    </div>
                   
                </form>


                <BR><BR>
@if($cek_ongkir)

<table class="table table-striped table-bordered table-hovered" width="100%">
    <thead>
        <th>Layanan</th>
        <th>deskripsi</th>
        <th>Biaya Ongkir</th>
        <th>Estimasi Pengiriman</th>
        <th>Catatan</th>
    </thead>
    <tbody>
        @foreach ($cek_ongkir as $cek_ongkir)
        <tr>
            <td> {{$cek_ongkir['service']}} </td>
            <td>  {{$cek_ongkir['description']}} </td>
            <td> {{$cek_ongkir['cost'][0]['value']}} </td>
            <td> {{$cek_ongkir['cost'][0]['etd']}} </td>
            <td> {{$cek_ongkir['cost'][0]['note']}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else               
@endif         
                     
                     
                     
                 
                </div>

            </div>

        </div>
	</div>
<script>
    $(document).ready(function(){

        $('select[name="province_origin"]').on('change', function(){
            let provinceId = $(this).val();
          
            if(provinceId)
            {
                jQuery.ajax({
                    url:'/cek_ongkir/ajax/'+provinceId,
                    type:'GET',
                    dataType:"json",
                    success:function(data)
                    {
                        console.log(data);
                        $('select[name="city_origin"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="city_origin"]').append('<option value="'+key+'">'+value+'</option>');
                        });
                    },
                });
            }
            else
            {
               
                $('select[name="city_origin"]').empty();
            }
        });


        $('select[name="province_destination"]').on('change', function(){
            let provinceId = $(this).val();
           
            if(provinceId)
            {
                jQuery.ajax({
                    url:'/cek_ongkir/ajax/'+provinceId,
                    type:'GET',
                    dataType:"json",
                    success:function(data)
                    {
                        console.log(data);
                        $('select[name="city_destination"]').empty();
                        $.each(data, function(key, value){
                            $('select[name="city_destination"]').append('<option value="'+key+'">'+value+'</option>');
                        });
                    },
                });
            }
            else
            {
               
                $('select[name="city_destination"]').empty();
            }
        })

    });
</script>
</body>
</html>