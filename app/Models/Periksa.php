<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Periksa extends Model
{
    use HasFactory;
    protected $table = 'periksa';
    public $timestamps = false;
    protected $fillable = [
        'catatan',
        'id_daftar_poli',
        'tgl_periksa',
        'biaya_periksa',
    ];
}
