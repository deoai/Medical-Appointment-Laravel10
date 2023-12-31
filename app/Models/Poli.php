<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poli extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'poli';
    protected $fillable = [
        'nama_poli',
        'keterangan',
    ];
}
