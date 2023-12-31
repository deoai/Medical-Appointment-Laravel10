<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'pasien';
    protected $fillable = [
        'id_akun',
        'nama',
        'alamat',
        'no_ktp',
        'no_hp',
        'no_rm',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'id_akun', 'id');
    }
}
