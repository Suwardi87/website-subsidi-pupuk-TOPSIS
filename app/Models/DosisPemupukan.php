<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DosisPemupukan extends Model
{
    protected $fillable = [
        'uuid',
        'komoditas_id',
        'musim_tanam_id',
        'dosis_pemupukan',
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function komoditas(): BelongsTo
    {
        return $this->belongsTo(Komoditas::class);
    }
    public function musimTanam(): BelongsTo
    {
        return $this->belongsTo(MusimTanam::class);
    }
}
