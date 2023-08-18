<?php

namespace App\Http\Controllers\Administrasi;

use App\Http\Controllers\Controller;
use App\Models\Petugas;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdministrasiPetugasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $petugass = Petugas::whereHas('user')->paginate(10);

        return view('administrasi.petugas.index', ['petugass' => $petugass]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('administrasi.petugas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'no_telp' => ['required', Rule::unique(Petugas::class)],
            'email' => ['required', 'email', Rule::unique(User::class)],
            'alamat' => 'required',
            'ttl' => 'required',
        ]);

        $password = Hash::make('password');

        $petugas = Petugas::create($request->except(['email']));

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => $password,
            'user_id' => $petugas->id
        ]);

        $user->assignRole('petugas');

        return redirect(route('admin.petugas.index'))->with([
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
        $petugas = Petugas::with(['user'])->find($id);

        return view('administrasi.petugas.edit', [
            'petugas' => $petugas
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'nama' => ['required', 'string', 'max:255'],
            'no_telp' => ['required', ],
            'ttl' => ['required'],
            'alamat' => ['required', 'max:255'],
        ]);

        $member = Petugas::find($id);

        $member->update($validated);

        return redirect(route('admin.petugas.index'))->with([
            'status' => 'updated'
        ]); 
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $petugas = Petugas::find($id);

        $petugas->delete();
        $petugas->user->delete();

        return redirect(route('admin.petugas.index'))->with([
            'status' => 'deleted'
        ]);
    }

    public function cetakKartu(string $id)
    {
        $petugas = Petugas::with(['user'])
            ->find($id);

        $pdf = PDF::loadView('pdf.kartu_anggota', compact('petugas'));

        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream();
    }
}
