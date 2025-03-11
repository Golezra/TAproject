<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class PasswordResetController extends Controller
{
    public function showResetForm($token)
    {
        return view('sesi.change-password')->with(['token' => $token]);
    }

   public function reset(Request $request)
   {
       $request->validate([
           'email' => 'required|email',
           'password' => 'required|min:6|confirmed',
           'token' => 'required',
       ]);
   
       // Mencari pengguna berdasarkan email
       $user = User::where('email', $request->email)->first();
   
       if (!$user) {
           return back()->withErrors(['email' => 'Email tidak ditemukan.']);
       }
   
       // Memeriksa token di database
       $tokenRecord = DB::table('password_reset_tokens')->where('token', $request->token)->first();
   
       if (!$tokenRecord) {
           return back()->withErrors(['token' => 'Token tidak valid.']);
       }
   
       // Jika pengguna ditemukan dan token valid, ubah password
       $user->password = Hash::make($request->password);
       $user->save();
   
       // Hapus token setelah berhasil
       DB::table('password_reset_tokens')->where('token', $request->token)->delete();
   
       return redirect()->route('sesi')->with('success', 'Password telah berhasil direset.');
   }

    public function verifyCode(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'code' => 'required|digits:6',
        ]);
    
        $user = DB::table('password_reset_tokens')->where('email', $request->email)->where('token', $request->code)->first();
    
        if (!$user) {
            return back()->withErrors(['code' => 'Kode tidak valid.']);
        }
    
        Log::info('Redirecting to sesi after password reset for email: ' . $request->email);
    
        // Jika valid, arahkan pengguna ke halaman reset password
        return redirect()->route('sesi', ['token' => $user->token]);

    }

    
}