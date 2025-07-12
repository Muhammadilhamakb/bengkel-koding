<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class dokterModel extends Model
{
    protected $table = 'dokter';


    protected $fillable = [
        'user_id',
        'gelar',
        'id_poli',
    ];


    public function poli()
    {
        return $this->belongsTo(poliModel::class, 'id_poli');
    }

    public function jadwal_periksa()
    {
        return $this->hasMany(jadwal_periksaModel::class, 'id_dokter');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
