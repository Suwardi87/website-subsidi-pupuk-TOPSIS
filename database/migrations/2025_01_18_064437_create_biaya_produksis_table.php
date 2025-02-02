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
        Schema::create('biaya_produksis', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->string('biaya_produksi');
            $table->string('slug');
            $table->text('deskripsi');
            $table->float('bobot');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('komoditas');
    }
};
