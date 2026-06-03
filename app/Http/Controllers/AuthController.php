<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('enrollment.create');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('enrollment.create'));
        }

        return back()->withErrors(['username' => 'Invalid username or password. Please try again.'])->onlyInput('username');
    }

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('enrollment.create');
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        $data = $request->validate([
            'username' => 'required|string|min:4|unique:users,username',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'username' => $data['username'],
            'name' => $data['username'],
            'email' => null,
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($user);
        return redirect()->route('enrollment.create');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}
