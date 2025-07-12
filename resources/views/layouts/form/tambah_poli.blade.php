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
                            <h3 class="card-title">Form Tambah Poli</h3>
                        </div>
                        <form action="{{route('admin.storepoli')}}" method="POST">
                            @csrf
                            <div class="card-body">
                                <div class="form-group col-md-6">
                                    <label for="kode_poli">Kode Poli</label>
                                    <input type="text" class="form-control" id="kode_poli" name="kode_poli" placeholder="Masukkan Kode Poli" required>
                                    <small class="form-text text-muted">Buat kode poli sesuai dengan singkatan nama poli. Contoh : PG berarti (Poli Ginjal)</small>
                                    @error('kode_poli')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="nama_poli">Nama Poli</label>
                                    <input type="text" class="form-control" id="nama_poli" name="nama_poli" placeholder="Masukkan Nama Poli" required>
                                    @error('nama_poli')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                    @enderror
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="spesialis">Spesialis</label>
                                    <input type="text" class="form-control" id="spesialis" name="spesialis" placeholder="Masukkan Spesialis " required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 ml-4">
                                    <button type="submit" class="btn btn-info">Tambah</button>
                                    <!-- /.card-body -->

                                    <a href="/admin-kelola-poli" class="btn btn-warning">
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