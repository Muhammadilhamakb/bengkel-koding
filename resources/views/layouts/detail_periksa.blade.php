@extends('layouts.main')
@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Detail Periksa</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Detail Periksa</li>
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
                <div class="card-body">
                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        {{ session('error') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <form action="{{route('lihat.detail.periksa',$periksa->id)}}" method="POST">
                        @csrf
                        @method('GET')

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="nama_obat">Nama Pasien</label>
                                    <input type="text" class="form-control" id="nama_obat" name="nama_obat" value="{{$periksa->pasienModels->user->nama}}" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="kemasan">Nama Dokter</label>
                                    <input type="text" class="form-control" id="kemasan" name="kemasan" value="{{$periksa->dokter->nama}}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-5">
                                    <label for="harga">Keluhan</label>
                                    <input type="text" class="form-control" id="harga" name="harga" value="{{$periksa->keluhan}}" readonly>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="harga">Tanggal Periksa</label>
                                    <input type="text" class="form-control" id="harga" name="harga" value="{{ \Carbon\Carbon::parse($periksa->tgl_periksa ?? 'N/A')->format('d-m-Y') }}" readonly>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="harga">Selesai Periksa</label>
                                    <input type="text" class="form-control " id="harga" name="harga" value=" @if ($periksa->waktu_diperiksa)
                    {{ \Carbon\Carbon::parse($periksa->waktu_diperiksa)->setTimezone('Asia/Jakarta')->format('H:i') }}
                    @else
                        Belum Diperiksa
                    @endif" readonly>
                                </div>

                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="harga">Catatan</label>
                                    <input type="text" class="form-control" id="harga" name="harga" value="{{$periksa->catatan}}" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="harga">Total Obat</label>
                                    <input type="text" class="form-control" id="harga" name="harga" value="{{$periksa->total_obat ?? '-'}}" readonly>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="harga">Total Biaya Periksa</label>
                                    <input type="text" class="form-control" id="harga" name="harga" value="{{$periksa->biaya_periksa !== null ? 'Rp' . number_format($periksa->biaya_periksa, 0, ',', '.') : '-'}}" readonly>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="harga">Status</label>
                                    @if($periksa->status == 'sudah diperiksa')
                                    <input type="text" class="form-control bg-success text-white" id="status" name="status" value="{{$periksa->status}}" readonly>
                                    @else
                                    <input type="text" class="form-control bg-danger text-white" id="status" name="status" value="{{$periksa->status == 'Menunggu' ? 'Belum Diperiksa' : ucfirst($periksa->status)}}" readonly>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->

                    </form>
                    <div class="card-footer">
                        <a href="/list-dokter">
                            <button class="btn btn-warning">Kembali</button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection