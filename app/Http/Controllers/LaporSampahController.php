<?php

namespace App\Http\Controllers;

use App\Models\LaporSampah;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;
use Midtrans\Notification;
use Illuminate\Support\Str;

class LaporSampahController extends Controller
{
    public function create()
    {
        return view('halaman.lapor-sampah');
    }
    // Rute untuk menampilkan form laporan sampah
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'lokasi_sampah' => 'required|string',
            'keterangan_lokasi_sampah' => 'required|string',
            'jenis_sampah' => 'required|string',
            'berat_sampah' => 'required|numeric',
            'foto_sampah' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        // Ambil data pengguna yang sedang login
        $user = auth()->user();

        // Hitung nominal berdasarkan jenis sampah dan berat
        $nominal = 0;
        if ($request->jenis_sampah === 'organik') {
            $nominal = $request->berat_sampah * 5000;
        } elseif ($request->jenis_sampah === 'anorganik') {
            $nominal = $request->berat_sampah * 2500;
        } elseif ($request->jenis_sampah === 'campuran') {
            $nominal = $request->berat_sampah * 10000;
        }

        // Data yang akan disimpan
        $data = [
            'lokasi_sampah' => $request->lokasi_sampah,
            'rt' => $user->rt, // Ambil nilai RT dari tabel users
            'keterangan_lokasi_sampah' => $request->keterangan_lokasi_sampah,
            'jenis_sampah' => $request->jenis_sampah,
            'berat_sampah' => $request->berat_sampah,
            'nominal' => $nominal,
            'status' => 'pending',
            'status_bayar' => 'belum lunas',
            'status_laporan' => 'pending',
            'user_id' => $user->id, // Ambil ID pengguna yang sedang login
        ];

        // Simpan file foto sampah
        if ($request->hasFile('foto_sampah')) {
            $file = $request->file('foto_sampah');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/img/foto-sampah', $filename); // Simpan file ke storage/app/public/img/foto-sampah
            $data['foto_sampah'] = 'img/foto-sampah/' . $filename; // Simpan path relatif ke database
            Log::info('Path foto sampah:', ['path' => $data['foto_sampah']]);
        }

        // Simpan ke database
        LaporSampah::create($data);

        // Perbarui jumlah laporan pengguna
        $user->increment('jumlah_lapor');
        $user->refresh();

        Log::info('Jumlah laporan pengguna:', ['user_id' => $user->id, 'jumlah_lapor' => $user->jumlah_lapor]);

