<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Produksi extends Model
{
    protected $table = 'biaya_produksis';
    protected $fillable = [
        'uuid',
        'biaya_produksi',
        'slug',
        'deskripsi',
        'bobot',
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }
}
