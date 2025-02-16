<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\MessageBag;
use App\Models\User;

class LoginController extends Controller
{
    /**
     * Tampilkan halaman login.
     */
    public function index()
    {
        return view('login');
    }

    /**
     * Proses autentikasi login.
     */
    public function login(Request $request)
    {
        // Validasi input
        $credentials = $request->validate(
            [
                'email'    => 'required|email',
                'password' => 'required',
            ],
            [
                'email.required'    => 'Email wajib di isi!',
                'email.email'       => 'Format email tidak valid!',
                'password.required' => 'Password wajib di isi!',
            ]
        );

        // Gunakan remember jika checkbox 'remember' dicentang
        $remember = $request->filled('remember');

        // Coba autentikasi menggunakan kredensial
        if (Auth::attempt($credentials, $remember)) {
            // Regenerasi session untuk menghindari session fixation
            $request->session()->regenerate();

            $user = Auth::user();
            // Redirect berdasarkan peran pengguna
            switch ($user->role) {
                case 'Admin':
                    return redirect()->intended('/admin/dashboard');
                case 'Staff Gudang':
                    return redirect()->intended('/staff-gudang/dashboard');
                case 'Manajer Gudang':
                    return redirect()->intended('/manajer-gudang/dashboard');
                default:
                    return redirect()->intended('/dashboard');
            }
        } else {
            // Buat MessageBag untuk error
            $errors = new MessageBag();

            // Cek apakah email terdaftar untuk memberikan pesan yang lebih spesifik
            if (!User::where('email', $request->email)->exists()) {
                $errors->add('email', 'Email tidak ditemukan.');
            } else {
                $errors->add('password', 'Password salah.');
            }

            return redirect()->back()->withErrors($errors)->withInput();
        }
    }

    /**
     * Proses logout.
     */
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login')->with('message', 'Successfully logged out!');
    }
}
