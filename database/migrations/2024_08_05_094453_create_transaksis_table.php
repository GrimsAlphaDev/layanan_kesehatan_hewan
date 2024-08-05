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
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kriteria_penyakit_menular_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('faksin_id')->constrained();
            $table->string('jenis_binatang');
            $table->string('nama');
            $table->string('jumlah');
            $table->string('total_harga');
            $table->string('status');
            $table->string('bukti_pembayaran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};
