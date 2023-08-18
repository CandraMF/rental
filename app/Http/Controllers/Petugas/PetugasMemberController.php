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
            'nama' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'no_ktp' => ['required', 'max:16', 'min:16', 'unique:'.Member::class],
            'no_sim' => ['required', 'max:12', 'min:12', 'unique:'.Member::class],
            'no_telp' => ['required', 'max:225', 'unique:'.Member::class],
            'ttl' => ['required'],
            'alamat' => ['required', 'max:255'],
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
            'nama' => ['required', 'string', 'max:255'],
            'no_ktp' => ['required', 'max:16', 'min:16', Rule::unique(Member::class)->ignore($id)],
            'no_sim' => ['required', 'max:12', 'min:12', Rule::unique(Member::class)->ignore($id)],
            'no_telp' => ['required', Rule::unique(Member::class)->ignore($id)],
            'ttl' => ['required'],
            'alamat' => ['required', 'max:255'],
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
