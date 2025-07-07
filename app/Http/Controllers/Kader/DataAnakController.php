<?php

namespace App\Http\Controllers\kader;

use App\Http\Controllers\Controller;
use App\Models\Anak;
use Illuminate\Http\Request;

class DataAnakController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Bayi & Balita',
            'anak' => Anak::all(),
            'content' => 'kader.data-anak.index'
        ];
        return view('layout.wrapper', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data',
            'content' => 'kader.data-anak.create'
        ];
        return view('layout.wrapper', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik_anak' => 'required|max:16|unique:tbl_data_bayi_balita,nik_anak',
            'nama_anak' => 'required|string',
            'nama_ibu' => 'required|string',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'telepon' => 'required',
            'alamat' => 'required|string',
        ]);

        Anak::create($request->all());

        return redirect()->route('kader.data-anak')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show(Anak $anak)
    {
        return view('kader.data-anak.show', compact('anak'));
    }

    public function edit(Anak $anak)
    {
        $data = [
            'title' => 'Edit Data',
            'anak' => $anak,
            'content' => 'kader.data-anak.edit'
        ];
        return view('layout.wrapper', $data);
    }

    public function update(Request $request, Anak $anak)
    {
        $request->validate([
            'nik_anak' => 'required|string|max:16|unique:tbl_data_bayi_balita,nik_anak,' . $anak->nik_anak . ',nik_anak',
            'nama_anak' => 'required|string',
            'nama_ibu' => 'required|string',
            'tgl_lahir' => 'required|date',
            'jenis_kelamin' => 'required|string',
            'telepon' => 'required',
            'alamat' => 'required|string',
        ]);

        $anak->update($request->all());

        return redirect()->route('kader.data-anak')->with('success', 'Data anak berhasil diperbarui.');
    }

    public function destroy(Anak $anak)
    {
        $anak->delete();
        return redirect()->route('kader.data-anak')->with('success', 'Data anak berhasil dihapus.');
    }
}
