<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Kendaraan;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class PetugasKendaraanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        
        $kendaraans = Kendaraan::paginate(10);
        
        return view('petugas.kendaraan.index', ['kendaraans' => $kendaraans]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('petugas.kendaraan.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'plat_nomor' => 'required|unique:kendaraans',
            'no_stnk' => 'required|unique:kendaraans',
            'nama_kendaraan' => 'required',
            'harga_sewa' => 'required',
        ]);

        $validated['status'] = 1;

        $kendaraan = Kendaraan::create($validated);

        return redirect(route('petugas.kendaraan.index'))->with([
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
        $kendaraan = Kendaraan::find($id);

        return view('petugas.kendaraan.edit', [
            'kendaraan' => $kendaraan
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'plat_nomor' => ['required', Rule::unique(Kendaraan::class)->ignore($id)],
            'no_stnk' => ['required', Rule::unique(Kendaraan::class)->ignore($id)],
            'nama_kendaraan' => ['required', ],
            'harga_sewa' => ['required', ],
        ]);

        $kendaraan = Kendaraan::find($id);

        $kendaraan->update($validated);
        
        return redirect(route('petugas.kendaraan.index'))->with([
            'status' => 'updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $kendaraan = Kendaraan::find($id);

        $kendaraan->delete();

        return redirect(route('admin.kendaraan.index'))->with([
            'status' => 'deleted'
        ]);
    }
}
