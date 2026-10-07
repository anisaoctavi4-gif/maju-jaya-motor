<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();

            $table->string('kode_transaksi')->unique();

            $table->foreignId('pelanggan_id')
                ->constrained('pelanggans')
                ->cascadeOnDelete();

            $table->foreignId('motor_id')
                ->constrained('motors')
                ->cascadeOnDelete();

            $table->decimal('harga_motor', 15, 2);

            $table->integer('jumlah');

            $table->decimal('total_bayar', 15, 2);

            $table->enum('metode_pembayaran', [
                'Cash',
                'Cicilan'
            ]);

            $table->decimal('uang_muka', 15, 2)
                ->default(0);

            $table->enum('status_pembayaran', [
                'Lunas',
                'Cicil'
            ]);

            $table->date('tanggal_transaksi');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transaksis');
    }
};