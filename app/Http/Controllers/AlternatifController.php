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

        // Filter kelas jika dipilih
        if ($request->has('kelas_id') && $request->kelas_id != '') {
            $query->where('kelas_id', $request->kelas_id);
        }

        $alternatif = $query->get();

        return view('alternatif.index', compact('alternatif', 'kelas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_alternatif' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        // Ambil kode terakhir
        $last = Alternatif::orderBy('id', 'desc')->first();
        if ($last) {
            // Ambil angka dari kode terakhir (contoh: A03 → 3)
            $lastNumber = intval(substr($last->kode, 1));
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1;
        }

        // Format kode baru menjadi A01, A02, dst.
        $kode = 'A' . str_pad($newNumber, 2, '0', STR_PAD_LEFT);

        Alternatif::create([
            'kode' => $kode,
            'nama_alternatif' => $request->nama_alternatif,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('alternatif.index')->with('success', 'Alternatif berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $alternatif = Alternatif::findOrFail($id);

        $request->validate([
            'kode' => 'nullable|unique:alternatif,kode,' . $alternatif->id,
            'nama_alternatif' => 'required',
            'kelas_id' => 'required|exists:kelas,id',
        ]);

        $alternatif->update([
            'kode' => $request->filled('kode') ? $request->kode : $alternatif->kode,
            'nama_alternatif' => $request->nama_alternatif,
            'kelas_id' => $request->kelas_id,
        ]);

        return redirect()->route('alternatif.index')->with('success', 'Alternatif berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $alternatif = Alternatif::findOrFail($id);
        $alternatif->delete();

        return redirect()->route('alternatif.index')->with('success', 'Alternatif berhasil dihapus.');
    }
    public function destroyAll()
    {
        Alternatif::query()->delete();

        return redirect()->route('alternatif.index')
            ->with('success', 'Semua data alternatif berhasil dihapus.');
    }
    // public function destroyAll()
    // {
    //     // ...
    // }
}
