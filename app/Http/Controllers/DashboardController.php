<?php

namespace App\Http\Controllers;

use App\Charts\MonthlyUsersChart;
use App\Charts\PenyewaanCart;
use App\Charts\TopMembers;
use App\Models\Kendaraan;
use App\Models\Member;
use App\Models\Penyewaan;
use App\Models\Petugas;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(MonthlyUsersChart $pieChart, TopMembers $topMembers, PenyewaanCart $penyewaanCart)
    {
        $total_kendaraan = Kendaraan::count();
        $total_petugas = Petugas::count();
        $total_member = Member::count();
        $total_penyewaan = Penyewaan::count();

        return view('administrasi.dashboard', [
            'pieChart' => $pieChart->build(),
            'topMembers' => $topMembers->build(),
            'penyewaanCart' => $penyewaanCart->build(),
            'total_kendaraan' => $total_kendaraan,
            'total_petugas' => $total_petugas,
            'total_member' => $total_member,
            'total_penyewaan' => $total_penyewaan,
        ]);
    }

    public function member()
    {
        $kendaraans = Kendaraan::paginate(10);

        return view('member.dashboard', [
            'kendaraans' => $kendaraans
        ]);
    }

    public function petugas(MonthlyUsersChart $pieChart, TopMembers $topMembers, PenyewaanCart $penyewaanCart)
    {
        $total_kendaraan = Kendaraan::count();
        $total_petugas = Petugas::count();
        $total_member = Member::count();
        $total_penyewaan = Penyewaan::count();

        return view('administrasi.dashboard', [
            'pieChart' => $pieChart->build(),
            'topMembers' => $topMembers->build(),
            'penyewaanCart' => $penyewaanCart->build(),
            'total_kendaraan' => $total_kendaraan,
            'total_petugas' => $total_petugas,
            'total_member' => $total_member,
            'total_penyewaan' => $total_penyewaan,
        ]);
    }
}
