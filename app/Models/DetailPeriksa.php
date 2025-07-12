<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class DetailPeriksa extends Model
{
    protected $table = 'detail_periksas';
  

    protected $fillable = [
        'id_periksa',
        'id_obat',
        'jumlah',
        'subtotal',
    ];
    protected function casts(): array
    {
        return [
            'jumlah' => 'integer',
            'subtotal' => 'float',
        ];
    }

    public function periksa(): BelongsTo
    {
        return $this->belongsTo(periksa::class, 'id_periksa');
    }

    public function obat(): BelongsTo
    {
        return $this->belongsTo(Obat::class, 'id_obat');
    }
}
