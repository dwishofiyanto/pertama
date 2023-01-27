<table class="table table-striped">
    <thead>
        <th>no</th>
        <th>nama</th>
        <th>alamat</th>
        <th>aksi</th>
    </thead>
    <tbody>
        @php
            $nomor = 1;
        @endphp
        @foreach ($admin as $admin)
        <tr>
            <td>{{$nomor}}</td>
            <td>{{$admin->nama}}</td>
            <td>{{$admin->alamat}}</td>
            <td><button class="btn btn-primary" onclick="edit({{$admin->id}})">EDIT</button> 
             
                <a href="#" class="btn btn-secondary" onclick="hapus_datane({{$admin->id}})" data-token="{{ csrf_token() }}"> HAPUS</a>
          
            </td>
        </tr>
        @php
            $nomor++
        @endphp
     
        @endforeach
       
    </tbody>
</table>
<script>


    </script>
