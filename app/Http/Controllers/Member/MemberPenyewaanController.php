<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\Pengembalian;
use App\Models\Penyewaan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MemberPenyewaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'kendaraan_id' => 'required',
            'tanggal_sewa' => 'required',
            'lama_sewa' => 'required',
        ]);

        $kendaraan = Kendaraan::find($validated['kendaraan_id']);

        $validated['member_id'] = Auth::user()->id;
        $validated['uang_muka'] = 0;
        $validated['status'] = 0;
        $validated['total_bayar'] = $kendaraan->harga_sewa * $validated['lama_sewa'];

        Penyewaan::create($validated);

        return redirect(route('member.dashboard'))->with([
            'status' => 'saved'
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
