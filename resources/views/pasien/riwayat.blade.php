@extends('components.layout')

@section('nav-content')
    <ul class="nav">
        <li class="nav-item"><a href="{{ route('pasien.dashboard') }}" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li class="nav-item"><a href="{{ route('pasien.periksa') }}" class="nav-link"><i class="nav-icon fas fa-th"></i> Periksa</a></li>
        <li class="nav-item"><a href="{{ route('pasien.riwayat') }}" class="nav-link"><i class="nav-icon fas fa-book"></i> Riwayat Periksa</a></li>
    </ul>
@endsection

@section('content')
    <div class="container-fluid py-4 animate__animated animate__fadeIn">
        <h2 class="mb-4 fw-bold text-primary">Riwayat Periksa {{ Auth::user()->name }}</h2>

        <div class="table-responsive shadow rounded-4 overflow-hidden">
            <table class="table table-striped table-hover align-middle mb-0">
                <thead class="table-primary">
                    <tr>
                        <th>KODE</th>
                        <th>Dokter</th>
                        <th>Tanggal</th>
                        <th>Catatan</th>
                        <th>Obat</th>
                        <th>Biaya</th>
                        <th>Status</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($periksas as $periksa)
                        <tr>
                            <td>PR{{ $periksa->id }}</td>
                            <td>{{ $periksa->dokter->name ?? 'Tidak Diketahui' }}</td>
                            <td>{{ $periksa->tgl_periksa }}</td>
                            <td>{{ $periksa->catatan }}</td>
                            <td>
                                @foreach ($periksa->obat as $obat)
                                    <span class="badge bg-info text-dark mb-1">{{ $obat->nama_obat }}</span><br>
                                @endforeach
                            </td>
                            <td>Rp. {{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</td>
                            <td>
                                <span class="badge bg-{{ $periksa->status == 'selesai' ? 'success' : 'warning' }}">{{ ucfirst($periksa->status) }}</span>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-outline-primary" data-bs-toggle="modal" data-bs-target="#detailModal{{ $periksa->id }}">
                                    Lihat Detail
                                </button>
                                <!-- Modal -->
                                <div class="modal fade" id="detailModal{{ $periksa->id }}" tabindex="-1" aria-labelledby="detailModalLabel{{ $periksa->id }}" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content rounded-4">
                                            <div class="modal-header bg-primary text-white">
                                                <h5 class="modal-title" id="detailModalLabel{{ $periksa->id }}">Detail Biaya - PR{{ $periksa->id }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                @php
                                                    $totalObat = $periksa->obat->sum('harga');
                                                    $biayaKonsultasi = $periksa->biaya_periksa - $totalObat;
                                                @endphp
                                                <table class="table table-borderless">
                                                    <tr>
                                                        <th>Biaya Konsultasi</th>
                                                        <td>Rp. {{ number_format($biayaKonsultasi, 0, ',', '.') }}</td>
                                                    </tr>
                                                    <tr>
                                                        <th>Biaya Obat</th>
                                                        <td>
                                                            @foreach ($periksa->obat as $obat)
                                                                {{ $obat->nama_obat }} ({{ $obat->kemasan }}) + Rp. {{ number_format($obat->harga, 0, ',', '.') }}<br>
                                                            @endforeach
                                                            <hr>
                                                            <strong>Total: Rp. {{ number_format($totalObat, 0, ',', '.') }}</strong>
                                                        </td>
                                                    </tr>
                                                    <tr class="table-light">
                                                        <th>Total Biaya</th>
                                                        <td><strong>Rp. {{ number_format($periksa->biaya_periksa, 0, ',', '.') }}</strong></td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                                                <!-- Form bayar & selesai transaksi -->
                                                <form action="{{ route('pasien.transaksi.selesai', $periksa->id) }}" method="POST">
                                                    @csrf
                                                    @method('PATCH') <!-- PATCH method digunakan untuk update data -->
                                                    <button type="submit" class="btn btn-success">Bayar & Selesaikan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
<!-- End Modal -->
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
