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
        Schema::create('pengembalians', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('petugas_id')->nullable()->unsigned();
            $table->date('tanggal_kembali')->nullable();
            $table->integer('sisa_bayar');
            $table->integer('denda')->nullable();
            $table->text('catatan')->nullable();
            $table->string('kuitansi_denda')->nullable();
            $table->timestamps();

            $table->foreign('petugas_id')->references('id')->on('petugas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pengembalians');
    }
};
