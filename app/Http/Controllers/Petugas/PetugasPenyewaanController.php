<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\Member;
use App\Models\Pengembalian;
use App\Models\Penyewaan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PetugasPenyewaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penyewaans = Penyewaan::with(['petugas', 'member', 'pengembalian', 'kendaraan:id,nama_kendaraan,plat_nomor,status'])
            ->where('status', 1)
            ->where('petugas_id', Auth::user()->petugas->id)
            ->paginate(10);

        return view('petugas.penyewaan.index', ['penyewaans' => $penyewaans]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $kendaraans = Kendaraan::orderBy('status')->get();
        $members = Member::with('user')->orderBy('nama')->get();

        return view('petugas.penyewaan.create', [
            'members' => $members,
            'kendaraans' => $kendaraans,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validated = $request->validate([
            'kendaraan_id' => 'required',
            'member_id' => 'required',
            'total_bayar' => 'required|numeric',
            'lama_sewa' => 'required|numeric|min:1',
            'uang_muka' => 'required|numeric|lte:total_bayar',
            'sisa_bayar' => 'required',
        ]); 

        $pengembalian = Pengembalian::create([
            'sisa_bayar' => $request->sisa_bayar,
        ]);

        $penyewaan = Penyewaan::create([
            'member_id' => $request->member_id,
            'petugas_id' =>  Auth::user()->petugas->id,
            'kendaraan_id' => $request->kendaraan_id,
            'total_bayar' =>  $request->total_bayar,
            'lama_sewa' =>  $request->lama_sewa,
            'uang_muka' =>  $request->uang_muka,
            'tanggal_sewa' => now(),
            'pengembalian_id' => $pengembalian->id,
            'status' => 1,
        ]);

        return redirect(route('petugas.penyewaan.index'))->with([
            'status' => 'saved',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
