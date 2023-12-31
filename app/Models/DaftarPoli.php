<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DaftarPoli extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'daftar_poli';
    protected $fillable = [
        'id_pasien',
        'keluhan',
        'id_jadwal',
        'no_antrian'
    ];
    public function jadwal()
    {
        return $this->belongsTo(Jadwal::class, 'id_jadwal', 'id');
    }
    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id');
    }
    public function dokter()
    {
        return $this->belongsTo(Dokter::class);
    }
}
