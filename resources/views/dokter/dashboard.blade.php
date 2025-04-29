@extends('components.layout')

@section('nav-content')
    <ul class="nav">
        <li class="nav-item"><a href="{{ route('dokter.dashboard') }}" class="nav-link"><i class="nav-icon fas fa-tachometer-alt"></i> Dashboard</a></li>
        <li class="nav-item"><a href="{{ route('dokter.obat') }}" class="nav-link"><i class="nav-icon fas fa-th"></i> Obat</a></li>
        <li class="nav-item"><a href="{{ route('dokter.periksa') }}" class="nav-link"><i class="nav-icon fas fa-book"></i> Periksa</a></li>
    </ul>
@endsection

@section('content')
    <div class="container-fluid py-4 animate__animated animate__fadeIn">
        <h2 class="mb-4 fw-bold text-primary">Dashboard Dokter</h2>

        <div class="row g-4">
            <div class="col-md-6 col-xl-3">
                <div class="card shadow rounded-4 border-0 bg-info text-white h-100">
                    <div class="card-body">
                        <h3>{{ $totalObat }}</h3>
                        <p class="mb-0">Total Obat</p>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <i class="ion ion-bag fs-4"></i> <a href="#" class="text-white text-decoration-none float-end">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card shadow rounded-4 border-0 bg-success text-white h-100">
                    <div class="card-body">
                        <h3>{{ $totalPeriksa }}<sup style="font-size: 16px;"> ORANG</sup></h3>
                        <p class="mb-0">Sudah Diperiksa</p>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <i class="ion ion-stats-bars fs-4"></i> <a href="#" class="text-white text-decoration-none float-end">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card shadow rounded-4 border-0 bg-warning text-dark h-100">
                    <div class="card-body">
                        <h3>{{ $totalDokter }}</h3>
                        <p class="mb-0">Total Dokter</p>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <i class="ion ion-person-add fs-4"></i> <a href="#" class="text-dark text-decoration-none float-end">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="card shadow rounded-4 border-0 bg-danger text-white h-100">
                    <div class="card-body">
                        <h3>{{ $totalPelangan }}</h3>
                        <p class="mb-0">Total Pelanggan</p>
                    </div>
                    <div class="card-footer bg-transparent border-top-0">
                        <i class="ion ion-pie-graph fs-4"></i> <a href="#" class="text-white text-decoration-none float-end">More info <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        @if(session('welcome_message'))
            <div class="alert alert-success mt-4 rounded-4">
                {{ session('welcome_message') }}
            </div>
        @endif

        @if(Auth::check())
            <div class="mt-2 text-muted">Welcome, <strong>{{ Auth::user()->name }}</strong>!</div>
        @endif
    </div>
@endsection
