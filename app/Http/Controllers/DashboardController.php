<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\periksa;
class DashboardController extends Controller
{
    public function count_user()
    {
        $countusers = User::count();
        $countpasien = User::where('role', 'pasien')->count();
        $countdokter = User::where('role', 'dokter')->count();
        $countperiksa = periksa::count();

        return view('layouts.dashboard', compact('countusers', 'countpasien', 'countdokter','countperiksa'));
    }

    public function count_pasien()
    {
        $countpasien = User::where('role', 'pasien')->count(); // Hitung semua user
        return view('layouts.dashboard', compact('countpasien'));
    }
}
