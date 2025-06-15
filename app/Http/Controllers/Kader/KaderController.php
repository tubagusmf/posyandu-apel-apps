<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\Kader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Auth;

class KaderController extends Controller
{
    public function showLogin()
    {
        return view('auth.login-kader');
    }

    public function showRegister()
    {
        return view('auth.register-kader');
    }

    public function login(Request $request)
    {
        Auth::guard('bidan')->logout();
        
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ], [
            'username.required' => 'Username wajib diisi.',
            'password.required' => 'Password wajib diisi.',
        ]);

        $credentials = $request->only('username', 'password');

        if (Auth::guard('kader')->attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard-kader');
        }

        return back()->withInput($request->only('username'))->withErrors([
            'login' => 'Login gagal. Username atau password salah.',
        ]);
    }


    public function register(Request $request)
    {
        $request->validate([
            'nik'      => 'required|numeric|unique:tbl_data_user,nik_kader',
            'name'     => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:tbl_data_user,username',
            'pass'     => 'required|string|min:3',
            're_pass'  => 'required|same:pass',
        ], [
            're_pass.same' => 'Konfirmasi password tidak sesuai.',
        ]);

        Kader::create([
            'nik_kader'  => $request->nik,
            'nama_kader' => $request->name,
            'username'   => $request->username,
            'password'   => Hash::make($request->pass),
        ]);

        return redirect('/login-kader')->with('success', 'Registrasi berhasil. Silakan login.');
    }


    public function logout()
    {
        Session::forget('kader');
        return redirect('/login-kader');
    }
}
