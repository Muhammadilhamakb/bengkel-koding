<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Obat;
use App\Models\periksa;

class PasienController extends Controller
{
    public function pasien()
    {

        $dokter = auth()->user();


        if ($dokter->role !== 'dokter') {
            return redirect()->back()->with('error', 'Anda tidak memiliki akses sebagai dokter.');
        }


        $periksas = Periksa::with(['pasienModels.user', 'dokter'])
            ->where('id_dokter', $dokter->id)  // Mengambil pemeriksaan berdasarkan id dokter yang login
            ->get();

        return view('layouts.pemeriksaan', compact('periksas'));
    }

    public function edit($id)
    {

        $periksa = Periksa::with(['pasienModels.user', 'dokter', 'detailPeriksa.obat'])->findOrFail($id);
        $obats = Obat::all();

        // Hitung total harga obat
        $biayaPeriksa = $periksa->biaya_periksa ?? 0;

        $totalHargaObat = 0;
        foreach ($periksa->detailPeriksa as $detail) {
            if ($detail->obat) {
                $totalHargaObat += $detail->obat->harga;
            }
        }


        $totalHarga = $biayaPeriksa + $totalHargaObat;

        // Siapkan array ID obat yang dipilih untuk pre-select di form
        $selectedObatIds = [];
        foreach ($periksa->detailPeriksa as $detail) {
            if ($detail->obat) {
                $selectedObatIds[] = $detail->obat->id;
            }
        }

        return view('layouts.edit_periksa', compact('periksa', 'obats', 'totalHarga'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'catatan' => 'required|string',
            'obat_ids' => 'required|array',
            'obat_ids.*' => 'exists:obats,id',
            'totalHarga' => 'required|numeric',
            'total_obat' => 'required|numeric',
        ]);

        $periksa = Periksa::with('detailPeriksa')->findOrFail($id);

        // Update data pemeriksaan
        $periksa->update([
            'tgl_periksa'     => $request->tanggal,
            'catatan'         => $request->catatan,
            'biaya_periksa'   => $request->totalHarga,
            'totalHarga'      => $request->totalHarga,
            'total_obat'      => $request->total_obat,
            'status'          => 'sudah diperiksa',
            'waktu_diperiksa' => now(),
        ]);

        // Hapus detail lama (agar tidak duplikat)
        $periksa->detailPeriksa()->delete();

        // Simpan ulang ke detail_periksas
        foreach ($request->obat_ids as $obatId) {
            $obat = \App\Models\Obat::find($obatId);

            if ($obat) {
                \App\Models\DetailPeriksa::create([
                    'id_periksa' => $periksa->id,
                    'id_obat'    => $obat->id,
                    'jumlah'     => 1, // Bisa disesuaikan jika ada input jumlah
                    'subtotal'   => $obat->harga,
                ]);
            }
        }

        return redirect()->route('pasien.index')->with('success', 'Data pemeriksaan berhasil diperbarui.');
    }




    public function show($id)
    {
        $periksa = periksa::with(['pasien', 'dokter', 'detail'])->findOrFail($id);
        return view('layouts.periksa', compact('periksa'));
    }
}
