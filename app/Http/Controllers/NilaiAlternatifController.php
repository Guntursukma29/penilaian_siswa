<?php

namespace App\Http\Controllers;

use App\Models\NilaiAlternatif;
use App\Models\Alternatif;
use App\Models\Kriteria;
use Illuminate\Http\Request;

class NilaiAlternatifController extends Controller
{
    public function index()
    {
        $alternatif = Alternatif::with('nilaiKriteria.kriteria')->get();
        $kriteria   = Kriteria::all();

        return view('nilai_alternatif.index', compact('alternatif', 'kriteria'));
    }

    public function storeOrUpdate(Request $request, $alternatif_id)
    {
        $request->validate([
            'nilai' => 'required|array',
        ]);

        foreach ($request->nilai as $kriteria_id => $nilai) {
            NilaiAlternatif::updateOrCreate(
                [
                    'alternatif_id' => $alternatif_id,
                    'kriteria_id'   => $kriteria_id,
                ],
                [
                    'nilai' => $nilai,
                ]
            );
        }

        return redirect()->route('nilai_alternatif.index')->with('success', 'Nilai berhasil disimpan.');
    }
}
