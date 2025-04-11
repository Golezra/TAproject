<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminUserController extends Controller
{
    public function index()
    {
        // Ambil data pengguna dari database
        $users = \App\Models\User::all();

        // Tampilkan view dengan data pengguna
        return view('admin.users.index', compact('users'));
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
}
