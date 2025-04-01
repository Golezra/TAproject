<?php

namespace App\Http\Controllers;

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
}
