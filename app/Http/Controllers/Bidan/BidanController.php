<?php

namespace App\Http\Controllers\Bidan;

use App\Http\Controllers\Controller;
use App\Models\Bidan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class BidanController extends Controller
{
    public function showLogin()
    {
        return view('auth.login-bidan');
    }

    public function showRegister()
    {
        return view('auth.register-bidan');
    }

    public function login(Request $request)
    {
        Auth::guard('kader')->logout();

        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::guard('bidan')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard-bidan');
        }

        return back()->withInput($request->only('username'))->withErrors([
            'login' => 'Login gagal. Username atau password salah.',
        ]);
    }

    public function register(Request $request)
    {
        $request->validate([
            'nik'      => 'required|numeric|unique:tbl_data_bidan,nik_bidan',
            'name'     => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:tbl_data_bidan,username',
            'pass'     => 'required|string|min:3',
            're_pass'  => 'required|same:pass',
        ], [
            're_pass.same' => 'Konfirmasi password tidak sesuai.',
        ]);

        Bidan::create([
            'nik_bidan' => $request->nik,
            'nama_bidan' => $request->name,
            'username' => $request->username,
            'password' => Hash::make($request->pass),
        ]);

        return redirect('/login-bidan')->with('success', 'Registrasi berhasil. Silakan login.');
    }

    public function logout()
    {
        Session::forget('bidan');
        return redirect('/login-bidan');
    }
}
