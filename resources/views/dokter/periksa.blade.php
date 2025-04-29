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
        <h2 class="fw-bold text-primary">Daftar Pemeriksaan {{ Auth::user()->name }}</h2>
        <p class="text-muted">Berikut adalah data pemeriksaan yang sudah dilakukan.</p>
    </div>

    <div class="table-responsive rounded shadow-sm">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-light">
                <tr>
                    <th>KODE PERIKSA</th>
                    <th>Nama Pasien</th>
                    <th>Tanggal Periksa</th>
                    <th>Catatan</th>
                    <th>Obat</th>
                    <th>Biaya Periksa</th>
                    <th>Detail Biaya</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($periksas as $periksa)
                    <tr>
                        <td>PR{{ $periksa->id }}</td>
                        <td>{{ $periksa->pasien->name ?? 'Tidak Diketahui' }}</td>
                        <td>{{ $periksa->tgl_periksa }}</td>
                        <td>{{ $periksa->catatan }}</td>
                        <td>
                            @foreach($periksa->obat as $obat)
                                {{ $obat->nama_obat }}<br>
                            @endforeach
                        </td>
                        <td>Rp. {{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</td>
                        <td>
                            <!-- Tombol modal -->
                            <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $periksa->id }}">
                                Lihat Detail
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="detailModal{{ $periksa->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $periksa->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="detailModalLabel{{ $periksa->id }}">Detail Biaya - PR{{ $periksa->id }}</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                                        </div>
                                        <div class="modal-body">
                                            <table class="table">
                                                @php
                                                    $totalObat = $periksa->obat->sum('harga');
                                                    $biayaKonsultasi = $periksa->biaya_periksa - $totalObat;
                                                @endphp
                                                <tr>
                                                    <th>Biaya Konsultasi</th>
                                                    <td>Rp. {{ number_format($biayaKonsultasi, 0, ',', '.') }}</td>
                                                </tr>
                                                <tr>
                                                    <th>Biaya Obat</th>
                                                    <td>
                                                        @foreach($periksa->obat as $obat)
                                                            {{ $obat->nama_obat }} ({{ $obat->kemasan }}) - Rp. {{ number_format($obat->harga, 0, ',', '.') }}<br>
                                                        @endforeach
                                                        <hr class="my-2">
                                                        <strong>Total Obat: Rp. {{ number_format($totalObat, 0, ',', '.') }}</strong>
                                                    </td>
                                                </tr>
                                                <tr class="bg-light fw-bold">
                                                    <th>Total Biaya</th>
                                                    <td>Rp. {{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</td>
                                                </tr>
                                            </table>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="d-flex gap-1">
                            <a href="{{ route('dokter.editPeriksa', $periksa->id) }}" class="btn btn-warning btn-sm">Edit</a>
                            <form action="{{ route('dokter.deletePeriksa', $periksa->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus pemeriksaan ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
