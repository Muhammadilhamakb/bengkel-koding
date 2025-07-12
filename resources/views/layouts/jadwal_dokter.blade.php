@extends('layouts.main')
@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Jadwal Periksa</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Jadwal Periksa</li>
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
    <a href="/tambah_jadwal_periksa">
        <button class="btn btn-info">
            + Tambah Jadwal Periksa Dokter
        </button>
    </a>
</div>
<div class="mt-3">
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Dokter</th>
                <th>Hari</th>
                <th>Jam Mulai</th>
                <th>Jam Selesai</th>
                <th>Status</th>
                <th>Aktif</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwal as $j)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$j->dokter->user->nama}}</td>
                <td>{{$j->hari}}</td>
                <td>{{$j->jam_mulai}}</td>
                <td>{{$j->jam_selesai}}</td>
                <td>@if($j->status_aktif)
                    Buka
                    @else
                    Tutup
                    @endif</td>
                <td style="text-align: center;"> <a href="{{route('edit.jadwaldokte',$j->id)}}" class="btn btn-sm btn-warning">Edit</a>

                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>
@endsection