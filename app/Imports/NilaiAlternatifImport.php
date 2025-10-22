<?php

namespace App\Imports;

use App\Models\Alternatif;
use App\Models\Kelas;
use App\Models\Kriteria;
use App\Models\NilaiAlternatif;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class NilaiAlternatifImport implements ToCollection
{
    public function collection(Collection $rows)
    {
        // Baris pertama dianggap header
        $header = array_map('strtolower', $rows[0]->toArray());
        unset($rows[0]);

        foreach ($rows as $row) {
            $rowData = array_combine($header, $row->toArray());

            // Buat / ambil kelas
            $kelas = Kelas::firstOrCreate(['nama_kelas' => $rowData['kelas']]);

            // Buat / update alternatif
            $alternatif = Alternatif::updateOrCreate(
                ['nama_alternatif' => $rowData['nama_alternatif']],
                [
                    'kode' => $rowData['kode'] ?? 'ALT-' . strtoupper(uniqid()),
                    'kelas_id' => $kelas->id,
                ]
            );

            // Ambil semua kriteria
            $kriteriaList = Kriteria::all();

            foreach ($kriteriaList as $kriteria) {
                $kolom = strtolower($kriteria->nama_kriteria);
                if (isset($rowData[$kolom]) && is_numeric($rowData[$kolom])) {
                    NilaiAlternatif::updateOrCreate(
                        [
                            'alternatif_id' => $alternatif->id,
                            'kriteria_id'   => $kriteria->id,
                        ],
                        [
                            'nilai' => $rowData[$kolom],
                        ]
                    );
                }
            }
        }
    }
}
