@extends('layouts.main')
@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Kelola Dokter</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Kelola Dokter</li>
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
    <a href="/admin-tambah-dokter">
        <button class="btn btn-info">
            Tambah Dokter
        </button>
    </a>
</div>
<div class="mt-3">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Dokter</th>
                <th>Nama Poli</th>
                <th>Jadwal Poli</th>
                <th>Gelar</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dokters as $dokter)
            <tr>
                <td>{{$loop->iteration }}</td>
                <td>{{$dokter->user->nama }}</td>
                <td>{{$dokter->poli->nama_poli }}</td>
                <td style="text-align: center;">@forelse($dokter->jadwal_periksa as $jadwal)
                    {{ $jadwal->hari }} - {{$jadwal->jam_mulai}} s/d {{$jadwal->jam_selesai}} 
                    @empty
                    Belum Ada Jadwal
                    @endforelse
                </td>
                <td>{{$dokter->gelar }}</td>
                <td>{{$dokter->user->alamat }}</td>
                <td>{{$dokter->user->no_hp }}</td>
                <td style="text-align: center;">
                    <form action="{{route('admin.editdokter',$dokter->id)}}" method="GET" style="display:inline-block">
                        <button class="btn btn-warning">Edit</button>
                    </form>
                    <form action="{{route('admin.deletedokter',$dokter->id)}}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus?')">
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