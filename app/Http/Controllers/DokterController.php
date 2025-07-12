<?php

namespace App\Http\Controllers;

use App\Models\daftar_poliModel;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\periksa;
use App\Models\dokterModel;
use App\Models\jadwal_periksaModel;
use App\Models\pasienModel;
use App\Models\poliModel;
use Illuminate\Validation\ValidationException;

class DokterController extends Controller
{
    public function index()
    {
        $dokters = User::where('role', 'dokter')->get();
        return view('layouts.dashboard', compact('dokters'));
    }
    public function byDokter(Request $request)
    {
        // Ambil semua user dengan role dokter (untuk dropdown)
        $dokters = User::where('role', 'dokter')->get();

        // Ambil data pasien dari user yang login
        $pasien = pasienModel::where('user_id', auth()->id())->first();

        // Ambil riwayat periksa untuk ditampilkan
        $periksas = Periksa::with('dokter', 'pasien', 'daftarPoli.jadwal.poli')
            ->where('id_pasien', $pasien->id)
            ->get();

        // Jika ada pengiriman form
        if ($request->isMethod('post')) {
            $request->validate([
                'id_dokter' => 'required|exists:users,id',
                'no_antrean' => 'required|string',
                'keluhan' => 'required|string'
            ]);

            // Ambil daftar_poli berdasarkan pasien & nomor antrean
            $daftarList = daftar_poliModel::with('jadwal.dokter', 'jadwal.poli')
                ->where('id_pasien', $pasien->id)
                ->where('no_antrean', $request->no_antrean)
                ->get();

            if ($daftarList->isEmpty()) {
                return redirect()->back()->with('error', 'Nomor antrean tidak ditemukan. Jika belum mendaftar silakan daftar terlebih dahulu!');
            }

            $valid = false;

            foreach ($daftarList as $daftar) {
                $jadwal = $daftar->jadwal;

                if (!$jadwal || !$jadwal->dokter) {
                    continue; // Skip kalau tidak ada jadwal atau dokter
                }

                // Pastikan dokter yang dipilih user cocok dengan dokter dari jadwal tersebut
                if ($jadwal->dokter->user_id == $request->id_dokter) {
                    // Cek apakah sudah ada pemeriksaan untuk nomor antrean ini
                    $sudahAda = Periksa::where('id_daftar', $daftar->id)->exists();
                    if ($sudahAda) {
                        return redirect()->back()->with('error', 'Anda sudah mendaftar pemeriksaan dengan nomor antrean ini.');
                    }

                    // Simpan data pemeriksaan
                    Periksa::create([
                        'id_pasien' => $pasien->id,
                        'id_dokter' => $request->id_dokter,
                        'tgl_periksa' => $request->tgl_periksa ?? now(),
                        'catatan' => $request->catatan ?? 'belum ada catatan',
                        'biaya_periksa' => $request->biaya_periksa !== 'belum ada biaya periksa' ? $request->biaya_periksa : null,
                        'id_daftar' => $daftar->id,
                        'status' => 'Menunggu',
                        'keluhan' => $request->keluhan ?? 'belum ada keluhan',
                    ]);

                    $valid = true;
                    break;
                }
            }

            if (!$valid) {
                return redirect()->back()->with('error', 'Dokter yang dipilih tidak sesuai dengan jadwal dari nomor antrean Anda.');
            }

            return redirect()->route('periksa.byDokter')->with('success', 'Berhasil memilih Dokter. Silakan masuk ke ruang periksa.');
        }

        // Ambil semua daftar_poli milik pasien untuk ditampilkan di tabel riwayat
        $daftars = daftar_poliModel::with('jadwal.poli')
            ->where('id_pasien', $pasien->id)
            ->get();

        return view('layouts.list_dokter', compact('dokters', 'periksas', 'daftars'));
    }



    public function jadwaldokter()
    {
        $dokter = dokterModel::where('user_id', auth()->id())->first();
        // Pastikan dokter ditemukan
        if (!$dokter) {
            return back()->with('error', 'Akun ini belum terdaftar sebagai dokter.');
        }
        $jadwal = jadwal_periksaModel::with('dokter.user')->where('id_dokter', $dokter->id)->get();
        return view('layouts.jadwal_dokter', compact('jadwal'));
    }
    public function tambahjadwaldokter()
    {
        $dokter = dokterModel::where('user_id', auth()->id())->first();
        // Pastikan dokter ditemukan
        if (!$dokter) {
            return back()->with('error', 'Akun ini belum terdaftar sebagai dokter.');
        }

        $poli = poliModel::all();
        return view('layouts.tambah_jadwal_dokter', compact('dokter', 'poli'));
    }

    public function storejadwaldokter(Request $request)
    {
        $request->validate([
            'id_dokter' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'status_aktif' => 'required',
            'id_poli' => 'required',
        ]);
        $dokter = dokterModel::where('user_id', auth()->id())->first();

        if (!$dokter) {
            return back()->with('error', 'Akun ini belum terdaftar sebagai dokter.');
        }
        // Cek apakah jadwal yang sama sudah ada
        $jadwalSudahAda = jadwal_periksaModel::where('id_dokter', $request->id_dokter)
            ->where('id_poli', $request->id_poli)
            ->where('hari', $request->hari)
            ->where('jam_mulai', $request->jam_mulai)
            ->where('jam_selesai', $request->jam_selesai)
            ->exists();

        if ($jadwalSudahAda) {
            throw ValidationException::withMessages([
                'id_dokter' => 'Dokter sudah memiliki jadwal di poli dan waktu yang sama.',
            ]);
        }
        jadwal_periksaModel::create([
            'id_dokter' => $dokter->id,
            'id_poli' => $request->id_poli,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status_aktif' => $request->status_aktif,

        ]);
        return redirect()->route('jadwl.dokter')->with('success', 'Data Berhsail Ditambahkan');
    }

    public function editjadwaldokter($id)
    {
        $poli = jadwal_periksaModel::with('dokter.user', 'poli')->findOrFail($id);
        $dokters = dokterModel::with('user')->where('user_id', auth()->id())->firstOrFail();
        $polis = poliModel::all();
        return view('layouts.edit_jadwal_dokter', compact('poli', 'dokters', 'polis'));
    }

    public function updatejadwaldokter(Request $request, $id)
    {
        $request->validate([
            'id_poli' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'status_aktif' => 'required',
        ]);
        $dokter = jadwal_periksaModel::findOrFail($id);
        $dokter->update([
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status_aktif' => $request->status_aktif,
        ]);

        return redirect()->route('jadwl.dokter')->with('success', 'Data Berhasil Diupdate');
    }

    public function riwayatpasien()
    {
        $dokter = dokterModel::where('user_id', auth()->id())->first();

        if (!$dokter) {
            return back()->with('error', 'Akun ini belum terdaftar sebagai dokter.');
        }

        // Ambil semua periksa yang ID dokter-nya sesuai dari relasi jadwal
        $riwayat = Periksa::with([
            'detailPeriksa.obat',
            'pasienModels.user',
            'daftarPoli.jadwal'
        ])
            ->whereHas('daftarPoli.jadwal', function ($query) use ($dokter) {
                $query->where('id_dokter', $dokter->id);
            })
            ->where('status', 'sudah diperiksa')
            ->get();

        return view('layouts.riwayat_periksa_pasien', compact('riwayat'));
    }
}
