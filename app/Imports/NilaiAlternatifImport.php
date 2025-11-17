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
        // header baris 1
        $header = array_map('strtolower', $rows[0]->toArray());
        unset($rows[0]);

        // Ambil semua kriteria contoh: C1, C2, C3...
        $kriteriaList = Kriteria::all();

        foreach ($rows as $row) {
            $rowData = array_combine($header, $row->toArray());

            // Buat / ambil kelas
            $kelas = Kelas::firstOrCreate([
                'nama_kelas' => $rowData['kelas'],
            ]);

            // Buat / update alternatif
            $alternatif = Alternatif::updateOrCreate(
                ['nama_alternatif' => $rowData['nama_alternatif']],
                [
                    'kode' => $rowData['kode'] ?? 'ALT-' . strtoupper(uniqid()),
                    'kelas_id' => $kelas->id,
                ]
            );

            // Simpan nilai per kriteria
            foreach ($kriteriaList as $kriteria) {
                $kolom_excel = strtolower($kriteria->kode); // C1, C2, dst.

                if (isset($rowData[$kolom_excel]) && is_numeric($rowData[$kolom_excel])) {
                    NilaiAlternatif::updateOrCreate(
                        [
                            'alternatif_id' => $alternatif->id,
                            'kriteria_id'   => $kriteria->id,
                        ],
                        [
                            'nilai' => $rowData[$kolom_excel],
                        ]
                    );
                }
            }
        }
    }
}
