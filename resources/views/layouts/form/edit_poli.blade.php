@extends('layouts.main')
@section('content-header')
<div class="container-fluid">
    <div class="row mb-2">
        <div class="col-sm-6">
            <h1>Kelola Poli</h1>
        </div>
        <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Kelola Poli</li>
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
                    <h3 class="card-title">Form Edit Poli</h3>
                </div>
                <!-- form start -->
                <form action="{{route('admin.updatepoli',$poli->id)}}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="id_poli">Nama Poli</label>
                                <select name="id_poli" id="id_poli" class="form-control" required>
                                    <option value="" disabled selected>Pilih Poli</option>
                                    @foreach ($polis as $item)
                                    <option value="{{ $item->id }}"
                                        data-spesialis="{{ $item->spesialis }}"
                                        {{ old('id_poli', $poli->id_poli) == $item->id ? 'selected' : '' }}>
                                        {{ $item->nama_poli }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="id_dokter">Nama Dokter</label>
                                <select name="id_dokter" id="id_dokter" class="form-control" required>
                                    <option value="" disabled selected>Pilih Dokter</option>
                                    @foreach ($dokters as $dokter)
                                    <option value="{{ $dokter->id }}"
                                        {{ old('id_dokter', $poli->id_dokter) == $dokter->id ? 'selected' : '' }}>
                                        {{ $dokter->user->nama }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label for="hari">Jadwal Hari</label>
                                <select name="hari" id="hari" class="form-control" required>
                                    <option value="Senin" {{ old('hari',$poli->hari) == 'Senin' ? 'selected' : '' }}>Senin</option>
                                    <option value="Selasa" {{ old('hari',$poli->hari) == 'Selasa' ? 'selected' : '' }}>Selasa</option>
                                    <option value="Rabu" {{ old('hari',$poli->hari) == 'Rabu' ? 'selected' : '' }}>Rabu</option>
                                    <option value="Kamis" {{ old('hari',$poli->hari) == 'Kamis' ? 'selected' : '' }}>Kamis</option>
                                    <option value="Jumat" {{ old('hari',$poli->hari) == 'Jumat' ? 'selected' : '' }}>Jumat</option>
                                    <option value="Sabtu" {{ old('hari',$poli->hari) == 'Sabtu' ? 'selected' : '' }}>Sabtu</option>
                                    <option value="Minggu" {{ old('hari',$poli->hari) == 'Minggu' ? 'selected' : '' }}>Minggu</option>
                                </select>
                            </div>
                            <div class="form-group col-md-6">
                                <label for="jam_mulai">Jadwal Jam Mulai</label>
                                <input type="time" class="form-control" id="jam_mulai" name="jam_mulai" value="{{old('jam_mulai',$poli->jam_mulai)}}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="jam_selesai">Jadwal Jam Akhir</label>
                                <input type="time" class="form-control" id="jam_selesai" name="jam_selesai" value="{{old('jam_selesai',$poli->jam_selesai)}}" required>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="status_aktif">Status Aktif</label>
                                <select name="status_aktif" id="status_aktif" class="form-control" required>
                                    <option value="1" {{ old('status_aktif',$poli->status_aktif) == '1' ? 'selected' : '' }}>Buka</option>
                                    <option value="0" {{ old('status_aktif',$poli->status_aktif) == '0' ? 'selected' : '' }}>Tutup</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="spesialis">Spesialis</label>
                                <input type="text" class="form-control" id="spesialis" name="spesialis"
                                    value="{{ $poli->poli->spesialis }}" readonly required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 ml-4">
                            <button type="submit" class="btn btn-warning">Edit</button>
                            <!-- /.card-body -->

                            <a href="/admin-kelola-poli" class="btn btn-info">
                                Kembali
                            </a>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('id_poli').addEventListener('change', function() {
        var selectedOption = this.options[this.selectedIndex];
        var spesialis = selectedOption.getAttribute('data-spesialis');
        document.getElementById('spesialis').value = spesialis;
    });
</script>
@endsection