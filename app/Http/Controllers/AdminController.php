<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('dashboard.admin'); 
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id); 
        $user->delete(); // Hapus pengguna

        return redirect()->route('admin.users.index')->with('success', 'Pengguna berhasil dihapus.');
    }
}
