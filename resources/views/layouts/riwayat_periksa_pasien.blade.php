@extends('layouts.main')
@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Riwayat Periksa Pasien</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Riwayat Periksa Pasien</li>
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

<div class="mt-3">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Pasien</th>
                <th>Tanggal Periksa</th>
                <th>Keluhan</th>
                <th>Resep Obat</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @forelse($riwayat as $d)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$d->pasienModels->user->nama}}</td>
                <td>{{ \Carbon\Carbon::parse($d->tgl_periksa)->format('d-m-Y') }}</td>
                <td>{{$d->keluhan}}</td>

                <td>
                    @foreach ($d->detailPeriksa as $detail)
                    {{ $detail->obat->nama_obat ?? '-'}}
                    @endforeach
                </td>

                <td>{{$d->status}}</td>
            </tr>

            @empty
            <tr>
                <td colspan="6" class="text-center">Belum ada pasien yang diperiksa.</td>
            </tr>
            @endforelse
        </tbody>
    </table>
   
    
</div>

@endsection