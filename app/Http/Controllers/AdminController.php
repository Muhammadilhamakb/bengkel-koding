<?php

namespace App\Http\Controllers;

use App\Models\dokterModel;
use App\Models\jadwal_periksaModel;
use App\Models\Obat;
use App\Models\pasienModel;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\periksa;
use App\Models\poliModel;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function index()
    {
        $countusers = User::count();
        $countpasien = User::where('role', 'pasien')->count();
        $countdokter = User::where('role', 'dokter')->count();
        $countperiksa = periksa::count();
        return view('layouts.admin', compact('countusers', 'countpasien', 'countdokter', 'countperiksa'));
    }

    public function formpasien()
    {
        $pasien = pasienModel::with('user')->get();

        return view('layouts.form.kelola_pasien', compact('pasien'));
    }

    public function formdokter()
    {

        $dokters = dokterModel::with('user', 'poli', 'jadwal_periksa')->get();
        $user = User::all();

        return view('layouts.form.kelola_dokter', compact('user', 'dokters'));
    }

    public function formpoli()
    {
        $jadwal = jadwal_periksaModel::with('dokter.user', 'poli')->get();
        return view('layouts.form.kelola_poli', compact('jadwal'));
    }

    public function formobat()
    {
        $obats = Obat::all();
        return view('layouts.form.kelola_obat', compact('obats'));
    }

    public function tambah_dokter()
    {
        $poli = poliModel::all();
        return view('layouts.form.tambah_dokter', compact('poli'));
    }

    public function storedokter(Request $request)
    {
        $request->validate([
            'nama' => 'required|string',
            'gelar' => 'required|string',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:users',
            'no_hp' => 'required|numeric|digits_between:12,13',
            'id_poli' => 'required|exists:poli,id',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'role' => 'dokter',
            'password' => 'default'
        ]);

        dokterModel::create([
            'user_id' => $user->id,
            'gelar' => $request->gelar,
            'id_poli' => $request->id_poli

        ]);
        return redirect()->route('admin.dokter')->with('success', 'Data Dokter Berhasil ditambahkan');
    }

    public function editdokter($id)
    {
        $poli = poliModel::all();
        $dokter = dokterModel::with('user', 'poli')->find($id);
        return view('layouts.form.edit_dokter', compact('poli', 'dokter'));
    }

    public function updatedokter(Request $request, $id)
    {
        $dokter = dokterModel::with('user')->findOrFail($id);
        $user = $dokter->user;
        $request->validate([
            'nama' => 'required|string',
            'gelar' => 'required|string',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_hp' => 'required|numeric|digits_between:12,13',
            'id_poli' => 'required|exists:poli,id',
        ]);

        $user->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,

            'no_hp' => $request->no_hp,
        ]);
        $user->email = $request->email;
        $user->save();
        $dokter->update([

            'gelar' => $request->gelar,
            'id_poli' => $request->id_poli
        ]);

        return redirect()->route('admin.dokter')->with('success', 'Data Berhasil di Update');
    }

    public function deleteDokter($id)
    {
        try {
            $dokter = dokterModel::with('user')->findOrFail($id);
            $user = $dokter->user;
            $dokter->delete();
            if ($user) {
                $user->delete();
            }
            return redirect()->route('admin.dokter')->with('success', 'Data Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('admin.dokter')->with('error', 'Data Gagal Dihapus');
        }
    }



    public function tambah_pasien()
    {

        return view('layouts.form.tambah_pasien');
    }

    public function editpasien($id)
    {
        $pasien = pasienModel::with('user')->findOrFail($id);
        return view('layouts.form.edit_pasien', compact('pasien'));
    }

    public function updatepasien(Request $request, $id)
    {
        $pasien = pasienModel::with('user')->findOrFail($id);
        $user = $pasien->user;
        $request->validate([
            'nama' => 'required|string',
            'no_ktp' => 'required|numeric|digits:16',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'no_hp' => 'required|numeric|digits_between:12,13',

        ]);

        $user->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'no_hp' => $request->no_hp,
        ]);

        $pasien->update([

            'no_ktp' => $request->no_ktp,

        ]);

        return redirect()->route('admin.pasien')->with('success', 'Data Berhasil di Update');
    }

    public function storepasien(Request $request)
    {

        $request->validate([
            'nama' => 'required|string',
            'no_ktp' => 'required|numeric|digits:16',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:users',
            'no_hp' => 'required|numeric|digits_between:12,13',

        ]);

        $user = User::create([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'no_hp' => $request->no_hp,
            'role' => 'pasien',
            'password' => 'default'
        ]);

        $rekam = pasienModel::generateNoRM();

        pasienModel::create([
            'user_id' => $user->id,
            'no_ktp' => $request->no_ktp,
            'no_rm' => $rekam
        ]);
        return redirect()->route('admin.pasien')->with('success', 'Data Pasien Berhasil ditambahkan');
    }

    public function deletepasien($id)
    {
        try {
            $pasien = pasienModel::with('user')->findOrFail($id);
            $user = $pasien->user;
            $pasien->delete();
            if ($user) {
                $user->delete();
            }
            return redirect()->route('admin.pasien')->with('success', 'Data Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('admin.pasien')->with('error', 'Data Gagal Dihapus');
        }
    }


    public function tambah_obat()
    {
        $obats = Obat::all();
        return view('layouts.form.tambah_obat', compact('obats'));
    }
    public function editobat($id)
    {
        $obat = Obat::findOrFail($id);
        return view('layouts.form.edit_obat', compact('obat'));
    }

    public function storeobat(Request $request)
    {
        $request->validate([
            'nama_obat' => 'required|string',
            'kemasan' => 'required|string',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string',
        ]);

        Obat::create([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi,
        ]);
        return redirect()->route('admin.obat')->with('success', 'Data Obat Berhasil Ditambahkan ');
    }

    public function updateobat(Request $request, $id)
    {
        $request->validate([
            'nama_obat' => 'required|string',
            'kemasan' => 'required|string',
            'harga' => 'required|numeric',
            'deskripsi' => 'required|string',
        ]);

        $obat = Obat::find($id);
        $obat->update([
            'nama_obat' => $request->nama_obat,
            'kemasan' => $request->kemasan,
            'harga' => $request->harga,
            'deskripsi' => $request->deskripsi
        ]);

        return redirect()->route('admin.obat')->with('success', 'Data Berhasil di Update');
    }
    public function deleteobat($id)
    {
        try {
            $obat = Obat::findOrFail($id);
            $obat->delete();
            return redirect()->route('admin.obat')->with('success', 'Data Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('admin.obat')->with('error', 'Data Gagal Dihapus');
        }
    }


    public function tambah_poli()
    {
        $poli = poliModel::all();
        return view('layouts.form.tambah_poli', compact('poli'));
    }
    public function tambah_jadwalpoli()
    {
        $poli = poliModel::all();
        $dokters = dokterModel::with('user')->get();
        return view('layouts.form.tambah_jadwal', compact('dokters', 'poli'));
    }

    public function storepoli(Request $request)
    {
        $request->validate([
            'kode_poli' => ['required', 'string', 'regex:/^[A-Z]+$/'],
            'nama_poli' => ['required', 'string', 'unique:poli,nama_poli'],
            'spesialis' => 'required|string',
        ], [
            'kode_poli.regex' => 'Kode Poli Harus Huruf Kapital Semua!',
            'nama_poli.unique' => 'Nama Poli Sudah Ada!',
        ]);

        poliModel::create([
            'kode_poli' => strtoupper($request->kode_poli),
            'nama_poli' => $request->nama_poli,
            'spesialis' => $request->spesialis,
        ]);
        return redirect()->route('admin.poli')->with('success', 'Data Berhasil Ditambahkan');
    }
    public function storejadwal(Request $request)
    {
        $request->validate([
            'id_dokter' => 'required',
            'id_poli' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'status_aktif' => 'required',
        ]);
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
            'id_dokter' => $request->id_dokter,
            'id_poli' => $request->id_poli,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status_aktif' => $request->status_aktif,
        ]);
        return redirect()->route('admin.poli')->with('success', 'Data Berhasil Ditambahkan');
    }

    public function updatepoli(Request $request, $id)
    {
        $request->validate([
            'id_dokter' => 'required',
            'id_poli' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required',
            'status_aktif' => 'required',

        ]);

        $polis = jadwal_periksaModel::with('poli')->find($id);
        $polis->update([
            'id_dokter' => $request->id_dokter,
            'id_poli' => $request->id_poli,
            'hari' => $request->hari,
            'jam_mulai' => $request->jam_mulai,
            'jam_selesai' => $request->jam_selesai,
            'status_aktif' => $request->status_aktif,
        ]);


        return redirect()->route('admin.poli')->with('success', 'Data Berhasil di Update');
    }

    public function editpoli($id)
    {
        $poli = jadwal_periksaModel::with('dokter.user', 'poli')->findOrFail($id);
        $dokters = dokterModel::with('user')->get();
        $polis = poliModel::all();
        return view('layouts.form.edit_poli', compact('poli', 'dokters', 'polis'));
    }

    public function deletepoli($id)
    {
        try {
            $poli = jadwal_periksaModel::findOrFail($id);
            $poli->delete();
            return redirect()->route('admin.poli')->with('success', 'Data Berhasil Dihapus');
        } catch (\Illuminate\Database\QueryException $e) {
            return redirect()->route('admin.poli')->with('error', 'Data Gagal Dihapus');
        }
    }
}
