<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KriteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kriteria')->insert([
            [
                'kode' => 'C1',
                'nama_kriteria' => 'Pelanggaran',
                'tipe' => 'cost',
                'bobot' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C2',
                'nama_kriteria' => 'Absensi',
                'tipe' => 'cost',
                'bobot' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C3',
                'nama_kriteria' => 'Kesopanan',
                'tipe' => 'benefit',
                'bobot' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C4',
                'nama_kriteria' => 'Nilai MunaQosah',
                'tipe' => 'benefit',
                'bobot' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'C5',
                'nama_kriteria' => 'Nilai Kitabah',
                'tipe' => 'benefit',
                'bobot' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
