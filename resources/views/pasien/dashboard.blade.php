@extends('components.layout')

@section('nav-content')
<ul class="nav flex-column mb-4">
    <li class="nav-item">
        <a href="{{ route('pasien.dashboard') }}" class="nav-link active">
            <i class="nav-icon fas fa-tachometer-alt"></i> Dashboard
        </a>
    </li>
    <li class="nav-item">
        <a href="{{ route('pasien.periksa') }}" class="nav-link">
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
<section class="content animate__animated animate__fadeIn">
    <div class="container py-4">
        <h2 class="mb-4 fw-bold text-primary">Selamat Datang di Dashboard 👋</h2>

        @if(session('welcome_message'))
            <div class="alert alert-info">
                {{ session('welcome_message') }}
            </div>
        @endif

        @if(Auth::check())
            <p class="mb-4">Halo, <strong>{{ Auth::user()->name }}</strong>! Semoga harimu menyenangkan 😊</p>
        @endif

        <div class="row g-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 rounded-4 bg-info text-white h-100">
                    <div class="card-body d-flex flex-column justify-content-between">
                        <div>
                            <h3 class="card-title fw-bold">{{ $totalPeriksa }}</h3>
                            <p class="card-text">Total Periksa</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <i class="ion ion-bag fs-1"></i>
                            <a href="#" class="text-white text-decoration-underline">Selengkapnya <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Box lainnya bisa ditambahkan di sini jika sudah siap --}}
        </div>
    </div>
</section>
@endsection
