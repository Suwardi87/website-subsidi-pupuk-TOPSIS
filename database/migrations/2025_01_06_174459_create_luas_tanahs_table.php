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
        Schema::create('luas_tanahs', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->float('luas_lahan');
            $table->string('interval');
            $table->string('lokasi_lahan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('luas_tanahs');
    }
};
