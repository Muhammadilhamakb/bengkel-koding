@extends('components.layout')

@section('nav-content')
    <ul class="nav">
        <li class="nav-item"><a href="{{ route('dokter.dashboard') }}" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li class="nav-item"><a href="{{ route('dokter.obat') }}" class="nav-link"><i class="nav-icon fas fa-th"></i> Obat</a></li>
        <li class="nav-item"><a href="{{ route('dokter.periksa') }}" class="nav-link"><i class="nav-icon fas fa-book"></i> Periksa</a></li>
    </ul>
@endsection

@section('content')
<div class="container py-4 animate__animated animate__fadeIn">
    <div class="mb-4">
        <h2 class="fw-bold text-primary">Edit Obat</h2>
        <p class="text-muted">Perbarui data obat yang tersedia di klinik Anda.</p>
    </div>

    <!-- Tampilkan pesan error -->
    @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <strong>Periksa kembali input Anda:</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Tutup"></button>
        </div>
    @endif

    <!-- Form Edit Obat -->
    <div class="card shadow-sm rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h5 class="mb-0">Form Edit Obat</h5>
        </div>
        <div class="card-body">
            <form action="{{ url('dokter/obat/update/' . $obat->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_obat" class="form-label fw-semibold">Nama Obat</label>
                    <input type="text" name="nama_obat" id="nama_obat" class="form-control" value="{{ $obat->nama_obat }}" required>
                </div>
                <div class="mb-3">
                    <label for="kemasan" class="form-label fw-semibold">Kemasan</label>
                    <input type="text" name="kemasan" id="kemasan" class="form-control" value="{{ $obat->kemasan }}" required>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label fw-semibold">Harga (Rp)</label>
                    <input type="number" name="harga" id="harga" class="form-control" value="{{ $obat->harga }}" required>
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('dokter.obat') }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
