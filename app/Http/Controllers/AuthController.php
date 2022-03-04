<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function showRegister()
    {
        return view('auth.register');
    }

    public function showLogin()
    {
        return view('auth.login');
    }

    public function prosesRegister(Request $request)
    {
        // Bukan yang didatabase
        $request->validate([
            'name' => 'required|string|max:30',
            'email' => 'required|email|max:30|unique:users',
            'password' => 'required|string|max:30|confirmed',
        ]);

        // Yang didatabase
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        return redirect('/login')->with('success_status', 'Register berhasil, silahkan login');
    }

    public function prosesLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:30',
            'password' => 'required|string|max:30',
        ]);

        $credentials = $request->only(['email', 'password']);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return redirect('/login')->with('error_status', 'Email atau password salah');
    }

    public function prosesLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
