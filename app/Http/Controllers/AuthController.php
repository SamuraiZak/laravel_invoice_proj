<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

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

    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:users,name',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user =  User::create($validated);

        Auth::login($user);

        return redirect()->route('show.dashboard');
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:8'
        ]);

        if (Auth::attempt($validated)) {
            $request->session()->regenerate();

            return redirect()->route('show.dashboard');
        }

        throw ValidationException::withMessages([
            'credentials' => 'Sorry, incorrect credentials'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('show.login');
    }
}
