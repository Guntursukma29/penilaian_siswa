<?php

namespace App\Http\Controllers;

use App\Models\Kriteria;
use Illuminate\Http\Request;

class KriteriaController extends Controller
{
    public function index()
    {
        $kriteria = Kriteria::orderBy('created_at', 'asc')->get();
        return view('kriteria.index', compact('kriteria'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:kriteria,kode',
            'nama_kriteria' => 'required',
            'tipe' => 'required|in:benefit,cost',
            'bobot' => 'required|numeric|min:0',
        ]);

        Kriteria::create($request->all());

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $kriteria = Kriteria::findOrFail($id);

        $request->validate([
            'kode' => 'required|unique:kriteria,kode,' . $kriteria->id,
            'nama_kriteria' => 'required',
            'tipe' => 'required|in:benefit,cost',
            'bobot' => 'required|numeric|min:0',
        ]);

        $kriteria->update($request->all());

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kriteria = Kriteria::findOrFail($id);
        $kriteria->delete();

        return redirect()->route('kriteria.index')->with('success', 'Kriteria berhasil dihapus.');
    }
}
