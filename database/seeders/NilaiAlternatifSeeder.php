<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NilaiAlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asumsi ada 5 alternatif (A1–A5) dan 5 kriteria (C1–C5)
        // Nilai disesuaikan secara acak untuk contoh
        $data = [
            // A1
            ['alternatif_id' => 1, 'kriteria_id' => 1, 'nilai' => 3.50, 'kelas_id' => null],
            ['alternatif_id' => 1, 'kriteria_id' => 2, 'nilai' => 4.00, 'kelas_id' => null],
            ['alternatif_id' => 1, 'kriteria_id' => 3, 'nilai' => 3.00, 'kelas_id' => null],
            ['alternatif_id' => 1, 'kriteria_id' => 4, 'nilai' => 4.50, 'kelas_id' => null],
            ['alternatif_id' => 1, 'kriteria_id' => 5, 'nilai' => 4.00, 'kelas_id' => null],

            // A2
            ['alternatif_id' => 2, 'kriteria_id' => 1, 'nilai' => 2.50, 'kelas_id' => null],
            ['alternatif_id' => 2, 'kriteria_id' => 2, 'nilai' => 3.50, 'kelas_id' => null],
            ['alternatif_id' => 2, 'kriteria_id' => 3, 'nilai' => 4.00, 'kelas_id' => null],
            ['alternatif_id' => 2, 'kriteria_id' => 4, 'nilai' => 3.50, 'kelas_id' => null],
            ['alternatif_id' => 2, 'kriteria_id' => 5, 'nilai' => 4.50, 'kelas_id' => null],

            // A3
            ['alternatif_id' => 3, 'kriteria_id' => 1, 'nilai' => 4.00, 'kelas_id' => null],
            ['alternatif_id' => 3, 'kriteria_id' => 2, 'nilai' => 2.50, 'kelas_id' => null],
            ['alternatif_id' => 3, 'kriteria_id' => 3, 'nilai' => 3.50, 'kelas_id' => null],
            ['alternatif_id' => 3, 'kriteria_id' => 4, 'nilai' => 4.00, 'kelas_id' => null],
            ['alternatif_id' => 3, 'kriteria_id' => 5, 'nilai' => 3.00, 'kelas_id' => null],

            // A4
            ['alternatif_id' => 4, 'kriteria_id' => 1, 'nilai' => 3.00, 'kelas_id' => null],
            ['alternatif_id' => 4, 'kriteria_id' => 2, 'nilai' => 4.50, 'kelas_id' => null],
            ['alternatif_id' => 4, 'kriteria_id' => 3, 'nilai' => 4.00, 'kelas_id' => null],
            ['alternatif_id' => 4, 'kriteria_id' => 4, 'nilai' => 3.00, 'kelas_id' => null],
            ['alternatif_id' => 4, 'kriteria_id' => 5, 'nilai' => 4.50, 'kelas_id' => null],

            // A5
            ['alternatif_id' => 5, 'kriteria_id' => 1, 'nilai' => 4.50, 'kelas_id' => null],
            ['alternatif_id' => 5, 'kriteria_id' => 2, 'nilai' => 3.00, 'kelas_id' => null],
            ['alternatif_id' => 5, 'kriteria_id' => 3, 'nilai' => 3.50, 'kelas_id' => null],
            ['alternatif_id' => 5, 'kriteria_id' => 4, 'nilai' => 4.00, 'kelas_id' => null],
            ['alternatif_id' => 5, 'kriteria_id' => 5, 'nilai' => 3.50, 'kelas_id' => null],
        ];

        DB::table('nilai_alternatif')->insert($data);
    }
}
