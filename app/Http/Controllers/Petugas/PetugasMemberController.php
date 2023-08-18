<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class PetugasMemberController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $members = Member::paginate(10);

        return view('petugas.member.index', ['members' => $members]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('petugas.member.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required',
            'no_ktp' => 'required|numeric',
            'no_sim' => 'required|numeric',
            'ttl' => 'required',
            'no_telp' => 'required',
            'email' => 'required|email',
            'alamat' => 'required',
        ]);

        $password = Hash::make('password');

        $member = Member::create($request->except(['email']));

        $user = User::create([
            'name' => $request->nama,
            'email' => $request->email,
            'password' => $password,
            'user_id' => $member->id
        ]);

        $user->assignRole('member');

        return redirect(route('petugas.member.index'))->with([
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
        $member = Member::with(['user'])->find($id);

        return view('petugas.member.edit', [
            'member' => $member
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        $validated = $request->validate([
            'plat_nomor' => ['required', Rule::unique(Member::class)->ignore($id)],
            'no_stnk' => ['required', Rule::unique(Member::class)->ignore($id)],
            'nama_member' => ['required',],
            'harga_sewa' => ['required',],
        ]);

        $member = Member::find($id);

        $member->update($validated);

        return redirect(route('petugas.member.index'))->with([
            'status' => 'updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $member = Member::find($id);

        $member->delete();
        $member->user->delete();

        return redirect(route('petugas.member.index'))->with([
            'status' => 'deleted'
        ]);
    }

    public function cetakKartu(string $id)
    {
        $member = Member::with(['user'])
            ->find($id);

        $pdf = PDF::loadView('pdf.kartu_anggota', compact('member'));

        $pdf->setPaper('A4', 'landscape');

        return $pdf->stream();
    }
}
