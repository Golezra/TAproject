<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LaporSampah;

class TimOperasionalController extends Controller
{
    public function index()
    {
        return view('dashboard.tim-operasional');
    }

    public function laporanMenunggu()
    {
        $laporan = LaporSampah::where('status', 'menunggu diangkut')->get();
        return view('tim-operasional.laporan-menunggu', compact('laporan'));
    }

    public function laporanDiangkut()
    {
        $laporan = LaporSampah::where('status', 'diangkut')->get();
        return view('tim-operasional.laporan-diangkut', compact('laporan'));
    }

    public function profil()
    {
        return view('tim-operasional.profil');
    }
}
