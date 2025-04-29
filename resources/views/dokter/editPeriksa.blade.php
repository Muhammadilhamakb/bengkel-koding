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
    <h2 class="fw-bold text-primary mb-4">Edit Pemeriksaan - PR{{ $periksa->id }}</h2>

    <form action="{{ route('dokter.updatePeriksa', $periksa->id) }}" method="POST" class="p-4 bg-white rounded-4 shadow-sm">
        @csrf
        @method('PUT')

        <!-- Pasien -->
        <div class="mb-3">
            <label for="id_pasien" class="form-label fw-semibold">Pasien</label>
            <select name="id_pasien" class="form-select" required>
                <option value="">Pilih Pasien</option>
                @foreach($pasienList as $pasien)
                    <option value="{{ $pasien->id }}" {{ $periksa->id_pasien == $pasien->id ? 'selected' : '' }}>
                        {{ $pasien->name }}
                    </option>
                @endforeach
            </select>
            @error('id_pasien')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <!-- Tanggal Pemeriksaan -->
        <div class="mb-3">
            <label for="tgl_periksa" class="form-label fw-semibold">Tanggal Pemeriksaan</label>
            <input type="date" name="tgl_periksa" class="form-control" value="{{ $periksa->tgl_periksa }}" required>
            @error('tgl_periksa')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <!-- Catatan -->
        <div class="mb-3">
            <label for="catatan" class="form-label fw-semibold">Catatan</label>
            <textarea name="catatan" class="form-control" rows="4">{{ old('catatan', $periksa->catatan) }}</textarea>
            @error('catatan')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <!-- Biaya Pemeriksaan -->
        <div class="mb-3">
            <label for="biaya_periksa" class="form-label fw-semibold">Biaya Pemeriksaan (Rp)</label>
            <input type="number" name="biaya_periksa" class="form-control" value="{{ $periksa->biaya_periksa }}" required>
            @error('biaya_periksa')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <!-- Obat -->
        <div class="mb-3">
            <label for="obat" class="form-label fw-semibold">Obat yang Diberikan</label>
            <div class="row">
                @foreach($obatList as $obat)
                    <div class="col-md-6">
                        <div class="form-check mb-2">
                            <input type="checkbox" class="form-check-input" name="obat[]" value="{{ $obat->id }}"
                                {{ in_array($obat->id, $periksa->obat->pluck('id')->toArray()) ? 'checked' : '' }}>
                            <label class="form-check-label">
                                {{ $obat->nama_obat }} ({{ $obat->kemasan }})
                            </label>
                        </div>
                    </div>
                @endforeach
            </div>
            @error('obat')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex justify-content-between mt-4">
            <a href="{{ route('dokter.periksa') }}" class="btn btn-outline-secondary">Kembali</a>
            <button type="submit" class="btn btn-success">Update Pemeriksaan</button>
        </div>
    </form>
</div>
@endsection
