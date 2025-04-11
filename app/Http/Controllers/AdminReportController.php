<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\LaporSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminReportController extends Controller
{
    public function index()
    {
        $totalUsers = User::count(); // Total pengguna
        $activeSessions = User::whereNotNull('last_login_at')->count(); // Hanya hitung pengguna yang masih login
        $systemErrors = []; // Contoh: Error sistem (bisa diambil dari log atau tabel lain)

        // Ambil aktivitas terbaru (contoh: laporan sampah terbaru)
        $recentActivities = LaporSampah::with('user')
            ->latest()
            ->take(10) // Ambil 10 laporan terbaru
            ->get();

        // Kirim data ke view
        return view('admin.reports.index', compact('totalUsers', 'activeSessions', 'systemErrors', 'recentActivities'));
    }
}
