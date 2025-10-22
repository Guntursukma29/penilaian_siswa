<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kelas;
use Illuminate\Http\Request;

class AlternatifController extends Controller
{
    public function index(Request $request)
    {
        $kelas = Kelas::all();

        $query = Alternatif::with('kelas');

        // Jika ada filter kelas
        if ($request->has('kelas_id') && $request->kelas_id != '') {
            $query->where('kelas_id', $request->kelas_id);
        }

        $alternatif = $query->get();

        return view('alternatif.index', compact('alternatif', 'kelas'));
    }


    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:alternatif,kode',
            'nama_alternatif' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        Alternatif::create($request->all());

        return redirect()->route('alternatif.index')->with('success', 'Alternatif berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $alternatif = Alternatif::findOrFail($id);

        $request->validate([
            'kode' => 'required|unique:alternatif,kode,' . $alternatif->id,
            'nama_alternatif' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $alternatif->update($request->all());

        return redirect()->route('alternatif.index')->with('success', 'Alternatif berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $alternatif = Alternatif::findOrFail($id);
        $alternatif->delete();

        return redirect()->route('alternatif.index')->with('success', 'Alternatif berhasil dihapus.');
    }
}
