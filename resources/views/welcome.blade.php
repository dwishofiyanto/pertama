<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
   <title>Home</title>
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


    <!-- AWAL Modal TAMBAH-->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="staticBackdropLabel">Tambah Data Admin</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="{{url('admin')}}" method="post" id="form_tambah">
                @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama Admin</label>
                <input type="text" name="nama" id="nama" class="form-control" id="exampleFormControlInput1" placeholder="Nama">
                <span class="text-danger error-text nama_error"></span>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="form-control" id="exampleFormControlInput1" placeholder="Alamat">
                <span class="text-danger error-text alamat_error"></span>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="tutup" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" value="Simpan">
        </form>
        </div>
      </div>
    </div>
  </div>
<!--AKHIR MODAL TAMBAH-->
<!-- moda edit data -->

<div class="modal fade" id="modal-edit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modal-editLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modal-editLabel">Edit Data Admin</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <form action="" method="post" id="form_edit">
                @csrf
                @method('patch')
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Nama Admin</label>
                <input type="text" name="nama" id="nama_edit" class="form-control" id="exampleFormControlInput1" placeholder="Nama">
                <span class="text-danger error-text nama_error"></span>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Alamat</label>
                <input type="text" name="alamat" id="alamat_edit" class="form-control" id="exampleFormControlInput1" placeholder="Alamat">
                <span class="text-danger error-text alamat_error"></span>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" id="tutup_edit" data-bs-dismiss="modal">Close</button>
          <input type="submit" class="btn btn-primary" value="Simpan">
        </form>
        </div>
      </div>
    </div>
  </div>




<br><br>
    <div class="container py-5">
        <div class="col">
            <div class="card">
                <div class="card-header">
                    <h4>Data Admin
                    <a href="" class="btn btn-primary float-end btn-sm" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><i class="fa fa-plus"></i> TAMBAH</a>
                </h4>

                </div>
                <div class="card-body">
                   ISI DATA
                </div>

            </div>

        </div>
	</div>

<script>
$(document).ready(function(){
    tampil();
});
function edit($id)
{
  

  
$.ajax({
url : "admin/edit_admin/"+$id,
type: "GET",
dataType: "JSON",
success: function(data)
{
$('#form_edit').attr('action','admin/admin/'+$id)
$('#nama_edit').val(data.nama);
$('#alamat_edit').val(data.alamat);
$('#modal-edit').modal('show');
}

});
}
function tampil()
{
   
    $.ajax({
    type:'get',
    url:'admin/admin_tampil',
    success: function (response)
        {   console.log(response);$('.card-body').html(response); }
    });
}
$(function(){
    $("#form_tambah").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function(){
                $(document).find('span.error-text').text('');
            },
            success:function(data){
                if(data.status == 0){
                    $.each(data.error, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }
                else{
                    $('#form_tambah')[0].reset();
                    swal({ title: data.msg,icon: data.isi_status,button: "Tutup",});
                    $('#tutup').click();
                        tampil();
                }
            }
        });
    });
});

$(function(){
    $("#form_edit").on('submit', function(e){
        
        e.preventDefault();
        $.ajax({
            url:$(this).attr('action'),
            method:$(this).attr('method'),
            data:new FormData(this),
            processData:false,
            dataType:'json',
            contentType:false,
            beforeSend:function(){
                $(document).find('span.error-text').text('');
            },
            success:function(data){
                if(data.status == 0){
                    $.each(data.error, function(prefix, val){
                        $('span.'+prefix+'_error').text(val[0]);
                    });
                }
                else{
                        $('#form_edit')[0].reset();
                        swal({ title: data.msg,icon: data.isi_status,button: "Tutup",});
                        $('#tutup_edit').click();
                        tampil();
                }
            }
        });
    });
});
function hapus_datane($id)
{
    swal({
  title: "Yakin ingin hapus data ",
  text: "Once deleted, you will not be able to recover this imaginary file!",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
  

    $.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
    });
    $.ajax(
    {
    url: "admin/admin/"+$id,
    type: 'DELETE', 
    dataType: "JSON",
    data: { "id": $id },
    success: function (response)
    {
        swal({ title: response.msg,icon: response.isi_status,button: "Tutup"});
        tampil();
    },
    error: function(xhr) 
    {   console.log(xhr.responseText);  }
});

  } else {
    swal("Cancell", "", "error");
  }
});
  
  
}

</script>
</body>
</html>