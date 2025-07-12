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
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif


    <table id="example1" class="table table-bordered table-hover">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Tanggal Pemeriksaan</th>
                <th>Selesai Pemeriksaan</th>
                <th>Keterangan</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($periksas as $periksa)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $periksa->pasienModels->user->nama ?? '-' }}</td> {{-- Nama pasien --}}
                <td>{{ \Carbon\Carbon::parse($periksa->tgl_periksa ?? 'N/A')->format('d-m-Y') }}</td>
                <td>
                    @if ($periksa->waktu_diperiksa)
                    {{ \Carbon\Carbon::parse($periksa->waktu_diperiksa)->setTimezone('Asia/Jakarta')->format('H:i') }}
                    @else
                    Belum Diperiksa
                    @endif
                </td>
                <td>{{$periksa->status == 'Menunggu' ? 'Belum Diperiksa' : ucfirst($periksa->status)}}</td>
                <td class="text-center">
                    <a href="{{ route('pasien.edit', $periksa->id) }}"
                        class="btn btn-sm {{ $periksa->status == 'sudah diperiksa' ? 'btn-primary' : 'btn-warning' }}">
                        {{ $periksa->status == 'sudah diperiksa' ? 'Edit' : 'Periksa' }}
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>

    </table>
</div>