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

class PetugasPengembalianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $penyewaans = Penyewaan::with(['petugas', 'member', 'pengembalian', 'kendaraan:id,nama_kendaraan,plat_nomor,status'])
            ->where('status', 1)
            ->paginate(10);

        return view('petugas.pengembalian.index', ['penyewaans' => $penyewaans]);
    }

    public function update(Request $request, string $id)
    {

    }

    public function kembalikan(Request $request)
    {

        $penyewaan = Penyewaan::find($request->id);

        $penyewaan->pengembalian->update([
            'denda' => $request->denda ?? 0,
            'catatan' => $request->catatan ?? null,
            'petugas_id' => Auth::user()->petugas->id,
            'tanggal_kembali' => Carbon::now()->toDateString()
        ]);

        $penyewaan->kendaraan->update([
            'status' => 1
        ]);

        return redirect(route('petugas.pengembalian.index'))->with([
            'status' => 'updated',
        ]);
    }

}
