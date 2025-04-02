<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index()
    {
        return view('dashboard.warga'); // Halaman dashboard untuk warga
    }

    public function editProfil()
    {
        $user = auth()->user(); // Ambil data pengguna yang sedang login
        return view('dashboard.edit-profil', compact('user')); // Tampilkan halaman edit profil
    }

    public function updateProfil(Request $request)
    {
        $user = auth()->user();

        // Validasi input
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'pict' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'phone_number' => 'required|string|regex:/^\d{10,15}$/',
            'rt' => 'required|string|max:5',
            'nik' => 'required|string|max:16|unique:users,nik,' . $user->id,
        ]);

        // Update data pengguna
        $user->name = $request->name;
        $user->email = $request->email;
        $user->rt = $request->rt;
        $user->phone_number = $request->phone_number;
        $user->nik = $request->nik;

        // Update foto profil jika ada
        if ($request->hasFile('pict')) {
            $file = $request->file('pict');
            $filename = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('img/pict'), $filename);
            $user->pict = $filename;
        }

        $user->save();

        return redirect()->route('warga.dashboard')->with('success', 'Profil berhasil diperbarui.');
    }
}
