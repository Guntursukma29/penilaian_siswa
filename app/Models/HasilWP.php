<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HasilWP extends Model
{
    use HasFactory;

    protected $table = 'hasil_wp';

    protected $fillable = [
        'alternatif_id',
        'kelas_id',
        'nilai_preferensi',
        'ranking',
    ];

    public function alternatif()
    {
        return $this->belongsTo(Alternatif::class, 'alternatif_id');
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
}
