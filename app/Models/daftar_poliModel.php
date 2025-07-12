<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class daftar_poliModel extends Model
{
    //
    protected $table = 'daftar_poli';
   

    protected $fillable = [
        'id_pasien',
        'id_jadwal',
        'tanggal_daftar',
        'no_antrean',
    ];

    protected function casts(): array
    {
        return [
            'tanggal_daftar' => 'date'
        ];
    }

    public function pasien()
    {
        return $this->belongsTo(pasienModel::class, 'id_pasien');
    }

    public function jadwal()
    {
        return $this->belongsTo(jadwal_periksaModel::class, 'id_jadwal');
    }
    public function periksa()
    {
        return $this->hasOne(periksa::class, 'id_daftar');
    }
   
}