        // Redirect dengan pesan sukses
        return redirect()->back()->with('success', 'Laporan sampah berhasil disimpan.');
    }

    public function riwayat(Request $request)
    {
        $query = LaporSampah::query();

        if (Auth::user()->role === 'user') {
            $query->where('user_id', Auth::id());
        }

        if ($request->has('month')) {
            $month = $request->month;
            $query->whereMonth('created_at', '=', date('m', strtotime($month)))
                  ->whereYear('created_at', '=', date('Y', strtotime($month)));
        }

        $laporan = $query->get();

        return view('halaman.riwayat-lapor', compact('laporan'));
    }

    public function edit($id)
    {
        $laporan = LaporSampah::findOrFail($id);
        // Hanya Admin yang bisa mengedit
        if (Auth::user()->role !== 'admin') {
            return redirect()->route('riwayat-lapor')->with('error', 'Anda tidak memiliki akses untuk mengedit laporan ini.');
        }
        // Kirim data ke view
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

        // Ubah status menjadi 'menunggu diangkut'
        $laporan->status = 'menunggu diangkut';
        $laporan->status_bayar = 'belum lunas';
        $laporan->status_laporan = 'selesai'; // Perbarui status_laporan
        $laporan->save();

        return redirect()->route('riwayat-lapor')->with('success', 'Laporan berhasil divalidasi.');
    }

    public function ubahStatus($id, $status)
    {
        // Temukan laporan berdasarkan ID
        $laporan = LaporSampah::findOrFail($id);

        // Pastikan hanya tim operasional yang dapat mengubah status
        if (auth()->user()->role !== 'tim_operasional') {
            return redirect()->route('tim-operasional.laporan.menunggu')->with('error', 'Anda tidak memiliki akses untuk mengubah status laporan ini.');
        }

        // Ubah status laporan
        $laporan->status = $status;
        $laporan->save();

        return redirect()->route('tim-operasional.laporan.menunggu')->with('success', 'Status laporan berhasil diubah menjadi "' . ucfirst($status) . '".');
    }

    public function showPembayaran($id)
    {
        $laporan = LaporSampah::findOrFail($id);

        // Pastikan hanya laporan dengan status_bayar 'belum lunas' yang bisa diakses
        if ($laporan->status_bayar === 'lunas') {
            return redirect()->route('riwayat-lapor')->with('error', 'Laporan ini sudah dibayar.');
        }

        return view('halaman.pembayaran', compact('laporan'));
    }

    public function bayar($id)
    {
        $laporan = LaporSampah::findOrFail($id);

        // Pastikan hanya pengguna yang memiliki laporan ini yang dapat membayar
        if (Auth::id() !== $laporan->user_id) {
            return redirect()->route('riwayat-lapor')->with('error', 'Anda tidak memiliki akses untuk membayar laporan ini.');
        }

        // Perbarui status pembayaran
        $laporan->status_bayar = 'lunas';
        $laporan->save();

        return redirect()->route('riwayat-lapor')->with('success', 'Pembayaran berhasil dilakukan.');
    }

    public function pembayaran($id)
    {
        $laporan = LaporSampah::findOrFail($id);

        // Pastikan hanya pengguna yang memiliki laporan ini yang dapat mengakses
        if (Auth::id() !== $laporan->user_id) {
            return redirect()->route('riwayat-lapor')->with('error', 'Anda tidak memiliki akses ke pembayaran laporan ini.');
        }

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        Log::info('Server Key:', ['key' => Config::$serverKey]);

        // Data transaksi
        $order_id = $laporan->order_id ?? 'LAPOR-' . $laporan->id . '-' . time();

        $transactionDetails = [
            'order_id' => $order_id,
            'gross_amount' => $laporan->nominal, // Total pembayaran
        ];

        // Data item
        $itemDetails = [
            [
                'id' => $laporan->id,
                'price' => $laporan->nominal,
                'quantity' => 1,
                'name' => ucfirst($laporan->jenis_sampah),
            ],
        ];

        // Data pelanggan
        $customerDetails = [
            'first_name' => $laporan->user->name,
            'email' => $laporan->user->email,
            'phone' => $laporan->user->phone_number,
        ];

        // Parameter transaksi
        $transaction = [
            'transaction_details' => $transactionDetails,
            'item_details' => $itemDetails,
            'customer_details' => $customerDetails,
        ];

        // Buat Snap Token
        $snapToken = Snap::getSnapToken($transaction);

        // Simpan order_id ke laporan
        $laporan->order_id = $transactionDetails['order_id'];
        $laporan->save();

        // Kirim data ke view
        return view('halaman.pembayaran', compact('laporan', 'snapToken'));
    }

    public function handleNotification(Request $request)
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Ambil notifikasi dari Midtrans
        $notification = new Notification();

        $transactionStatus = $notification->transaction_status;
        $orderId = $notification->order_id;

        // Cari laporan berdasarkan order_id
        $laporan = LaporSampah::where('order_id', $orderId)->first();

        if (!$laporan) {
            Log::error('Laporan tidak ditemukan untuk order_id: ' . $orderId);
            return response()->json(['message' => 'Laporan tidak ditemukan'], 404);
        }

        // Perbarui status pembayaran berdasarkan status transaksi
        if ($transactionStatus == 'capture' || $transactionStatus == 'settlement') {
            $laporan->status_bayar = 'lunas';
        } elseif ($transactionStatus == 'pending') {
            $laporan->status_bayar = 'menunggu';
        } elseif ($transactionStatus == 'deny' || $transactionStatus == 'expire' || $transactionStatus == 'cancel') {
            $laporan->status_bayar = 'gagal';
        }

        $laporan->save();

        Log::info('Status pembayaran diperbarui untuk order_id: ' . $orderId . ' dengan status: ' . $transactionStatus);

        return response()->json(['message' => 'Notifikasi berhasil diproses'], 200);
    }
}
