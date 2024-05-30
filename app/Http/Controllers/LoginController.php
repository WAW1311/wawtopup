<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function index() {
        return view('login.index');
    }
    public function authenticate(Request $request) {
        $credentials = $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
    
        // Proses autentikasi
        if (Auth::attempt($credentials)) {
            return redirect()->intended(route('dashboard'));
        } else {
            // Jika autentikasi gagal, redirect kembali ke halaman login dengan pesan error
            return redirect()->back()->withInput()->withErrors(['username' => 'Invalid username or password']);
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    } 
}
