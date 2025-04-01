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
            // Ubah kolom role untuk memastikan enum mencakup 'tim_operasional'
            $table->enum('role', ['admin', 'user', 'tim_operasional'])->default('user')->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            // Kembalikan kolom role ke enum sebelumnya jika diperlukan
            $table->enum('role', ['admin', 'user'])->default('user')->change();
        });
    }
};
