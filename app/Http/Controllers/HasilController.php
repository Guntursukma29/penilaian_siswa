<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;

class HasilController extends Controller
{
    public function index()
    {
        $kriteria   = Kriteria::all();
        $alternatif = Alternatif::with('nilaiKriteria')->get();

        // hitung ulang pakai metode WP (bisa refactor ke service/helper)
        $totalBobot = $kriteria->sum('bobot');
        $bobotNormalisasi = [];
        foreach ($kriteria as $krit) {
            $bobotNormalisasi[$krit->id] = $krit->bobot / $totalBobot;
        }

        $nilaiS = [];
        foreach ($alternatif as $alt) {
            $produk = 1;
            foreach ($kriteria as $krit) {
                $nilai = $alt->nilaiKriteria->firstWhere('kriteria_id', $krit->id)->nilai ?? 1;
                $bobot = $bobotNormalisasi[$krit->id];
                $pangkat = ($krit->tipe == 'cost') ? -$bobot : $bobot;
                $produk *= pow($nilai, $pangkat);
            }
            $nilaiS[$alt->id] = $produk;
        }

        $totalS = array_sum($nilaiS);
        $ranking = [];
        foreach ($alternatif as $alt) {
            $ranking[] = [
                'alternatif' => $alt->nama_alternatif,
                'V' => $nilaiS[$alt->id] / $totalS
            ];
        }

        $ranking = collect($ranking)->sortByDesc('V');

        return view('hasil.index', compact('ranking'));
    }
}
