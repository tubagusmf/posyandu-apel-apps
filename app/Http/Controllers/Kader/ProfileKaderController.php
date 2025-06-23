<?php

namespace App\Http\Controllers\kader;

use App\Http\Controllers\Controller;
use App\Models\ProfileKader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileKaderController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Profile Kader',
            'profile' => Auth::guard('kader')->user(),
            'content' => 'kader.profile-kader.index',
        ];

        return view('layout.wrapper', $data);
    }

    public function edit()
    {
        $data = [
            'title' => 'Edit Profil',
            'profile' => Auth::guard('kader')->user(),
            'content' => 'kader.profile-kader.edit',
        ];

        return view('layout.wrapper', $data);
    }

    public function update(Request $request)
    {
        $user = Auth::guard('kader')->user();

        $request->validate([
            'nama_kader' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:tbl_data_user,username,' . $user->nik_kader . ',nik_kader',
            'password' => 'nullable|min:3',
        ]);

        $user->nama_kader = $request->nama_kader;
        $user->username = $request->username;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('kader.profile-kader')->with('success', 'Profil berhasil diperbarui.');
    }
}
