<?php

namespace App\Http\Controllers;

use App\Models\Alternatif;
use App\Models\HasilWP;
use App\Models\Kelas;
use App\Models\Kriteria;
use Barryvdh\DomPDF\Facade\Pdf;

class RiwayatController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        return view('riwayat.index', compact('kelas'));
    }

    public function cetakPDF($kelas_id)
    {
        $kelas = Kelas::findOrFail($kelas_id);

        // Ambil data kriteria dan alternatif berdasarkan kelas
        $kriteria   = Kriteria::all();
        $alternatif = Alternatif::with('nilaiKriteria')
            ->where('kelas_id', $kelas_id)
            ->get();

        if ($alternatif->isEmpty()) {
            return back()->with('error', 'Tidak ada data alternatif untuk kelas ini.');
        }

        // 1️⃣ Normalisasi Bobot
        $totalBobot = $kriteria->sum('bobot');
        $bobotNormalisasi = [];
        foreach ($kriteria as $krit) {
            $bobotNormalisasi[$krit->id] = $krit->bobot / $totalBobot;
        }

        // 2️⃣ Hitung Vektor S
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

        // 3️⃣ Hitung Vektor V (nilai preferensi)
        $totalS = array_sum($nilaiS);
        $ranking = [];
        foreach ($nilaiS as $alt_id => $S) {
            $V = $S / $totalS;
            $ranking[] = [
                'alternatif_id'    => $alt_id,
                'kelas_id'         => $kelas_id,
                'nilai_preferensi' => $V,
            ];
        }

        // 4️⃣ Urutkan hasil ranking
        usort($ranking, function ($a, $b) {
            return $b['nilai_preferensi'] <=> $a['nilai_preferensi'];
        });

        // 5️⃣ Tambahkan nomor ranking
        $peringkat = 1;
        foreach ($ranking as &$r) {
            $r['ranking'] = $peringkat++;
        }

        // 6️⃣ Simpan ke tabel hasil_wp
        HasilWP::where('kelas_id', $kelas_id)->delete();
        HasilWP::insert($ranking);

        // 7️⃣ Ambil data hasil dari database (sekalian ambil nama alternatif)
        $hasil = HasilWP::where('kelas_id', $kelas_id)
            ->orderBy('ranking', 'asc')
            ->with('alternatif')
            ->get();

        // 8️⃣ Generate PDF
        $pdf = Pdf::loadView('riwayat.pdf', compact('kelas', 'hasil'))
            ->setPaper('a4', 'portrait');

        return $pdf->download('Hasil_Penilaian_' . $kelas->nama_kelas . '.pdf');
    }
}
