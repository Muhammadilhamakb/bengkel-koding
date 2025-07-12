<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\jadwal_periksaModel;
use App\Models\pasienModel;
use Carbon\Carbon;
use App\Models\daftar_poliModel;
use App\Models\periksa;
use App\Models\poliModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class PoliController extends Controller
{
    public function index()
    {
        $pasien = pasienModel::with('user')->get();
        $jadwal = jadwal_periksaModel::with(['dokter.user'])->get();
        $poli = poliModel::all();

        return view('layouts.daftar_poli', compact('pasien', 'jadwal', 'poli',));
    }

    public function poli()
    {
        $user = Auth::user();

        // Ambil pasien yang login
        $pasien = pasienModel::where('user_id', $user->id)->first();
        $periksa = periksa::where('id_pasien', $pasien->id)->latest()->first();

        if (!$pasien) {
            return redirect()->back()->with('error', 'Pasien tidak ditemukan.');
        }

        $jadwal = jadwal_periksaModel::with(['dokter.user'])->get();
        $poli = poliModel::all();
        $riwayat = daftar_poliModel::with(['jadwal.poli', 'jadwal.dokter.user','periksa'])
            ->where('id_pasien', $pasien->id)
            ->get();
        $rekam = pasienModel::generateNoRM();

        return view('layouts.poli', compact('pasien', 'jadwal', 'poli', 'riwayat', 'rekam', 'periksa'));
    }
    public function daftar(Request $request)
    {
        $request->validate([
            'id_pasien' => 'required',
            'id_jadwal' => 'required',
            'tanggal_daftar' => 'required|date',
        ]);

        $id_pasien = $request->input('id_pasien');
        $id_jadwal = $request->input('id_jadwal');
        $tanggal_daftar = $request->input('tanggal_daftar');

        // Ambil data jadwal dan poli
        $jadwal = jadwal_periksaModel::with('poli')->findOrFail($id_jadwal);
        $id_poli = $jadwal->id_poli;
        $kodePoli = $jadwal->poli->kode_poli; // Pastikan kolom ini ada, misalnya "PG", "PJ"

        $tahun = Carbon::parse($tanggal_daftar)->format('Y');

        // Hitung jumlah antrean hari itu di poli yang sama
        $jumlahAntrianHariIni = daftar_poliModel::whereHas('jadwal', function ($query) use ($id_poli) {
            $query->where('id_poli', $id_poli);
        })
            ->where('tanggal_daftar', $tanggal_daftar)
            ->count();

        // Format nomor antrean: 2025-PG-001
        $noAntrian = $tahun . '-' . $kodePoli . '-' . str_pad($jumlahAntrianHariIni + 1, 3, '0', STR_PAD_LEFT);

        daftar_poliModel::create([
            'id_pasien' => $id_pasien,
            'id_jadwal' => $id_jadwal,
            'no_antrean' => $noAntrian,
            'tanggal_daftar' => $tanggal_daftar,
        ]);

        return redirect()->route('poli')->with('success', 'Pendaftaran berhasil! No Antrian Anda: ' . $noAntrian);
    }
}
