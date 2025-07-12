<ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
    @if (Auth::user()->role == 'dokter')
    <li class="nav-item">
        <a href="/obat" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/periksa" class="nav-link">
            <i class="nav-icon fas fa-stethoscope"></i>
            <p>Pemeriksaan</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/jadwal_periksa" class="nav-link">
            <i class="nav-icon fas fa-calendar-check"></i>
            <p>Jadwal Periksa</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/riwayatpasien" class="nav-link">
            <i class="nav-icon fas fa-file-medical-alt"></i>
            <p>Riwayat Periksa Pasien</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/list-obat" class="nav-link">
            <i class="nav-icon fas fa-pills"></i>
            <p>Obat <span class="right badge badge-danger">New</span></p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/profile" class="nav-link">
            <i class="nav-icon fas fa-user-md"></i>
            <p>Profile</p>
        </a>
    </li>

    @elseif (Auth::user()->role == 'pasien')
    <li class="nav-item">
        <a href="/dokter" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/list-dokter" class="nav-link">
            <i class="nav-icon fas fa-user-md"></i>
            <p>Pemeriksaan</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/poli" class="nav-link">
            <i class="nav-icon fas fa-hospital-symbol"></i>
            <p>Poli</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/profile" class="nav-link">
            <i class="nav-icon fas fa-user"></i>
            <p>Profile</p>
        </a>
    </li>

    @elseif (Auth::user()->role == 'admin')
    <li class="nav-item">
        <a href="/dokter" class="nav-link">
            <i class="nav-icon fas fa-home"></i>
            <p>Dashboard</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/admin-kelola-obat" class="nav-link">
            <i class="nav-icon fas fa-capsules"></i>
            <p>Kelola Obat</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/admin-kelola-poli" class="nav-link">
            <i class="nav-icon fas fa-clinic-medical"></i>
            <p>Kelola Poli</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/admin-kelola-pasien" class="nav-link">
            <i class="nav-icon fas fa-users"></i>
            <p>Kelola Pasien</p>
        </a>
    </li>
    <li class="nav-item">
        <a href="/admin-kelola-dokter" class="nav-link">
            <i class="nav-icon fas fa-user-md"></i>
            <p>Kelola Dokter</p>
        </a>
    </li>
    @endif

    <li class="nav-item mt-3">
        <form action="{{ route('logout') }}" method="POST" style="display: inline;">
            @csrf
            <button type="submit" class="btn btn-danger btn-block">
                <i class="fas fa-sign-out-alt"></i> Logout
            </button>
        </form>
    </li>
</ul>