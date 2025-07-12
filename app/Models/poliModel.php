<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class poliModel extends Model
{
    //
    protected $table = 'poli';


    protected $fillable = [
        'nama_poli',
        'kode_poli',
        'spesialis',
    ];

    public function dokter()
    {
        return $this->hasMany(dokterModel::class, 'id_poli');
    }
    public function jadwalPoli()
    {
        return $this->hasMany(jadwal_periksaModel::class, 'id_poli');
    }
}
