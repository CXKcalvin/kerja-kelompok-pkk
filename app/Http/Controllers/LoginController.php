<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    // Menampilkan halaman auth (Login & Register)
    public function index()
    {
        return view('login'); // Sesuaikan nama file blade kamu
    }

    // Proses Auth Login
    public function authlogin(Request $request)
    {
        // 1. Validasi Input
        $request->validate([
            'login' => 'required', // field ini bisa berisi username atau email
            'password' => 'required',
        ]);

        // 2. Tentukan field mana yang digunakan (username atau email)
        $login = $request->input('login');
        $field = filter_var($login, FILTER_VALIDATE_EMAIL) ? 'email' : 'name';

        // 3. Coba Autentikasi
        $credentials = [
            $field => $login,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // 4. Pengecekan Role User (Cukup ambil dari Auth::user())
            $user = Auth::user();

            // Cek role dari user yang berhasil login tersebut
            if ($user->role === 'admin') {
                return redirect()->intended(route('admin'));
            }
            if ($user->role === 'client') {
                return redirect()->intended(route('page'));
            }
        }


        // 5. Jika gagal login
        return back()->withErrors([
            'login' => 'Username/Email atau password salah.',
        ])->onlyInput('login');
    }

    public function authregister(Request $request)
    {
        $request->validate([
            'nama_client' => 'required',
            'email_client' => 'required|email|unique:users,email',
            'password_client' => 'required'
        ]);

        User::create([
            'name' => $request->nama_client,
            'email' => $request->email_client,
            'password' => Hash::make($request->password_client),
            'role' => 'client',
        ]);

        return redirect()->route('login')->with('success', 'Register berhasil.');
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }

    public function page()
    {
        return view('page');
    }

    public function admin()
    {
        return view('admin');
    }
}
