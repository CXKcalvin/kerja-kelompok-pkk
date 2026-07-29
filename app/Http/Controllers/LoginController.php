<?php

namespace App\Http\Controllers;

use App\Models\User;
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
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 2. Coba Autentikasi
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            // 3. Pengecekan Role User
            $user = Auth::user();

            if ($user->role === 'admin') {
                return redirect()->intended(route('admin'));
            }

            // Jika bukan admin, arahkan ke halaman client
            return redirect()->intended(route('page'));
        }

        // 4. Jika gagal login
        return back()->withErrors([
            'email' => 'Email atau password salah.',
        ])->onlyInput('email');
    }

    public function authregister(Request $request)
    {
        $request->validate([
            'nama_client' => 'required',
            'email_client' => 'required|email|unique:users,email',
            'password_client' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->nama_client,
            'email' => $request->email_client,
            'password' => Hash::make($request->password_client),
            'role' => 'client',
        ]);

        return redirect()->route('login')
            ->with('success', 'Register berhasil.');
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
