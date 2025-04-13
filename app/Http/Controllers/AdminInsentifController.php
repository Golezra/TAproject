<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminInsentifController extends Controller
{
    public function create(Request $request)
    {
        $query = User::query();

        // Filter berdasarkan RT
        if ($request->has('rt') && $request->rt != '') {
            $query->where('rt', $request->rt);
        }

        // Urutkan berdasarkan jumlah lapor terbanyak
        if ($request->has('sort') && $request->sort == 'lapor_terbanyak') {
            $query->orderBy('jumlah_lapor', 'desc');
        }

        $users = $query->get();

        return view('admin.insentif.add-poin', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'poin' => 'required|integer|min:1',
        ]);

        $user = User::findOrFail($request->user_id);
        $user->poin += $request->poin; // Tambahkan poin
        $user->save();

        return redirect()->back()->with('success', 'Poin berhasil ditambahkan.');
    }
}
