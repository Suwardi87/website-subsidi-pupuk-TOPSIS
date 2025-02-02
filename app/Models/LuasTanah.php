<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class LuasTanah extends Model
{
    protected $fillable = [
        'uuid',
        'luas_lahan',
        'slug',
        'interval',
        'bobot',
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }
}
