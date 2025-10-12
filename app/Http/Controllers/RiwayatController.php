<?php

namespace App\Http\Controllers;

use App\Models\HasilWP;
use App\Models\Kelas;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class RiwayatController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        $hasil = HasilWP::with(['alternatif', 'kelas'])
            ->orderBy('ranking', 'asc')
            ->get();

        return view('riwayat.index', compact('kelas', 'hasil'));
    }

    public function cetakPDF($kelas_id)
    {
        $kelas = Kelas::findOrFail($kelas_id);

        // Ambil data hasil perangkingan berdasarkan kelas
        $hasil = HasilWP::where('kelas_id', $kelas_id)
            ->orderBy('ranking', 'asc')
            ->with('alternatif')
            ->get();

        // Buat PDF dari view
        $pdf = Pdf::loadView('riwayat.pdf', compact('kelas', 'hasil'))
            ->setPaper('a4', 'portrait');

        // Unduh file PDF
        return $pdf->download('Hasil_Penilaian_' . $kelas->nama_kelas . '.pdf');
    }
}
