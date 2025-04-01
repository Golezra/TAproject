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
            'fotoSampah' => 'required|image|mimes:jpg,png,jpeg|max:2048', // Validasi untuk foto
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
            $fileName = $request->file('fotoSampah')->store('img/foto-sampah', 'public');
            $data['foto_sampah'] = $fileName; // Simpan path relatif ke database
        }

        // Coba menyimpan data dan tangkap kesalahan
        try {
            LaporSampah::create($data);
            return redirect()->route('lapor-sampah.create')->with('success', 'Laporan berhasil dibuat!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal menyimpan laporan: ' . $e->getMessage());
        }
    }

    public function riwayat()
    {
        // Ambil data laporan sampah berdasarkan user yang sedang login
        // Periksa apakah pengguna adalah admin?
        if (Auth::user()->role === 'admin') {
            // Jika admin, ambil semua laporan
            $laporan = LaporSampah::all();
        } else {
            // Jika bukan admin, ambil laporan berdasarkan user_id
            $laporan = LaporSampah::where('user_id', Auth::id())->get();
        }

        // Tambahkan perhitungan nominal ke setiap laporan
        foreach ($laporan as $item) {
            $item->nominal = $item->jenis_sampah === 'organik'
                ? $item->berat_sampah * 5000
                : $item->berat_sampah * 10000;
        }

        // Kirim data ke view
        return view('halaman.riwayat-lapor', compact('laporan'));
    }

    public function edit($id)
    {
        $laporan = LaporSampah::findOrFail($id);

        // Pastikan hanya user yang membuat laporan yang bisa mengedit
        if ($laporan->user_id !== Auth::id()) {
            return redirect()->route('riwayat-lapor')->with('error', 'Anda tidak memiliki akses untuk mengedit laporan ini.');
        }

        return view('halaman.edit-lapor', compact('laporan'));
    }

    public function update(Request $request, $id)
    {
        // Temukan laporan berdasarkan ID
        $laporan = LaporSampah::findOrFail($id);

        // Validasi data
        $request->validate([
            'lokasisampah' => 'required|string',
            'keteranganlokasisampah' => 'required|string',
            'jenisSampah' => 'required|string',
            'beratSampah' => 'required|numeric',
            'fotoSampah' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        // Update data laporan
        $laporan->lokasi_sampah = $request->lokasisampah;
        $laporan->keterangan_lokasi_sampah = $request->keteranganlokasisampah;
        $laporan->jenis_sampah = $request->jenisSampah;
        $laporan->berat_sampah = $request->beratSampah;

        // Jika ada file foto baru, simpan dan ganti foto lama
        if ($request->hasFile('fotoSampah')) {
            $fileName = $request->file('fotoSampah')->store('img/foto-sampah', 'public');
            $laporan->foto_sampah = $fileName;
        }

        // Simpan perubahan
        $laporan->save();

        // Redirect dengan pesan sukses
        return redirect()->route('riwayat-lapor')->with('success', 'Laporan berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $laporan = LaporSampah::findOrFail($id);

        // Hanya admin yang dapat menghapus laporan
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('riwayat-lapor')->with('error', 'Anda tidak memiliki akses untuk menghapus laporan ini.');
        }

        $laporan->delete();

        return redirect()->route('riwayat-lapor')->with('success', 'Laporan berhasil dihapus.');
    }

    public function validasi($id)
    {
        $laporan = LaporSampah::findOrFail($id);

        // Pastikan hanya admin yang bisa memvalidasi
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('riwayat-lapor')->with('error', 'Anda tidak memiliki akses untuk memvalidasi laporan ini.');
        }

        // Ubah status menjadi 'tervalidasi'
        $laporan->status = 'tervalidasi';
        $laporan->save();

        return redirect()->route('riwayat-lapor')->with('success', 'Laporan berhasil divalidasi.');
    }

    public function ubahStatus($id, $status)
    {
        $laporan = LaporSampah::findOrFail($id);

        // Pastikan hanya admin atau tim operasional yang bisa mengubah status
        if (Auth::user()->role === 'admin' && $status === 'menunggu diangkut') {
            $laporan->status = 'menunggu diangkut';
        } elseif (Auth::user()->role === 'tim_operasional' && $status === 'diangkut') {
            $laporan->status = 'diangkut';
        } else {
            return redirect()->route('riwayat-lapor')->with('error', 'Anda tidak memiliki akses untuk mengubah status ini.');
        }

        $laporan->save();

        return redirect()->route('riwayat-lapor')->with('success', 'Status laporan berhasil diubah menjadi ' . $status . '.');
    }
}
