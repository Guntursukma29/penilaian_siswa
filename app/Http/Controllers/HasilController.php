<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\Kriteria;
use App\Models\Kelas;
use Illuminate\Http\Request;

class HasilController extends Controller
{
    public function index(Request $request)
    {
        $kelas = Kelas::all();
        $kelasId = $request->get('kelas_id');

        // Ambil alternatif berdasarkan kelas (jika ada filter)
        $alternatifQuery = Alternatif::with(['nilaiKriteria', 'kelas']);
        if ($kelasId) {
            $alternatifQuery->where('kelas_id', $kelasId);
        }
        $alternatif = $alternatifQuery->get();

        $kriteria = Kriteria::all();
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
                'kelas' => $alt->kelas->nama_kelas ?? '-',
                'V' => $totalS > 0 ? $nilaiS[$alt->id] / $totalS : 0,
            ];
        }

        $ranking = collect($ranking)
            ->sortByDesc('V')
            ->take(5)
            ->values();

        return view('hasil.index', compact('ranking', 'kelas', 'kelasId'));
    }
}
