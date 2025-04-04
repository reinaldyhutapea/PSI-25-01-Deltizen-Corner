<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showCustomerLoginForm()
    {
        return view('auth.login-customer');
    }

    public function customerLogin(Request $request)
    {
        $this->validateLogin($request);

        if (Auth::attempt($request->only('email', 'password'))) {
            if (Auth::user()->role === 'customer') {
                return redirect('/menu');
            } else {
                Auth::logout();
                return back()->withErrors(['email' => 'Akun ini bukan customer.']);
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function showAdminLoginForm()
    {
        return view('auth.login-admin');
    }

    public function adminLogin(Request $request)
    {
        $this->validateLogin($request);

        if (Auth::attempt($request->only('email', 'password'))) {
            if (Auth::user()->role === 'admin') {
                return redirect()->route('admin.dashboard');
            } else {
                Auth::logout();
                return back()->withErrors(['email' => 'Akun ini bukan admin.']);
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    public function showOwnerLoginForm()
    {
        return view('auth.login-owner');
    }

    public function ownerLogin(Request $request)
    {
        $this->validateLogin($request);

        if (Auth::attempt($request->only('email', 'password'))) {
            if (Auth::user()->role === 'owner') {
                return redirect()->route('owner.index');
            } else {
                Auth::logout();
                return back()->withErrors(['email' => 'Akun ini bukan owner.']);
            }
        }

        return back()->withErrors(['email' => 'Email atau password salah.']);
    }

    protected function validateLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
