<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class EmailVerificationPromptController extends Controller
{
    /**
     * Display the email verification prompt.
     */
    public function __invoke(Request $request): RedirectResponse|View
    {
        if(Auth::user()->getRoleNames()[0] == 'admin') {
            $url = RouteServiceProvider::HOME_ADMIN;
        } else if(Auth::user()->getRoleNames()[0] == 'petugas') {
            $url = RouteServiceProvider::HOME_PETUGAS;
        } else if(Auth::user()->getRoleNames()[0] == 'member') {
            $url = RouteServiceProvider::HOME_MEMBER;
        } else {
            $url = '/';
        }

        return $request->user()->hasVerifiedEmail()
                    ? redirect()->intended($url)
                    : view('auth.verify-email');
    }
}
