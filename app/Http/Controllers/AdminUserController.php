<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index(Request $request)
    {
        // Ambil semua RT yang tersedia
        $rts = User::select('rt')->distinct()->pluck('rt');

        // Query dasar
        $query = User::query();

        // Filter berdasarkan RT
        if ($request->has('rt') && $request->rt != '') {
            $query->where('rt', $request->rt);
        }

        // Urutkan berdasarkan jumlah laporan
        if ($request->has('sort') && $request->sort != '') {
            $query->orderBy('jumlah_lapor', $request->sort);
        }

        // Ambil data user
        if (!$request->has('rt') && !$request->has('sort')) {
            $users = User::all(); // Ambil semua data jika tidak ada filter
        } else {
            $users = $query->get(); // Ambil data berdasarkan filter
        }

        return view('admin.users.index', compact('users', 'rts'));
    }

    public function destroy($id)
    {
        // Cari pengguna berdasarkan ID
        $user = User::findOrFail($id);

        // Hapus pengguna
        $user->delete();

        // Redirect dengan pesan sukses
        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id); // Ambil data user berdasarkan ID
        return view('admin.users.edit-user', compact('user')); // Kirim data ke view
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'role' => 'required|in:admin,tim_operasional,user', 
            'phone_number' => 'required|string|regex:/^\d{10,15}$/', 
            'rt' => 'required|string|max:5',
            'nik' => 'required|unique:users|string|max:16',
            'pict' => 'required|mimes:jpg,jpeg,png|max:2048'

        ]);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        $user->rt = $request->rt;
        $user->phone_number = $request->phone_number;
        $user->nik = $request->nik;
        $user->pict = $request->hasFile('pict') ? $request->file('pict')->store('img/pict') : $user->pict; // Update foto jika ada
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'User updated successfully.');
    }
}
