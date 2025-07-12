 @extends('layouts.main')
 @section('content-header')
 <div class="container-fluid">
     <div class="row mb-2">
         <div class="col-sm-6">
             <h1>Kelola Pasien</h1>
         </div>
         <div class="col-sm-6">
             <ol class="breadcrumb float-sm-right">
                 <li class="breadcrumb-item"><a href="#">Home</a></li>
                 <li class="breadcrumb-item active">Kelola Pasien</li>
             </ol>
         </div>
     </div>
 </div><!-- /.container-fluid -->
 @endsection

 @section('content')

 <!-- Tampilkan pesan sukses jika ada -->
 @if(session('success'))
 <div class="alert alert-success">
     {{ session('success') }}
 </div>
 @endif

 <!-- Tampilkan pesan error jika ada -->
 @if(session('error'))
 <div class="alert alert-danger">
     {{ session('error') }}
 </div>
 @endif
 <div class="" style="text-align: center;">
     <a href="/admin-tambah-pasien">
         <button class="btn btn-info">
             Tambah Pasien
         </button>
     </a>
 </div>
 <div class="mt-3">
     <table class="table table-bordered">
         <thead>
             <tr>
                 <th>No</th>
                 <th>Nama Pasien</th>
                 <th>Nomer Rekam Medis</th>
                 <th>Nomer KTP</th>
                 <th>Alamat</th>
                 <th>Telepon</th>
                 <th>Aksi</th>
             </tr>
         </thead>
         <tbody>
             @foreach($pasien as $pas)
             <tr>
                 <td>{{$loop->iteration }}</td>
                 <td>{{$pas->user->nama }}</td>
                 <td>{{$pas->no_rm }}</td>
                 <td>{{$pas->no_ktp }}</td>
                 <td>{{$pas->user->alamat }}</td>
                 <td>{{$pas->user->no_hp }}</td>
                 <td style="text-align: center;">
                     <form action="{{route('admin.editpasien',$pas->id)}}" method="GET" style="display:inline-block">
                         <button class="btn btn-warning">Edit</button>
                     </form>
                     <form action="{{route('admin.deletepasien',$pas->id)}}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus?')">
                         @csrf
                         @method('DELETE')

                         <button class="btn btn-danger">Hapus</button>
                     </form>
                 </td>
             </tr>
             @endforeach
         </tbody>
     </table>

 </div>
 @endsection