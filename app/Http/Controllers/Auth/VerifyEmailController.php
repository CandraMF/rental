<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Verified;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class VerifyEmailController extends Controller
{
    /**
     * Mark the authenticated user's email address as verified.
     */
    public function __invoke(EmailVerificationRequest $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
            if(Auth::user()->getRoleNames()[0] == 'admin') {
                return redirect()->intended(RouteServiceProvider::HOME_ADMIN.'?verified=1');
            } else if(Auth::user()->getRoleNames()[0] == 'petugas') {
                return redirect()->intended(RouteServiceProvider::HOME_PETUGAS.'?verified=1');
            } else if(Auth::user()->getRoleNames()[0] == 'member') {
                return redirect()->intended(RouteServiceProvider::HOME_MEMBER.'?verified=1');
            } else {
                return redirect()->intended('/');
            }
        }

        if ($request->user()->markEmailAsVerified()) {
            event(new Verified($request->user()));
        }

        if(Auth::user()->getRoleNames()[0] == 'admin') {
            return redirect()->intended(RouteServiceProvider::HOME_ADMIN.'?verified=1');
        } else if(Auth::user()->getRoleNames()[0] == 'petugas') {
            return redirect()->intended(RouteServiceProvider::HOME_PETUGAS.'?verified=1');
        } else if(Auth::user()->getRoleNames()[0] == 'member') {
            return redirect()->intended(RouteServiceProvider::HOME_MEMBER.'?verified=1');
        } else {
            return redirect()->intended('/');
        }
    }
}
