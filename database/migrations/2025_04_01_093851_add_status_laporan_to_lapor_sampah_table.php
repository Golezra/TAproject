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
        Schema::table('lapor_sampah', function (Blueprint $table) {
            $table->string('status_laporan')->default('pending')->after('status_bayar'); // Tambahkan kolom status_laporan
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lapor_sampah', function (Blueprint $table) {
            $table->dropColumn('status_laporan'); // Hapus kolom jika rollback
        });
    }
};
