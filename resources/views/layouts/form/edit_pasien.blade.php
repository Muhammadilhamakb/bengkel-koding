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
        <!-- full width column -->
        <div class="col-12">
            <!-- general form elements -->
            <div class="card card-warning">
                <div class="card-header">
                    <h3 class="card-title">Form Edit Pasien</h3>
                </div>
                <!-- form start -->
                <form action="{{route('admin.updatepasien',$pasien->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="nama">Nama Pasien</label>
                                <input type="text" class="form-control" id="nama" name="nama" value="{{$pasien->user->nama}}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="no_ktp">Nomer KTP</label>
                                <input type="text" class="form-control" id="no_ktp" name="no_ktp" value="{{$pasien->no_ktp}}" required>

                            </div>
                        </div>
                        <div class="row">

                            <div class="form-group col-md-6">
                                <label for="no_rm">Nomer Rekam Medis</label>
                                <input type="text" class="form-control" id="no_rm" name="no_rm" value="{{$pasien->no_rm}}" readonly>

                            </div>

                            <div class="form-group col-md-6">
                                <label for="alamat">Alamat</label>
                                <input type="text" class="form-control" id="alamat" name="alamat" value="{{$pasien->user->alamat}}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="email">Email</label>
                                <input type="email" class="form-control" id="email" name="email" value="{{$pasien->user->email}}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="no_hp">No Telepon</label>
                                <input type="text" class="form-control " id="no_hp" name="no_hp" value="{{$pasien->user->no_hp}}" required>
                                <small class="form-text text-muted">Nomer telepon harus 12 atau 13 digit</small>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 ml-4">
                            <button type="submit" class="btn btn-warning">Edit</button>
                            <!-- /.card-body -->

                            <a href="/admin-kelola-pasien" class="btn btn-info">
                                Kembali
                            </a>
                        </div>

                    </div>

                </form>

            </div>
        </div>
    </div>
</div>
@endsection