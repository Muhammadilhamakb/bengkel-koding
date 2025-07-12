 @extends('layouts.main')
 @section('content-header')
 @if ($errors->has('daftar_error'))
 <div class="alert alert-danger">
     {{ $errors->first('daftar_error') }}
 </div>
 @endif

 @if (session('success'))
 <div class="alert alert-success">
     {{ session('success') }}
 </div>
 @endif
 <section class="content">
     <div class="container-fluid">
         <div class="row">
             <div class="col-4" style="margin: 10px 10px 10px 0px;">
                 <!-- Registrarion poli -->
                 <p style="color: red;">Jika Anda Belum mendaftar,silahkan daftar dibawah ini!</p>
                 <a href="/daftar-poli">
                     <button class="btn btn-danger">Daftar Poli</button>
                 </a>
                 <!-- End registrarion poli -->
             </div>
             <br>
             <div class="row">
                 <div class="col-4">
                     <!-- Registrarion poli -->
                     <div class="card">
                         <h5 class="card-header bg-primary">Daftar Poli</h5>
                         <div class="card-body">

                             <form action="" method="POST">
                                 <input type="hidden" value="145" name="id_pasien">
                                 <div class="mb-3">
                                     <label for="no_rm" class="form-label">Nomor Rekam Medis</label>
                                     <input type="text " class="form-control" id="no_rm" placeholder="nomor rekam medis" name="no_rm" value="{{$rekam}}" readonly>
                                 </div>

                                 <div class="mb-3">
                                     <label for="inputPoli" class="form-label">Nama Pasien</label>
                                     <input type="text " class="form-control" id="no_rm" placeholder="nomor rekam medis" name="name" value="{{ $pasien->user->nama }}" readonly>
                                 </div>

                                 <div class="mb-3">
                                     <label for="inputJadwal" class="form-label">Alamat</label>
                                     <input type="text " class="form-control" id="no_rm" placeholder="nomor rekam medis" name="name" value="{{ $pasien->user->alamat }}" readonly>
                                 </div>

                                 <div class="mb-3">
                                     <label for="keluhan" class="form-label">Keluhan Terakhir</label>
                                     <input type="text " class="form-control" id="keluhan" placeholder="keluhan terakhir" name="keluhan" value="{{ $periksa->keluhan ?? 'belum ada keluhan' }}" readonly>
                                 </div>

                             </form>

                         </div>
                     </div>
                     <!-- End registrarion poli -->
                 </div>
                 <div class="col-8">
                     <!-- Registration poli history -->
                     <div class="card">
                         <h5 class="card-header bg-primary">Riwayat daftar poli</h5>
                         <div class="card-body">
                             <table class="table table-striped">
                                 <thead>
                                     <tr>
                                         <th scope="col">No.</th>
                                         <th scope="col">Poli</th>
                                         <th scope="col">Dokter</th>
                                         <th scope="col">Hari</th>
                                         <th scope="col">Jam Operesinonal Dokter</th>
                                         <th scope="col">Waktu Selesai Pemeriksaan</th>
                                         <th scope="col">Antrian</th>
                                         <th scope="col">Tanggal Daftar</th>
                                         <th scope="col">Status</th>
                                         <th scope="col">Keterangan</th>
                                     </tr>
                                 </thead>
                                 <tbody>

                                     @forelse ($riwayat as $index => $item)
                                     <tr>
                                         <td>{{ $index + 1 }}</td>
                                         <td>{{ $item->jadwal->poli->nama_poli ?? '-' }}</td>
                                         <td>{{ $item->jadwal->dokter->user->nama ?? '-' }} </td>
                                         <td>{{ $item->jadwal->hari ?? '-' }}</td>
                                         <td>{{ $item->jadwal->jam_mulai ?? '-' }} s/d {{ $item->jadwal->jam_selesai ?? '-' }}</td>
                                         <td>
                                             @if ($item->periksa && $item->periksa->status === 'sudah diperiksa' && $item->periksa->waktu_diperiksa)
                                             {{ \Carbon\Carbon::parse($item->periksa->waktu_diperiksa)->setTimezone('Asia/Jakarta')->format('H:i') }}
                                             @else
                                             Belum Diperiksa
                                             @endif
                                         </td>
                                         <td>{{ $item->no_antrean }}</td>
                                         <td>{{ \Carbon\Carbon::parse($item->tanggal_daftar)->format('d-m-Y') }}</td>
                                         <td>
                                             <span class="badge bg-success">Terdaftar</span>
                                         </td>
                                         <td>Anda Sudah Terdaftar Silahkan Ditunggu!</td>
                                     </tr>
                                     @empty
                                     <tr>
                                         <td colspan="9" align="center">Tidak ada data</td>
                                     </tr>
                                     @endforelse
                                 </tbody>
                             </table>


                         </div>
                     </div>
                     <!-- End registration poli history -->
                 </div>
             </div>
             <span><strong>Jika Sudah Terdaftar, Silahkan Langsung ke Menu Pemeriksaan Untuk Melanjutkan!</strong></span>

         </div><!-- /.container-fluid -->
 </section>
 <section class="content">
     <div class="container-fluid">

         <div class="row">




         </div><!-- /.container-fluid -->
 </section>
 @endsection