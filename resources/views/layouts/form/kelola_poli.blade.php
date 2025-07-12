@extends('layouts.main')
@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Kelola Poli</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Kelola Poli</li>
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
<div class="">
    <a href="/admin-tambah-poli">
        <button class="btn btn-info">
            Tambah Poli
        </button>
    </a>
    <a href="/admin-tambah-jadwal">
        <button class="btn btn-primary">
            Tambah Jadwal
        </button>
    </a>
</div>
<div class="mt-3">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Poli</th>
                <th>Nama Dokter</th>
                <th>Jadwal Poli</th>
                <th>Spesialis</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwal as $jad)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$jad->poli->nama_poli}}</td>
                <td>{{$jad->dokter->user->nama}}</td>
                <td>{{$jad->hari ?? ''}} - {{$jad->jam_mulai}} s/d {{$jad->jam_selesai}}</td>
                <td>{{$jad->poli->spesialis}}</td>
                <td>@if($jad->status_aktif)
                    Buka
                    @else
                    Tutup
                    @endif</td>
                <td style="text-align: center;">
                    <form action="{{route('admin.editpoli',$jad->id)}}" method="GET" style="display:inline-block">
                        <button class="btn btn-warning">Edit</button>
                    </form>
                    <form action="{{route('admin.deletepoli',$jad->id)}}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus?')">
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