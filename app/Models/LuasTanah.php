<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class LuasTanah extends Model
{
    protected $fillable = [
        'uuid',
        'luas_lahan',
        'interval',
        'lokasi_lahan',
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }
}
