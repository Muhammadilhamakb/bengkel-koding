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
                            <h3 class="card-title">Form Tambah Dokter</h3>
                        </div>
                        <form action="{{route('admin.storedokter')}}" method="POST">
                            @csrf


                            <div class="card-body">
                                <div class="row">

                                    <div class="form-group col-md-6">
                                        <label for="nama">Nama Dokter</label>
                                        <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama Dokter" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="gelar">Gelar</label>
                                        <input type="text" class="form-control" id="gelar" name="gelar" placeholder="Nama Gelar" required>
                                        <small class="form-text text-muted">Contoh : S3-Kehakiman</small>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="id_poli">Spesialis</label>
                                        <select name="id_poli" id="id_poli" class="form-control" required>
                                            <!-- Placeholder -->
                                            <option value="" disabled selected>Pilih Spesialis</option>

                                            <!-- Daftar dokter -->
                                            @foreach ($poli as $spesial)
                                            <option value="{{ $spesial->id }}">
                                                {{ $spesial->spesialis }}
                                            </option>
                                            @endforeach
                                        </select>
                                        <small class="form-text text-muted">Pilih Spesialis sesuai dengan kemampuan dokter</small>
                                    </div>


                                    <div class="form-group col-md-6">
                                        <label for="alamat">Alamat</label>
                                        <input type="text" class="form-control" id="alamat" name="alamat" placeholder="Alamat" required>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="email">Email</label>
                                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="no_hp">No Telepon</label>
                                        <input type="text" class="form-control " id="no_hp" name="no_hp" placeholder="Nomer Telepon" required>
                                        <small class="form-text text-muted">Nomer telepon harus 12 atau 13 digit</small>
                                    </div>
                                </div>



                            </div>
                            <div class="row">
                                <div class="col-12 ml-4">
                                    <button type="submit" class="btn btn-info">Tambah</button>
                                    <!-- /.card-body -->

                                    <a href="/admin-kelola-dokter" class="btn btn-warning">
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