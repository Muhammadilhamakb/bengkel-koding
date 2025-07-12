<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class jadwal_periksaModel extends Model
{
    //
    protected $table = 'jadwal_periksa';


    protected $fillable = [
        'id_dokter',
        'id_poli',
        'hari',
        'jam_mulai',
        'jam_selesai',
        'status_aktif',
    ];
  


    public function dokter()
    {
        return $this->belongsTo(dokterModel::class, 'id_dokter');
    }
    public function DaftarPoli()
    {
        return $this->hasMany(daftar_poliModel::class, 'id_jadwal');
    }
    public function poli()
    {
        return $this->belongsTo(poliModel::class, 'id_poli');
    }
}
