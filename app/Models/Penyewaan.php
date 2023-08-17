<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penyewaan extends Model
{
    use HasFactory;

    protected $fillable = ['kendaraan_id', 'tanggal_sewa', 'lama_sewa', 'member_id', 'uang_muka', 'status', 'total_bayar', 'pengembalian_id', 'petugas_id'];

    public function member()
    {
        return $this->belongsTo(User::class, 'member_id', 'id');
    }

    public function petugas()
    {
        return $this->belongsTo(User::class, 'petugas_id', 'id');
    }

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'kendaraan_id', 'id');
    }

    public function pengembalian()
    {
        return $this->belongsTo(pengembalian::class, 'pengembalian_id', 'id');
    }
}
