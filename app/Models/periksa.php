<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class periksa extends Model
{
    protected $table = 'periksas';


    protected $fillable = [
        'id_pasien',
        'id_dokter',
        'tgl_periksa',
        'catatan',
        'totalHarga',
        'biaya_periksa',
        'status',
        'id_daftar',
        'total_obat',
        'keluhan',
        'waktu_diperiksa'
    ];

    //menggunakan belongs to karena merupakan child atau anak,dimana id_dokter,dan id_pasien mempunyai relasi ke id users
    //relasi ke user sebagai dokter

    protected function casts(): array
    {
        return [
            'tgl_periksa' => 'date',
            'total_harga' => 'float',
            'biaya_periksa' => 'float',
            'total_obat' => 'integer',
        ];
    }

    public function dokter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_dokter');
    }

    //relasi ke user sebagai pasien
    public function pasien(): BelongsTo
    {
        return $this->belongsTo(User::class, 'id_pasien');
    }

    public function detailPeriksa(): HasMany
    {
        return $this->hasMany(DetailPeriksa::class, 'id_periksa');
    }
    public function obats(): BelongsToMany
    {
        return $this->belongsToMany(Obat::class, 'obat_periksa', 'periksa_id', 'obat_id');
    }
    public function daftarPoli()
    {
        return $this->belongsTo(daftar_poliModel::class, 'id_daftar');
    }

    public function pasienModels()
    {
        return $this->belongsTo(pasienModel::class, 'id_pasien');
    }
}
