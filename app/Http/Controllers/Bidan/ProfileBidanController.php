<?php

namespace App\Http\Controllers\bidan;

use App\Http\Controllers\Controller;
use App\Models\ProfileBidan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileBidanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Profile Bidan',
            'profile' => Auth::guard('bidan')->user(),
            'content' => 'bidan.profile-bidan.index',
        ];

        return view('layout.wrapper', $data);
    }

    public function edit()
    {
        $data = [
            'title' => 'Edit Profil',
            'profile' => Auth::guard('bidan')->user(),
            'content' => 'bidan.profile-bidan.edit',
        ];

        return view('layout.wrapper', $data);
    }

    public function update(Request $request)
    {
        $user = Auth::guard('bidan')->user();

        $request->validate([
            'nama_bidan' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:tbl_data_bidan,username,' . $user->nik_bidan . ',nik_bidan',
            'password' => 'nullable|min:3',
        ]);

        $user->nama_bidan = $request->nama_bidan;
        $user->username = $request->username;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('bidan.profile-bidan')->with('success', 'Profil berhasil diperbarui.');
    }
}
