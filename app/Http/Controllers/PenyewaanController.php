<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use App\Models\Pengembalian;
use App\Models\Penyewaan;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class PenyewaanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $penyewaans = Penyewaan::with(['petugas.petugas', 'member.member', 'pengembalian', 'kendaraan:id,nama_kendaraan,plat_nomor,status'])
            ->where('status', 0)
            ->paginate(10);

        return view('administrasi.penyewaan.index', ['penyewaans' => $penyewaans]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrasi.penyewaan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'plat_nomor' => 'required|unique:penyewaans',
            'no_stnk' => 'required|unique:penyewaans',
            'nama_penyewaan' => 'required',
            'harga_sewa' => 'required',
        ]);

        $validated['status'] = 1;

        $penyewaan = Penyewaan::create($validated);

        return redirect(route('admin.penyewaan.index'))->with([
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
        $penyewaan = Penyewaan::find($id);

        return view('administrasi.penyewaan.edit', [
            'penyewaan' => $penyewaan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'plat_nomor' => ['required', Rule::unique(Penyewaan::class)->ignore($id)],
            'no_stnk' => ['required', Rule::unique(Penyewaan::class)->ignore($id)],
            'nama_penyewaan' => ['required', ],
            'harga_sewa' => ['required', ],
        ]);

        $penyewaan = Penyewaan::find($id);

        $penyewaan->update($validated);
        
        return redirect(route('admin.penyewaan.index'))->with([
            'status' => 'updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $penyewaan = Penyewaan::find($id);

        $penyewaan->delete();

        return redirect(route('admin.penyewaan.index'))->with([
            'status' => 'deleted'
        ]);
    }

    public function terima(Request $request)
    {
        $validated = $request->validate([
            'penyewaan_id' => 'required',
            'kendaraan_id' => 'required',
            'total_bayar' => 'required',
            'lama_sewa' => 'required',
            'uang_muka' => 'required|min:1',
        ]);

        $penyewaan = Penyewaan::find($validated['penyewaan_id']);
        $kendaraan = Kendaraan::find($validated['kendaraan_id']);
        
        $total_bayar = $kendaraan->harga_sewa * $validated['lama_sewa'];

        $tanggal_kembali = Carbon::createFromFormat('Y-m-d', $penyewaan->tanggal_sewa)->addDays($validated['lama_sewa']);
        
        $pengembalian = Pengembalian::create([
            'sisa_bayar' => $total_bayar - $validated['uang_muka'],
        ]);

        $penyewaan->update([
            'petugas_id' => Auth::user()->id,
            'tanggal_sewa' => Now(),
            'lama_sewa' => $validated['lama_sewa'],
            'total_bayar' => $total_bayar,
            'uang_muka' => $validated['uang_muka'],
            'status' => 1,
            'pengembalian_id' => $pengembalian->id
        ]);

        return redirect(route('admin.penyewaan.index'))->with([
            'status' => 'updated'
        ]);
    }

    public function tolak(Request $request)
    {
        dd($request);
    }
}
