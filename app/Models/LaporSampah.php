<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporSampah extends Model
{
    use HasFactory;

    protected $fillable = [
        'lokasi_sampah',
        'rt',
        'keterangan_lokasi_sampah',
        'jenis_sampah',
        'berat_sampah',
        'foto_sampah',
        'user_id',
        'status',
    ];
}
