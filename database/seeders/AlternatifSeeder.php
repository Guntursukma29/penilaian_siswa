<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AlternatifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('alternatif')->insert([
            [
                'kode' => 'A1',
                'nama_alternatif' => 'Ahmad Fauzi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'A2',
                'nama_alternatif' => 'Budi Santoso',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'A3',
                'nama_alternatif' => 'Citra Dewi',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'A4',
                'nama_alternatif' => 'Dewi Lestari',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'kode' => 'A5',
                'nama_alternatif' => 'Eko Prasetyo',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
