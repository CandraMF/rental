<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['nama', 'no_ktp', 'no_sim', 'ttl', 'no_telp', 'email', 'alamat'];

    public function user()
    {
        return $this->hasOne(User::class, 'user_id', 'id');
    }

    public function penyewaans()
    {
        return $this->hasMany(Penyewaan::class, 'member_id', 'id');
    }
}
