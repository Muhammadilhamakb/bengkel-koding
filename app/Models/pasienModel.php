<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class pasienModel extends Model
{
    //
    protected $table = 'pasien';


    protected $fillable = [
        'user_id',
        'no_ktp',
        'no_hp',
        'no_rm',

    ];


    protected function casts(): array
    {
        return [

            'no_ktp' => 'integer',
            'no_hp' => 'integer',
        ];
    }
    public function DaftarPoli()
    {
        return $this->hasMany(daftar_poliModel::class, 'id_pasien');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function periksas()
    {
        return $this->hasMany(\App\Models\periksa::class, 'id_pasien');
    }
    public static function generateNoRM()
    {
        $yearMonth = date('Ym');
        $count = \App\Models\pasienModel::whereMonth('created_at', date('m'))
            ->whereYear('created_at', date('Y'))
            ->count() + 1;

        return $yearMonth . '-' . str_pad($count, 3, '0', STR_PAD_LEFT);
    }
}
