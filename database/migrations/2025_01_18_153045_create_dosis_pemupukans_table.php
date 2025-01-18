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
        Schema::create('dosis_pemupukans', function (Blueprint $table) {
            $table->id();
            $table->uuid('uuid');
            $table->foreignId('komoditas_id')->constrained('komoditas');
            $table->foreignId('musim_tanam_id')->constrained('musim_tanams');
            $table->string('dosis_pemupukan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('dosis_pemupukans');
    }
};
