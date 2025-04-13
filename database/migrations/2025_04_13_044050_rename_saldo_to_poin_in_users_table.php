<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom baru 'poin'
            $table->integer('poin')->default(0)->after('saldo');
        });

        // Salin data dari 'saldo' ke 'poin'
        DB::statement('UPDATE users SET poin = saldo');

        // Hapus kolom 'saldo'
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('saldo');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kembali kolom 'saldo'
            $table->integer('saldo')->default(0)->after('poin');
        });

        // Salin data dari 'poin' ke 'saldo'
        DB::statement('UPDATE users SET saldo = poin');

        // Hapus kolom 'poin'
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('poin');
        });
    }
};
