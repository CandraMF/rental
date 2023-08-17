<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Petugas extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function penyewaans()
    {
        return $this->hasMany(Penyewaan::class, 'id', 'petugas_id');
    }

    public function pengembalian()
    {
        return $this->hasMany(Pengembalian::class, 'id', 'petugas_id');
    }
}
