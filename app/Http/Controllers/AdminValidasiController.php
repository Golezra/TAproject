<?php

namespace App\Http\Controllers;

use App\Models\LaporSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminValidasiController extends Controller
{
    public function index(Request $request)
    {
        $query = LaporSampah::with('user');

        // Filter berdasarkan bulan
        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', $request->bulan);
        }

        // Filter berdasarkan tahun
        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }

        $laporan = $query->get();

        return view('admin.validasi.index', compact('laporan'));
    }

    public function validasi($id)
    {
        $laporan = LaporSampah::findOrFail($id);

        // Pastikan hanya admin yang bisa memvalidasi
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('admin.validasi.index')->with('error', 'Anda tidak memiliki akses untuk memvalidasi laporan ini.');
        }

        // Ubah status menjadi 'menunggu diangkut'
        $laporan->status = 'menunggu diangkut';
        $laporan->status_bayar = 'belum lunas';
        $laporan->status_laporan = 'selesai'; // Perbarui status_laporan
        $laporan->save();

        \Log::info($laporan);

        return redirect()->route('admin.validasi.index')->with('success', 'Laporan berhasil divalidasi.');
    }

    public function cetakPdf(Request $request)
    {
        $query = LaporSampah::with('user');

        // Filter berdasarkan bulan
        if ($request->filled('bulan')) {
            $query->whereMonth('created_at', $request->bulan);
        }

        // Filter berdasarkan tahun
        if ($request->filled('tahun')) {
            $query->whereYear('created_at', $request->tahun);
        }

        $laporan = $query->get();

        // Generate PDF
        $pdf = \PDF::loadView('admin.validasi.pdf', compact('laporan'))->setPaper('a4', 'landscape');
        \Log::info('PDF berhasil dibuat.');

        return $pdf->download('laporan-sampah.pdf');
    }
}
