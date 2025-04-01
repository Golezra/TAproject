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
            $table->string('status_bayar')->default('belum lunas')->after('status'); // Tambahkan kolom status_bayar
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lapor_sampah', function (Blueprint $table) {
            $table->dropColumn('status_bayar'); // Hapus kolom jika rollback
        });
    }
};
