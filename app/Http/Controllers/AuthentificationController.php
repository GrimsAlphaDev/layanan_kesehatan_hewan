<?php

namespace App\Http\Controllers;

use App\Models\User;
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

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    public function register()
    {
        return view('auth.register');
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 1
        ]);

        Auth::login($user);

        return redirect($this->checkRoles());
    }
}
