<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Member;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'no_ktp' => ['required', 'max:16', 'min:16', 'unique:'.Member::class],
            'no_sim' => ['required', 'max:12', 'min:12', 'unique:'.Member::class],
            'no_telp' => ['required', 'max:225', 'unique:'.Member::class],
            'ttl' => ['required'],
            'alamat' => ['required', 'max:255'],
            'alamat' => ['required', 'max:255'],
        ]);

        $member = Member::create([
            'nama' => $request->name,
            'no_ktp' => $request->no_ktp,
            'no_sim' => $request->no_sim,
            'no_telp' => $request->no_telp,
            'ttl' => $request->ttl,
            'alamat' => $request->alamat,
        ]);

        $user = User::create([
            'user_id' => $member->id,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $user->assignRole('member');

        event(new Registered($user));

        Auth::login($user);

        if(Auth::user()->getRoleNames()[0] == 'admin') {
            return redirect()->intended(RouteServiceProvider::HOME_ADMIN);
        } else if(Auth::user()->getRoleNames()[0] == 'petugas') {
            return redirect()->intended(RouteServiceProvider::HOME_PETUGAS);
        } else if(Auth::user()->getRoleNames()[0] == 'member') {
            return redirect()->intended(RouteServiceProvider::HOME_MEMBER);
        } else {
            return redirect()->intended('/');
        }
    }
}
