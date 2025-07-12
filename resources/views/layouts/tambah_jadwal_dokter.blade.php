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
@if ($errors->any())
<div class="alert alert-danger alert-dismissible fade show" role="alert">
    <strong>Terjadi kesalahan!</strong>
    <ul class="mb-0">
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif
                    <div class="card card-info">
                        <div class="card-header">
                            <h3 class="card-title">Form Tambah Jadwal Periksa Dokter</h3>
                        </div>
                        <form action="{{route('tambah.jadwaldokter')}}" method="POST">
                            @csrf
                            <div class="card-body">

                                <div class="form-group col-md-6">
                                    <label for="id_dokter">Nama Dokter</label>
                                    <input type="text" class="form-control" id="id_dokter" name="id_dokter" value="{{$dokter->user->nama}}" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="id_poli">Nama Poli</label>
                                    <select name="id_poli" id="id_poli" class="form-control" required>
                                        <!-- Placeholder -->
                                        <option value="" disabled selected>Pilih Poli</option>

                                        <!-- Daftar dokter -->
                                        @foreach ($poli as $pol)
                                        <option value="{{ $pol->id }}">
                                            {{ $pol->nama_poli }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="hari">Hari</label>
                                    <select name="hari" id="hari" class="form-control" required>
                                        <!-- Placeholder -->
                                        <option value="" disabled selected>Pilih Hari</option>
                                        <option value="Senin">Senin</option>
                                        <option value="Selasa">Selasa</option>
                                        <option value="Rabu">Rabu</option>
                                        <option value="Kamis">Kamis</option>
                                        <option value="Jumat">Jumat</option>
                                        <option value="Sabtu">Sabtu</option>
                                        <option value="Minggu">Minggu</option>

                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="jam_mulai">Jam Mulai</label>
                                    <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" placeholder="Masukkan Jam Mulai Poli" required>
                                    <!-- @error('nama_poli')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror -->
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="jam_selesai">Jam Selesai</label>
                                    <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" placeholder="Masukkan Jam Selesai Poli" required>
                                    <!-- @error('nama_poli')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror -->
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="status_aktif">Status Aktif</label>
                                    <select name="status_aktif" id="status_aktif" class="form-control" required>
                                        <option value="1" {{ old('status_aktif') == '1' ? 'selected' : '' }}>Buka</option>
                                        <option value="0" {{ old('status_aktif') == '0' ? 'selected' : '' }}>Tutup</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 ml-4">
                                    <button type="submit" class="btn btn-info">Tambah</button>
                                    <!-- /.card-body -->

                                    <a href="/jadwal_periksa" class="btn btn-warning">
                                        Kembali
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection