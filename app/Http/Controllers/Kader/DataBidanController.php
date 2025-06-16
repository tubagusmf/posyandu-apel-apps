<?php

namespace App\Http\Controllers\kader;

use App\Http\Controllers\Controller;
use App\Models\DataBidan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataBidanController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Bidan',
            'list_bidan' => DataBidan::all(),
            'content' => 'kader.data-bidan.index'
        ];
        return view('layout.wrapper', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data',
            'content' => 'kader.data-bidan.create'
        ];
        return view('layout.wrapper', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik_bidan' => 'required|max:16|unique:tbl_data_bidan,nik_bidan',
            'nama_bidan' => 'required|string|max:100',
            'username' => 'required|unique:tbl_data_bidan,username',
            'password' => 'required|min:3',
        ]);

        DataBidan::create([
            'nik_bidan'  => $request->nik_bidan,
            'nama_bidan' => $request->nama_bidan,
            'username'   => $request->username,
            'password'   => Hash::make($request->password),
        ]);

        return redirect()->route('kader.data-bidan')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show(DataBidan $list_bidan)
    {
        return view('kader.data-bidan.show', compact('list_bidan'));
    }

    public function edit(DataBidan $list_bidan)
    {
        $data = [
            'title' => 'Edit Data',
            'list_bidan' => $list_bidan,
            'content' => 'kader.data-bidan.edit'
        ];
        return view('layout.wrapper', $data);
    }

    public function update(Request $request, DataBidan $list_bidan)
    {
        $request->validate([
            'nik_bidan' => 'required|string|max:16|unique:tbl_data_bidan,nik_bidan,' . $list_bidan->nik_bidan . ',nik_bidan',
            'nama_bidan' => 'required|string|max:100',
            'username' => 'required|unique:tbl_data_bidan,username,' . $list_bidan->username . ',username',
            'password' => 'nullable|min:3',
        ]);

        $data = [
            'nik_bidan'  => $request->nik_bidan,
            'nama_bidan' => $request->nama_bidan,
            'username'   => $request->username,
        ];

        if (!empty($request->password)) {
            $data['password'] = Hash::make($request->password);
        }

        $list_bidan->update($data);

        return redirect()->route('kader.data-bidan')->with('success', 'Data kader berhasil diperbarui.');
    }

    public function destroy(DataBidan $list_bidan)
    {
        $list_bidan->delete();
        return redirect()->route('kader.data-bidan')->with('success', 'Data kader berhasil dihapus.');
    }
}
