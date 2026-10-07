<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\Pelanggan;
use App\Models\Transaksi;

class DashboardController extends Controller
{
    public function index()
    {
        $totalMotor = Motor::count();

        $totalPelanggan = Pelanggan::count();

        $totalTransaksi = Transaksi::count();

        $totalPembelian = Transaksi::count();

        return view('welcome', compact(
            'totalMotor',
            'totalPelanggan',
            'totalTransaksi',
            'totalPembelian'
        ));
    }
}