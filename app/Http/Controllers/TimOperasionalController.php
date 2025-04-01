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
        // Ambil laporan dengan status 'menunggu diangkut'
        $laporan = LaporSampah::where('status', 'menunggu diangkut')->get();

        // Kirim data ke view
        return view('tim-operasional.laporan-menunggu', compact('laporan'));
    }
}
