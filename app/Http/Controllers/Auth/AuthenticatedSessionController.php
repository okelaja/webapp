<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    // fungsi ini yang di pake buat redirect kalau sudah login
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        // ini jangan langsung di redirect harus lewat validasi heula
        // return redirect()->intended(RouteServiceProvider::HOME);

        // kalau admin dan kalo rolenya selain dari 2 misalkan 3 admin, user, manager
        // if (auth()->user()->role == 'admin') 
        // {
        //     return redirect()->route('admin');
        // }elseif (auth()->user()->role == 'user') 
        // {
        //     return redirect()->route('user');
        // }

        // tapi kalau rolenya itu ada hanya ada 2 maka pake ini aja
        return redirect()->intended(
            auth()->user()->role == 'admin' ? route('admin') : route('user')
        );

    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
