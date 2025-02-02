<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Proses extends Model
{
    protected $fillable = [
        'uuid',
        'user_id',
        'luas_lahan',
        'biaya_produksi',
        'hasil_produksi',
        'dosis_pemupukan',
        'verifikasi',
        'luas_tanah_id',
        'biaya_produksi_id',
        'hasil_produksi_id',
        'dosis_pemupukan_id',
    ];

    public static function booted()
    {
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function HasilProduksi(): BelongsTo
    {
        return $this->belongsTo(HasilProduksi::class);
    }
    public function BiayaProduksi(): BelongsTo
    {
        return $this->belongsTo(Produksi::class);
    }
    public function DosisPemupukan(): BelongsTo
    {
        return $this->belongsTo(DosisPemupukan::class);
    }
    public function luasTanah(): BelongsTo
    {
        return $this->belongsTo(LuasTanah::class);
    }


}
