<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\NilaiAlternatif;

class PerhitunganWPController extends Controller
{
    public function index()
    {
        $kriteria   = Kriteria::all();
        $alternatif = Alternatif::with('nilaiKriteria')->get();

        // =========================
        // 1. Normalisasi Bobot
        // =========================
        $totalBobot = $kriteria->sum('bobot');
        $bobotNormalisasi = [];
        foreach ($kriteria as $krit) {
            $bobotNormalisasi[$krit->id] = $krit->bobot / $totalBobot;
        }

        // =========================
        // 2. Hitung Vektor S
        // =========================
        $nilaiS = [];
        foreach ($alternatif as $alt) {
            $hasilPerKriteria = [];
            $produk = 1;

            foreach ($kriteria as $krit) {
                $nilai = $alt->nilaiKriteria->firstWhere('kriteria_id', $krit->id)->nilai ?? 1;
                $bobot = $bobotNormalisasi[$krit->id];

                // cost -> bobot negatif
                $pangkat = ($krit->tipe == 'cost') ? -$bobot : $bobot;

                $hasilPerKriteria[$krit->nama_kriteria] = pow($nilai, $pangkat);
                $produk *= pow($nilai, $pangkat);
            }

            $nilaiS[$alt->id] = [
                'alternatif' => $alt->nama_alternatif,
                'detail'     => $hasilPerKriteria,
                'S'          => $produk,
            ];
        }

        // =========================
        // 3. Hitung Vektor V
        // =========================
        $totalS = collect($nilaiS)->sum('S');
        $nilaiV = [];
        foreach ($nilaiS as $id => $data) {
            $nilaiV[$id] = [
                'alternatif' => $data['alternatif'],
                'S'          => $data['S'],
                'V'          => $data['S'] / $totalS,
            ];
        }

        // Urutkan berdasarkan V (ranking)
        $ranking = collect($nilaiV)->sortByDesc('V');

        return view('perhitungan.index', compact('kriteria', 'alternatif', 'bobotNormalisasi', 'nilaiS', 'nilaiV', 'ranking'));
    }
}
