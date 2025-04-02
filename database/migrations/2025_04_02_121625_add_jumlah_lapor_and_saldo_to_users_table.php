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
        Schema::table('users', function (Blueprint $table) {
            $table->integer('jumlah_lapor')->default(0)->after('email'); // Tambahkan kolom jumlah_lapor
            $table->decimal('saldo', 15, 2)->default(0)->after('jumlah_lapor'); // Tambahkan kolom saldo
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('jumlah_lapor'); // Hapus kolom jumlah_lapor
            $table->dropColumn('saldo'); // Hapus kolom saldo
        });
    }
};
