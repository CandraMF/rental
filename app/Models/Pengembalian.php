<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengembalian extends Model
{
    use HasFactory; 
    
    protected $fillable = ['petugas_id', 'tanggal_kembali', 'sisa_bayar', 'denda'];

    public function petugas()
    {
        return $this->belongsTo(Petugas::class, 'petugas_id', 'id');
    }

    public function penyewaan()
    {
        return $this->hasOne(Penyewaan::class, 'id', 'pengembalian_id');
    }
}
