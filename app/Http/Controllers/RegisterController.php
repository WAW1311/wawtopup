<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index() {
        return view('register.index');
    }
    public function authenticate(Request $request) {
        $request->validate([
            'name' => 'required',
            'username' => 'required',
            'email' => ['required','email'],
            'password' => 'required',
        ]);

        // Membuat pengguna baru
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Autentikasi pengguna
        auth()->login($user);

        // Redirect ke halaman yang sesuai setelah registrasi
        return redirect(route('login'));
    }
} 
