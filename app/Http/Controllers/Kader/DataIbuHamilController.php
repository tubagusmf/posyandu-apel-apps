<?php

namespace App\Http\Controllers\kader;

use App\Http\Controllers\Controller;
use App\Models\IbuHamil;
use Illuminate\Http\Request;

class DataIbuHamilController extends Controller
{
    public function index()
    {
        $data = [
            'title' => 'Data Ibu Hamil',
            'ibuHamil' => IbuHamil::all(),
            'content' => 'kader.data-ibu-hamil.index'
        ];
        return view('layout.wrapper', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Tambah Data',
            'content' => 'kader.data-ibu-hamil.create'
        ];
        return view('layout.wrapper', $data);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nik_ibu_hamil' => 'required|max:16|unique:tbl_data_ibu_hamil,nik_ibu_hamil',
            'nama_ibu_hamil' => 'required|string|max:100',
            'tgl_lahir' => 'required|date',
            'telepon' => 'required',
            'kondisi' => 'required|string',
            'alamat' => 'required',
        ]);

        IbuHamil::create($request->all());

        return redirect()->route('kader.data-ibu-hamil')->with('success', 'Data berhasil ditambahkan.');
    }

    public function show(IbuHamil $ibuHamil)
    {
        return view('kader.data-ibu-hamil.show', compact('ibuHamil'));
    }

    public function edit(IbuHamil $ibuHamil)
    {
        $data = [
            'title' => 'Edit Data',
            'ibuHamil' => $ibuHamil,
            'content' => 'kader.data-ibu-hamil.edit'
        ];
        return view('layout.wrapper', $data);
    }

    public function update(Request $request, IbuHamil $ibuHamil)
    {
        $request->validate([
            'nik_ibu_hamil' => 'required|string|max:16|unique:tbl_data_ibu_hamil,nik_ibu_hamil,' . $ibuHamil->nik_ibu_hamil . ',nik_ibu_hamil',
            'nama_ibu_hamil' => 'required|string|max:100',
            'tgl_lahir' => 'required|date',
            'telepon' => 'required',
            'kondisi' => 'required|string',
            'alamat' => 'required',
        ]);

        $ibuHamil->update($request->all());

        return redirect()->route('kader.data-ibu-hamil')->with('success', 'Data ibu hamil berhasil diperbarui.');
    }

    public function destroy(IbuHamil $ibuHamil)
    {
        $ibuHamil->delete();
        return redirect()->route('kader.data-ibu-hamil')->with('success', 'Data ibu hamil berhasil dihapus.');
    }
}
