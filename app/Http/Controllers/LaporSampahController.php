<?php

namespace App\Http\Controllers;

use App\Models\LaporSampah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class LaporSampahController extends Controller
{
    public function create()
    {
        return view('halaman.lapor-sampah');
    }
    // Rute untuk menampilkan form laporan sampah
    public function store(Request $request)
    {
        // Validasi permintaan
        $request->validate([
            'lokasisampah' => 'required',
            'keteranganlokasisampah' => 'required|string',
            'jenisSampah' => 'required',
            'beratSampah' => 'required|numeric',
            'fotoSampah' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Validasi untuk foto
        ]);

        // Log data yang diterima
        Log::info($request->all());

        // Inisialisasi data untuk disimpan
        $data = [
            'lokasi_sampah' => $request->lokasisampah,
            'rt' => $request->lokasisampah, // Menambahkan field 'rt'
            'keterangan_lokasi_sampah' => $request->keteranganlokasisampah,
            'jenis_sampah' => $request->jenisSampah,
            'berat_sampah' => $request->beratSampah,
            'status' => 'pending',
            'user_id' => Auth::id(), // Menambahkan user_id
        ];

        // Tangani upload foto jika ada
        if ($request->hasFile('fotoSampah')) {
            $fileName = $request->file('fotoSampah')->store('img/foto-sampah', 'public'); // Simpan di folder public/img/foto-sampah
            $data['foto_sampah'] = $fileName; // Simpan nama file di database
        }

        // Coba menyimpan data dan tangkap kesalahan
        try {
            LaporSampah::create($data);
            return redirect()->route('lapor-sampah.create')->with('success', 'Laporan berhasil dibuat!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan laporan: ' . $e->getMessage());
        }
    }
}
