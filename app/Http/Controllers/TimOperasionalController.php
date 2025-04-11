<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporSampah;

class TimOperasionalController extends Controller
{
    public function index()
    {
        return view('dashboard.tim-operasional'); // Pastikan nama view sesuai
    }

    public function laporanMenunggu()
    {
        // Mengambil semua laporan sampah yang statusnya 'menunggu diangkut'
        // dan memuat relasi user untuk setiap laporan
        $laporan = LaporSampah::where('status', 'menunggu diangkut')->with('user')->get();
        return view('tim-operasional.laporan-menunggu', compact('laporan'));
    }

    public function laporanDiangkut()
    {
        // Mengambil semua laporan sampah yang statusnya 'diangkut'
        // dan memuat relasi user untuk setiap laporan
        $laporan = LaporSampah::where('status', 'diangkut')->with('user')->get();

        // Kirim data laporan ke view
        return view('tim-operasional.laporan-diangkut', compact('laporan'));
    }
}
