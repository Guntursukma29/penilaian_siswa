<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alternatif extends Model
{
    use HasFactory;

    protected $table = 'alternatif';

    protected $fillable = [
        'kode',
        'nama_alternatif',
        'kelas_id',
    ];

    public function nilaiKriteria()
    {
        return $this->hasMany(NilaiAlternatif::class, 'alternatif_id');
    }
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id');
    }
    public function hasil()
    {
        return $this->hasOne(HasilWP::class);
    }
}
