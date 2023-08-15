<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function member()
    {
        return view('member.dashboard');
    }

    public function petugas()
    {
        return view('petugas.dashboard');
    }
}
