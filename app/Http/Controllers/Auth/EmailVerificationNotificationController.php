<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class EmailVerificationNotificationController extends Controller
{
    /**
     * Send a new email verification notification.
     */
    public function store(Request $request): RedirectResponse
    {
        if ($request->user()->hasVerifiedEmail()) {
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

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
