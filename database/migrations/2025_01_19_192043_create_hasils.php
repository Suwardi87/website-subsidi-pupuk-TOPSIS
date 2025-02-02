<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('hasils', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->float('luas_lahan')->nullable();
            $table->float('biaya_produksi')->nullable();
            $table->float('hasil_produksi')->nullable();
            $table->float('dosis_pemupukan')->nullable();
            $table->foreignId('luas_tanah_id')->nullable()->constrained('luas_tanahs');
            $table->foreignId('biaya_produksi_id')->nullable()->constrained('biaya_produksis');
            $table->foreignId('hasil_produksi_id')->nullable()->constrained('hasil_produksis');
            $table->foreignId('dosis_pemupukan_id')->nullable()->constrained('dosis_pemupukans');
            $table->enum('verifikasi', ['setuju', 'tolak'])->nullable()->default('tolak');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proses');
    }
};
