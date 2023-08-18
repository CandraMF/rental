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
            $table->bigInteger('member_id')->unsigned();
            $table->bigInteger('petugas_id')->nullable()->unsigned();
            $table->foreignId('kendaraan_id')->constrained();
            $table->foreignId('pengembalian_id')->nullable()->constrained();
            $table->date('tanggal_sewa');
            $table->integer('lama_sewa');
            $table->integer('total_bayar');
            $table->integer('uang_muka');
            $table->string('kuitansi')->nullable();
            $table->timestamps();

            $table->foreign('member_id')->references('id')->on('members');
            $table->foreign('petugas_id')->references('id')->on('petugas');
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
