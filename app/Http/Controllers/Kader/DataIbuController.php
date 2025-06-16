<?php

namespace App\Http\Controllers\Kader;

use App\Http\Controllers\Controller;
use App\Models\Ibu;
use Illuminate\Http\Request;

class DataIbuController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Ibu',
            'ibu' => Ibu::all(),
            'content' => 'kader.data-ibu.index'
        ];
        return view('layout.wrapper', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data',
            'content' => 'kader.data-ibu.create'
        ];
        return view('layout.wrapper', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik_ibu' => 'required|max:16|unique:tbl_data_ibu,nik_ibu',
            'nama_ibu' => 'required|string|max:100',
            'tgl_lahir' => 'required|date',
            'telepon' => 'required|string|max:15',
            'alamat' => 'required',
        ]);

        Ibu::create($request->all());

        return redirect()->route('kader.data-ibu')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show(Ibu $ibu)
    {
        return view('kader.data-ibu.show', compact('ibu'));
    }

    public function edit(Ibu $ibu)
    {
        $data = [
            'title' => 'Edit Data',
            'ibu' => $ibu,
            'content' => 'kader.data-ibu.edit'
        ];
        return view('layout.wrapper', $data);
    }

    public function update(Request $request, Ibu $ibu)
    {
        $request->validate([
            'nik_ibu' => 'required|string|max:16|unique:tbl_data_ibu,nik_Ibu,' . $ibu->nik_ibu . ',nik_Ibu',
            'nama_ibu' => 'required|string|max:100',
            'tgl_lahir' => 'required|date',
            'telepon' => 'required|string|max:15',
            'alamat' => 'required',
        ]);

        $ibu->update($request->all());

        return redirect()->route('kader.data-ibu')->with('success', 'Data ibu berhasil diperbarui.');
    }

    public function destroy(Ibu $ibu)
    {
        $ibu->delete();
        return redirect()->route('kader.data-ibu')->with('success', 'Data ibu berhasil dihapus.');
    }
}
