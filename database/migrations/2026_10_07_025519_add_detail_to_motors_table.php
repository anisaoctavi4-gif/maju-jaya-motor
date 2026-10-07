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
        Schema::table('motors', function (Blueprint $table) {
            $table->string('nama_motor')->after('id');
            $table->string('foto')->nullable()->after('stok');
            $table->enum('status', ['tersedia', 'terjual'])
                ->default('tersedia')
                ->after('foto');
            $table->text('deskripsi')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('motors', function (Blueprint $table) {
            $table->dropColumn([
                'nama_motor',
                'foto',
                'status',
                'deskripsi'
            ]);
        });
    }
};