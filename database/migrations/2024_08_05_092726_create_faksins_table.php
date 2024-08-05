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
        Schema::create('faksins', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kriteria_penyakit_menular_id')->constrained();
            $table->string('obat_faksin');
            $table->integer('harga');
            $table->text('deskripsi');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('faksins');
    }
};
