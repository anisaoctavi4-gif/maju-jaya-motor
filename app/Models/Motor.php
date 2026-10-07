<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Motor extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_motor',
        'merk',
        'tipe',
        'tahun',
        'harga',
        'stok',
        'foto',
        'status',
        'deskripsi',
    ];

    protected $casts = [
        'tahun' => 'integer',
        'harga' => 'decimal:2',
        'stok' => 'integer',
    ];
}