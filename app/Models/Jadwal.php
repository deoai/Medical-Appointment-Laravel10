<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jadwal extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'jadwal_periksa';
    protected $fillable = [
        'id_dokter',
        'hari',
        'jam_mulai',
        'jam_selesai',
    ];
    public function DaftarPoli()
    {
        return $this->hasMany(DaftarPoli::class, 'id_jadwal');
    }
    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id');
    }
    public function dokter()
    {
        return $this->belongsTo(Dokter::class, 'id_dokter', 'id');
    }
}
