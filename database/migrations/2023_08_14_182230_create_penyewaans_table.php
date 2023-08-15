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
        Schema::create('penyewaans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('member_id')->constrained();
            $table->foreignId('kendaraan_id')->constrained();
            $table->foreignId('petugas_id')->constrained();
            $table->foreignId('pengembalian_id')->constrained();
            $table->date('tanggal_sewa');
            $table->integer('lama_sewa');
            $table->integer('total_bayar');
            $table->integer('uang_muka');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('penyewaans');
    }
};
