<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporSampah extends Model
{
    use HasFactory;

    protected $table = 'lapor_sampah'; // Nama tabel yang benar

    protected $fillable = [
        'lokasi_sampah',
        'keterangan_lokasi_sampah',
        'jenis_sampah',
        'berat_sampah',
        'status',
        'status_bayar',
        'status_laporan', // Tambahkan kolom ini
        'foto_sampah',
        'user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
