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
        <h2 class="fw-bold text-primary">Daftar Obat</h2>
        <p class="text-muted">Kelola daftar obat yang tersedia di klinik Anda.</p>
    </div>

    <!-- Form Tambah Obat -->
    <div class="card shadow-sm rounded-4 mb-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h5 class="mb-0">Tambah Obat Baru</h5>
        </div>
        <div class="card-body">
            <form action="{{ url('dokter/obat') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="nama_obat" class="form-label fw-semibold">Nama Obat</label>
                    <input type="text" name="nama_obat" id="nama_obat" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="kemasan" class="form-label fw-semibold">Kemasan</label>
                    <input type="text" name="kemasan" id="kemasan" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="harga" class="form-label fw-semibold">Harga (Rp)</label>
                    <input type="number" name="harga" id="harga" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Obat</button>
            </form>
        </div>
    </div>

    <!-- Flash Message -->
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert" id="alert-success">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger alert-dismissible fade show" role="alert" id="alert-error">
            <strong>Gagal!</strong> {{ session('error') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <!-- Tabel Obat -->
    <div class="card shadow-sm rounded-4">
        <div class="card-header bg-primary text-white rounded-top-4">
            <h5 class="mb-0">Daftar Obat yang Tersedia</h5>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-striped align-middle">
                <thead class="table-dark">
                    <tr>
                        <th style="width: 5%">No</th>
                        <th>Nama Obat</th>
                        <th>Kemasan</th>
                        <th>Harga</th>
                        <th style="width: 20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($obat as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->nama_obat }}</td>
                            <td>{{ $item->kemasan }}</td>
                            <td>Rp {{ number_format($item->harga, 0, ',', '.') }}</td>
                            <td>
                                <a href="{{ url('dokter/obat/edit/' . $item->id) }}" class="btn btn-warning btn-sm me-1">Edit</a>
                                <a href="{{ url('dokter/obat/delete/' . $item->id) }}" class="btn btn-danger btn-sm"
                                   onclick="return confirm('Yakin ingin menghapus obat ini?')">Hapus</a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center text-muted">Belum ada data obat.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Auto-dismiss alert -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        setTimeout(() => {
            ['alert-success', 'alert-error'].forEach(id => {
                const alertBox = document.getElementById(id);
                if (alertBox) alertBox.classList.remove("show");
            });
        }, 2000);
    });
</script>
@endsection
