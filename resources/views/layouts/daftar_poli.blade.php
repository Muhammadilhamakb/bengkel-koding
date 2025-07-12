@extends('layouts.main')
@section('content-header')
<div class="container">

    <h2 class="mb-4">Daftar Poli</h2>

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
    <form action="{{ route('poli-daftar.create') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="id_pasien" class="form-label">Nama Pasien</label>
            <select name="id_pasien" id="id_pasien" class="form-select" required>
                <option value="">-- Cari Nama Anda --</option>
                @foreach ($pasien as $p)
                <option value="{{ $p->id }}">{{ $p->user->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="id_poli" class="form-label">Pilih Poli</label>
            <select name="id_poli" id="id_poli" class="form-select" required>
                <option value="">-- Pilih Poli --</option>
                @foreach ($poli as $j)
                <option value="{{ $j->id }}">
                    {{ $j->nama_poli }}
                </option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="tanggal_daftar" class="form-label">Tanggal Daftar</label>
            <input type="date" name="tanggal_daftar" class="form-control" required value="{{ date('Y-m-d') }}">
        </div>
        <div class="mb-3">
            <label for="id_jadwal" class="form-label">Pilih Jadwal Dokter</label>
            <select name="id_jadwal" id="id_jadwal" class="form-select" required>
                <option value="">-- Pilih Jadwal --</option>
                @foreach ($jadwal as $j)
                <option
                    value="{{ $j->id }}"
                    data-poli="{{ $j->id_poli }}"
                    {{ $j->status_aktif ? '' : 'disabled' }}>
                    {{ $j->dokter->user->nama }} - {{ $j->hari }} ({{ $j->jam_mulai }} - {{ $j->jam_selesai }}) {{ $j->status_aktif ? '' : '[Tutup]' }}
                </option>
                @endforeach
            </select>
        </div>



        <button type="submit" class="btn btn-primary">Daftar</button>
        <a href="/poli" class="btn btn-warning">
            Kembali
        </a>
    </form>


</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const jadwalSelect = document.getElementById("id_jadwal");
        const poliSelect = document.getElementById("id_poli");

        // Saat poli diubah, filter jadwal
        poliSelect.addEventListener("change", function() {
            const selectedPoli = this.value;

            [...jadwalSelect.options].forEach(option => {
                if (option.value === "") return; // skip placeholder

                const poliId = option.getAttribute("data-poli");

                // tampilkan hanya jadwal yang sesuai poli
                option.style.display = poliId === selectedPoli ? "block" : "none";
            });

            jadwalSelect.value = ""; // reset pilihan jadwal
        });
    });
</script>

@endsection