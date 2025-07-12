@extends('layouts.main')

@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Periksa</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Periksa</li>
            </ol>
        </div>
    </div>
</div><!-- /.container-fluid -->
@endsection

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title mb-0">Form Periksa</h3>
                </div>

                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="{{ route('periksa.byDokter') }}" method="POST">
                        @csrf
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
                        <div class="card-body">
                            <div class="form-group">
                                <label for="obat">Dokter</label>
                                <select name="id_dokter" id="id_dokter" class="form-control" required>
                                    <!-- Placeholder -->
                                    <option value="" disabled selected>Pilih Dokter</option>

                                    <!-- Daftar dokter -->
                                    @foreach ($dokters as $dokter)
                                    <option value="{{ $dokter->id }}">
                                        {{ $dokter->nama }}
                                    </option>
                                    @endforeach
                                </select>
                                <small class="form-text text-muted">Pilih dokter yang kamu inginkan(Sesuaikan dengan dokter yang anda pilih saat mendaftar).</small>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="no_antrean">Nomor Antrean</label>
                                <input type="text" name="no_antrean" id="no_antrean" class="form-control" required>
                                <small class="form-text text-muted">Masukkan nomor antrean yang sudah Anda dapatkan saat mendaftar.</small>
                                <div class="d-flex align-items-center">
                                    <small class="text-muted">Jika Belum Mendaftar Silahkan Daftar disini!</small>
                                    <a href="/poli" class="ml-1 " style="text-decoration:underline; font-style:italic; font-size:small;">Daftar Sekarang</a>
                                </div>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <label for="keluhan">Keluhan</label>
                                <input type="text" name="keluhan" id="keluhan" class="form-control" required>
                                <small class="form-text text-muted">Tuzliskan Keluhan Yang Anda Alami.</small>
                            </div>
                            <div class="card-footer">
                                <button type="submit" class="btn btn-warning">Pilih</button>
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </form>
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title mb-0">Riwayat Periksa</h3>

                    </div>

                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Poli</th>
                                <th>Dokter</th>
                                <th>Tanggal</th>
                                <th>Selesai Pemeriksaan</th>
                                <th>Total_Biaya_Periksa</th>
                                <th>Status</th>
                                <th>Lihat Detail Periksa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($periksas as $periksa)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $periksa->daftarPoli->jadwal->poli->nama_poli ?? 'N/A' }}</td>
                                <td>{{ $periksa->dokter->nama ?? 'N/A' }}</td>
                                <td>{{ \Carbon\Carbon::parse($periksa->tgl_periksa ?? 'N/A')->format('d-m-Y') }}</td>
                                <td>
                                    @if ($periksa->waktu_diperiksa)
                                    {{ \Carbon\Carbon::parse($periksa->waktu_diperiksa)->setTimezone('Asia/Jakarta')->format('H:i') }}
                                    @else
                                    Belum Diperiksa
                                    @endif
                                </td>
                                <td>{{ $periksa->biaya_periksa !== null ? 'Rp' . number_format($periksa->biaya_periksa, 0, ',', '.') : '-' }}</td>
                                <td>
                                    @if ($periksa->status === 'Selesai')
                                    <span class="badge bg-primary">{{ $periksa->status }}</span>
                                    @elseif ($periksa->status === 'Menunggu')
                                    <span class="badge bg-danger text-dark">{{ $periksa->status }}</span>
                                    @else
                                    <span class="badge bg-warning">{{ $periksa->status ?? 'N/A' }}</span>
                                    @endif
                                </td>
                                <td style="text-align: center;">
                                    <a href="{{route('lihat.detail.periksa',$periksa->id)}}">
                                        <button class=" btn-warning">Detail</button>
                                    </a>
                                </td>
                            </tr>

                            @endforeach

                        </tbody>
                    </table>




                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@include('layouts.lib.ext_js_datatables')
<!-- Page specific script -->
<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    });
</script>

@endsection