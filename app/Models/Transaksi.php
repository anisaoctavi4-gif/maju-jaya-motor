<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $fillable = [
        'kode_transaksi',
        'pelanggan_id',
        'motor_id',
        'harga_motor',
        'jumlah',
        'total_bayar',
        'metode_pembayaran',
        'uang_muka',
        'status_pembayaran',
        'tanggal_transaksi',
    ];

    protected $casts = [
        'harga_motor' => 'decimal:2',
        'total_bayar' => 'decimal:2',
        'uang_muka' => 'decimal:2',
        'jumlah' => 'integer',
        'tanggal_transaksi' => 'date',
    ];

    /**
     * Relasi transaksi dengan pelanggan.
     */
    public function pelanggan()
    {
        return $this->belongsTo(Pelanggan::class);
    }

    /**
     * Relasi transaksi dengan motor.
     */
    public function motor()
    {
        return $this->belongsTo(Motor::class);
    }
}