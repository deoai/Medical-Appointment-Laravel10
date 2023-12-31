<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dokter extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'dokter';
    protected $fillable = [
        'id_akun',
        'id_poli',
        'nama',
        'alamat',
        'no_hp',
    ];
    public function poli()
    {
        return $this->belongsTo(Poli::class, 'id_poli');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_akun', 'id');
    }
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class, 'id');
    }
    public function daftarpoli()
    {
        return $this->hasMany(DaftarPoli::class, 'id');
    }
}
