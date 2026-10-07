<?php

namespace App\Http\Controllers;

use App\Models\Motor;
use App\Models\Pelanggan;
use App\Models\Transaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
    /**
     * Menampilkan semua transaksi.
     */
    public function index()
    {
        $transaksis = Transaksi::with(['pelanggan', 'motor'])
            ->latest()
            ->get();

        return view('transaksis.index', compact('transaksis'));
    }

    /**
     * Menampilkan form tambah transaksi.
     */
    public function create()
    {
        $pelanggans = Pelanggan::orderBy('nama')->get();

        $motors = Motor::where('status', 'tersedia')
            ->where('stok', '>', 0)
            ->orderBy('nama_motor')
            ->get();

        return view('transaksis.create', compact('pelanggans', 'motors'));
    }

    /**
     * Menyimpan transaksi baru.
     */
    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'motor_id' => 'required|exists:motors,id',
            'jumlah' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|in:Cash,Cicilan',
            'uang_muka' => 'nullable|numeric|min:0',
            'status_pembayaran' => 'required|in:Lunas,Cicil',
            'tanggal_transaksi' => 'required|date',
        ]);

        DB::transaction(function () use ($request) {

            $motor = Motor::lockForUpdate()
                ->findOrFail($request->motor_id);

            if ($request->jumlah > $motor->stok) {
                abort(
                    redirect()
                        ->back()
                        ->withInput()
                        ->withErrors([
                            'jumlah' => 'Jumlah pembelian melebihi stok motor yang tersedia.'
                        ])
                );
            }

            $hargaMotor = $motor->harga;
            $totalBayar = $hargaMotor * $request->jumlah;
            $uangMuka = $request->uang_muka ?? 0;

            if ($uangMuka > $totalBayar) {
                abort(
                    redirect()
                        ->back()
                        ->withInput()
                        ->withErrors([
                            'uang_muka' => 'Uang muka tidak boleh lebih besar dari total pembayaran.'
                        ])
                );
            }

            $kodeTransaksi = 'TRX-' . date('YmdHis') . '-' . strtoupper(Str::random(4));

            Transaksi::create([
                'kode_transaksi' => $kodeTransaksi,
                'pelanggan_id' => $request->pelanggan_id,
                'motor_id' => $request->motor_id,
                'harga_motor' => $hargaMotor,
                'jumlah' => $request->jumlah,
                'total_bayar' => $totalBayar,
                'metode_pembayaran' => $request->metode_pembayaran,
                'uang_muka' => $uangMuka,
                'status_pembayaran' => $request->status_pembayaran,
                'tanggal_transaksi' => $request->tanggal_transaksi,
            ]);

            $motor->decrement('stok', $request->jumlah);

            $motor->refresh();

            if ($motor->stok <= 0) {
                $motor->update([
                    'status' => 'terjual'
                ]);
            } else {
                $motor->update([
                    'status' => 'tersedia'
                ]);
            }
        });

        return redirect()
            ->route('transaksis.index')
            ->with('success', 'Transaksi berhasil disimpan.');
    }

    /**
     * Menampilkan detail transaksi / nota.
     */
    public function show(Transaksi $transaksi)
    {
        $transaksi->load(['pelanggan', 'motor']);

        return view('transaksis.show', compact('transaksi'));
    }

    /**
     * Menampilkan form edit transaksi.
     */
    public function edit(Transaksi $transaksi)
    {
        $pelanggans = Pelanggan::orderBy('nama')->get();

        $motors = Motor::orderBy('nama_motor')->get();

        return view('transaksis.edit', compact(
            'transaksi',
            'pelanggans',
            'motors'
        ));
    }

    /**
     * Mengupdate transaksi.
     */
    public function update(Request $request, Transaksi $transaksi)
    {
        $request->validate([
            'pelanggan_id' => 'required|exists:pelanggans,id',
            'motor_id' => 'required|exists:motors,id',
            'jumlah' => 'required|integer|min:1',
            'metode_pembayaran' => 'required|in:Cash,Cicilan',
            'uang_muka' => 'nullable|numeric|min:0',
            'status_pembayaran' => 'required|in:Lunas,Cicil',
            'tanggal_transaksi' => 'required|date',
        ]);

        DB::transaction(function () use ($request, $transaksi) {

            /*
             * Kembalikan stok dari transaksi lama terlebih dahulu.
             */
            $motorLama = Motor::lockForUpdate()
                ->findOrFail($transaksi->motor_id);

            $motorLama->increment('stok', $transaksi->jumlah);

            $motorLama->refresh();

            $motorLama->update([
                'status' => 'tersedia'
            ]);

            /*
             * Ambil motor yang baru dipilih.
             */
            $motorBaru = Motor::lockForUpdate()
                ->findOrFail($request->motor_id);

            /*
             * Pastikan stok motor baru mencukupi.
             */
            if ($request->jumlah > $motorBaru->stok) {
                abort(
                    redirect()
                        ->back()
                        ->withInput()
                        ->withErrors([
                            'jumlah' => 'Jumlah pembelian melebihi stok motor yang tersedia.'
                        ])
                );
            }

            $hargaMotor = $motorBaru->harga;

            $totalBayar = $hargaMotor * $request->jumlah;

            $uangMuka = $request->uang_muka ?? 0;

            if ($uangMuka > $totalBayar) {
                abort(
                    redirect()
                        ->back()
                        ->withInput()
                        ->withErrors([
                            'uang_muka' => 'Uang muka tidak boleh lebih besar dari total pembayaran.'
                        ])
                );
            }

            /*
             * Kurangi stok motor baru.
             */
            $motorBaru->decrement('stok', $request->jumlah);

            $motorBaru->refresh();

            /*
             * Update status motor.
             */
            if ($motorBaru->stok <= 0) {
                $motorBaru->update([
                    'status' => 'terjual'
                ]);
            } else {
                $motorBaru->update([
                    'status' => 'tersedia'
                ]);
            }

            /*
             * Update data transaksi.
             */
            $transaksi->update([
                'pelanggan_id' => $request->pelanggan_id,
                'motor_id' => $request->motor_id,
                'harga_motor' => $hargaMotor,
                'jumlah' => $request->jumlah,
                'total_bayar' => $totalBayar,
                'metode_pembayaran' => $request->metode_pembayaran,
                'uang_muka' => $uangMuka,
                'status_pembayaran' => $request->status_pembayaran,
                'tanggal_transaksi' => $request->tanggal_transaksi,
            ]);
        });

        return redirect()
            ->route('transaksis.index')
            ->with('success', 'Transaksi berhasil diperbarui.');
    }

    /**
     * Menghapus transaksi.
     */
    public function destroy(Transaksi $transaksi)
    {
        DB::transaction(function () use ($transaksi) {

            /*
             * Kembalikan stok motor
             * karena transaksi dibatalkan/dihapus.
             */
            $motor = Motor::lockForUpdate()
                ->find($transaksi->motor_id);

            if ($motor) {
                $motor->increment('stok', $transaksi->jumlah);

                $motor->refresh();

                $motor->update([
                    'status' => 'tersedia'
                ]);
            }

            /*
             * Hapus transaksi.
             */
            $transaksi->delete();
        });

        return redirect()
            ->route('transaksis.index')
            ->with('success', 'Transaksi berhasil dihapus dan stok motor telah dikembalikan.');
    }
}