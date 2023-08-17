<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function member()
    {
        $kendaraans = Kendaraan::paginate(10);

        return view('member.dashboard', [
            'kendaraans' => $kendaraans
        ]);
    }

    public function petugas()
    {
        return view('petugas.dashboard');
    }
}
