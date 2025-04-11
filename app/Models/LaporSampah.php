<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporSampah extends Model
{
    use HasFactory;

    protected $table = 'lapor_sampah'; // Nama tabel pada database

    protected $fillable = [
        'lokasi_sampah',
        'keterangan_lokasi_sampah',
        'jenis_sampah',
        'berat_sampah',
        'foto_sampah',
        'status',
        'status_bayar',
        'status_laporan',
        'user_id',
        'nominal',
    ];

    public $timestamps = true; // Timestamps diaktifkan secara default
    protected $dates = ['created_at', 'updated_at']; // Tanggal yang akan disimpan sebagai timestamp

    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
