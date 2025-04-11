<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Midtrans\Config;
use Midtrans\Snap;
use App\Models\LaporSampah;

class PaymentController extends Controller
{
    public function createTransaction($id)
    {
        // Ambil laporan berdasarkan ID
        $laporan = LaporSampah::findOrFail($id);

        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = config('midtrans.is_sanitized');
        Config::$is3ds = config('midtrans.is_3ds');

        // Buat order_id baru jika transaksi sebelumnya kedaluwarsa
        $order_id = 'LAPOR-' . $laporan->id . '-' . time();

        // Data transaksi
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
            'expiry' => [
                'start_time' => now()->format('Y-m-d H:i:s O'), // Waktu mulai transaksi
                'unit' => 'minutes', // Satuan waktu (minutes, hours, days)
                'duration' => 1440, // Durasi kedaluwarsa transaksi (1 hari)
            ],
        ];

        // Log transaction details
        Log::info('Transaction Details:', $transaction);

        // Buat Snap Token
        $snapToken = Snap::getSnapToken($transaction);

        // Simpan order_id baru ke laporan
        $laporan->order_id = $transactionDetails['order_id'];
        $laporan->save();

        return view('halaman.pembayaran', compact('laporan', 'snapToken'));
    }
}
