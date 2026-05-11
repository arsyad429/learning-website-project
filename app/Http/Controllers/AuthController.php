<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // Wajib dipanggil di bagian atas

class AuthController
{
    public function login(Request $request)
    {
        // 1. Validasi input (Opsional tapi sangat disarankan)
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Gunakan Auth::attempt untuk mengecek ke database
        if (Auth::attempt($credentials)) {
            
            // 3. Jika sukses, buat session baru (penting untuk keamanan)
            $request->session()->regenerate();

            // 4. Arahkan ke halaman dashboard
            return redirect()->intended('/'); 
        }

        // 5. Jika gagal, kembalikan user ke halaman login beserta pesan error
        return back()->withErrors([
            'email' => 'Email atau password yang Anda masukkan salah.',
        ])->onlyInput('email'); // onlyInput berguna agar email yang diketik tidak hilang
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}