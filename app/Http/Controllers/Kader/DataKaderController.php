<?php

namespace App\Http\Controllers\kader;

use App\Http\Controllers\Controller;
use App\Models\DataKader;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataKaderController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Kader',
            'list_kader' => DataKader::all(),
            'content' => 'kader.data-kader.index'
        ];
        return view('layout.wrapper', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data',
            'content' => 'kader.data-kader.create'
        ];
        return view('layout.wrapper', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik_kader' => 'required|max:16|unique:tbl_data_user,nik_kader',
            'nama_kader' => 'required|string|max:100',
            'username' => 'required|unique:tbl_data_user,username',
            'password' => 'required|min:3',
        ]);

        DataKader::create([
            'nik_kader'  => $request->nik_kader,
            'nama_kader' => $request->nama_kader,
            'username'   => $request->username,
            'password'   => Hash::make($request->password),
        ]);

        return redirect()->route('kader.data-kader')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show(DataKader $list_kader)
    {
        return view('kader.data-kader.show', compact('list_kader'));
    }

    public function edit(DataKader $list_kader)
    {
        $data = [
            'title' => 'Edit Data',
            'list_kader' => $list_kader,
            'content' => 'kader.data-kader.edit'
        ];
        return view('layout.wrapper', $data);
    }

    public function update(Request $request, DataKader $list_kader)
    {
        $request->validate([
            'nik_kader' => 'required|string|max:16|unique:tbl_data_user,nik_kader,' . $list_kader->nik_kader . ',nik_kader',
            'nama_kader' => 'required|string|max:100',
            'username' => 'required|unique:tbl_data_user,username,' . $list_kader->username . ',username',
            'password' => 'nullable|min:3',
        ]);

        $data = [
            'nik_kader'  => $request->nik_kader,
            'nama_kader' => $request->nama_kader,
            'username'   => $request->username,
        ];
    
        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }
    
        $list_kader->update($data);

        return redirect()->route('kader.data-kader')->with('success', 'Data kader berhasil diperbarui.');
    }

    public function destroy(DataKader $list_kader)
    {
        $list_kader->delete();
        return redirect()->route('kader.data-kader')->with('success', 'Data kader berhasil dihapus.');
    }
}
