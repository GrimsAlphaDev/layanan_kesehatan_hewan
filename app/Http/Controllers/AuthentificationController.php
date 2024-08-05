<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthentificationController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function signIn(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->intended($this->checkRoles());
        }

        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ]);
    }

    public function checkRoles()
    {
        if(auth()->user()->role == 1) {
            return 'patient';
        } else if(auth()->user()->role == 2) {
            return 'admin';
        }
    }
}
