@extends('components.layout')

@section('nav-content')
<ul class="nav flex-column mb-4">
    <li class="nav-item">
        <a href="{{ route('pasien.dashboard') }}" class="nav-link">
            <i class="nav-icon fas fa-tachometer-alt"></i> Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('pasien.periksa') }}" class="nav-link active">
            <i class="nav-icon fas fa-th"></i> Periksa
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('pasien.riwayat') }}" class="nav-link">
            <i class="nav-icon fas fa-book"></i> Riwayat Periksa
        </a>
    </li>
</ul>
@endsection

@section('content')
<div class="container py-4 animate__animated animate__fadeIn">
    <h2 class="mb-4 fw-bold text-primary">Form Periksa Pasien</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ url('/pasien/periksa') }}" method="POST" class="p-4 bg-white shadow rounded-4">
        @csrf

        <div class="mb-3">
            <label for="id_dokter" class="form-label">Pilih Dokter</label>
            <select name="id_dokter" id="id_dokter" class="form-select @error('id_dokter') is-invalid @enderror">
                <option value="">-- Pilih Dokter --</option>
                @foreach($dokters as $dokter)
                    <option value="{{ $dokter->id }}" {{ old('id_dokter') == $dokter->id ? 'selected' : '' }}>
                        {{ $dokter->name }}
                    </option>
                @endforeach
            </select>
            @error('id_dokter')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="tgl_periksa" class="form-label">Tanggal Periksa</label>
            <input type="date" name="tgl_periksa" id="tgl_periksa"
                   class="form-control @error('tgl_periksa') is-invalid @enderror"
                   value="{{ old('tgl_periksa') }}">
            @error('tgl_periksa')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary w-100 fw-bold">Buat Periksa</button>
    </form>
</div>
@endsection
