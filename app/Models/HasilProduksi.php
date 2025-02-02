<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class HasilProduksi extends Model
{
    protected $table = "hasil_produksis";
    protected $fillable = [
        'uuid',
        'hasil_produksi',
        'slug',
        'interval',
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
