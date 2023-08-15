<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    use HasFactory;

    protected $fillable = ['plat_nomor', 'no_stnk', 'nama_kendaraan', 'harga_sewa', 'status'];

    
}
