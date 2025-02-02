<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class DosisPemupukan extends Model
{
    protected $fillable = [
        'uuid',
        'dosis_pemupukan',
        'interval',
        'slug',
        'bobot',
        'deskripsi'
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }
}
