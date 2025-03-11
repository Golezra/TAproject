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
        Schema::create('lapor_sampah', function (Blueprint $table) {
            $table->id();
            $table->string('lokasi_sampah');
            $table->string('rt');
            $table->text('keterangan_lokasi_sampah')->nullable();
            $table->string('jenis_sampah');
            $table->float('berat_sampah')->nullable();
            $table->string('foto_sampah')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lapor_sampah');
    }
};
