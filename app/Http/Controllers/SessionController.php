<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Mail\ForgotPassword;

class SessionController extends Controller
{
    public function index()
    {
        return view('sesi.index');
    }

    public function login(Request $request)
    {
        Session::flash('email', $request->email);
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ], [
            'email.required' => 'Email harus diisi.',
            'email.email' => 'Format email tidak valid.',
            'password.required' => 'Password harus diisi.',
        ]);

        $credentials = $request->only('email', 'password');

        // Log email dan password yang diinput
        Log::info('Attempting login for email: ' . $request->email);
        // Log::info('Input password: ' . $request->password);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            // Log password yang di-hash dari database
            Log::info('Hashed password from database: ' . $user->password);
            if (!$user->email_verified_at) {
                Log::info('Email not verified: ' . $user->email);
                return redirect('sesi')->with('error', 'Anda belum terverifikasi, silakan cek email Anda untuk verifikasi.');
            }
            return redirect($user->role == 'admin' ? 'dashboard/admin' : 'dashboard/warga')->with('success', 'Login berhasil');
        }

        return redirect('sesi')->withErrors(['loginError' => 'Login gagal, silakan coba lagi.']);
    }

    protected function authenticated(Request $request, $user)
    {
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'tim_operasional') { // Perbaiki pemeriksaan role
            return redirect()->route('tim-operasional.dashboard');
        } else {
            return redirect()->route('warga.dashboard'); // Default untuk warga
        }
    }

    public function logout()
    {
        Auth::logout(); // Logout pengguna
        return redirect('/')->with('success', 'Anda berhasil logout.');
    }

    public function register()
    {
        return view('sesi.register');
    }

    public function storeregister(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
            'phone_number' => 'required|string|regex:/^\d{10,15}$/', // Validasi format nomor telepon
            'rt' => 'required|string|max:5',
            'nik' => 'required|unique:users|string|max:16',
            'pict' => 'required|mimes:jpg,jpeg,png|max:2048'
        ]);

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->phone_number = $request->phone_number;
        $user->rt = $request->rt;
        $user->nik = $request->nik;
        $user->verify_key = Str::random(40); // Generate verification key

        if ($request->hasFile('pict')) {
            $filename = $request->nik . '-' . $request->file('pict')->getClientOriginalName();
            $request->file('pict')->move('img/pict/', $filename);
            $user->pict = $filename;
        }

        try {
            $user->save();
            Log::info('User saved successfully', ['email' => $user->email]);

            // Prepare verification email details
            $details = [
                'title' => 'Verifikasi Email Anda',
                'body' => 'Silakan klik tautan di bawah ini untuk memverifikasi alamat email Anda:',
                'action_url' => route('verify', ['key' => $user->verify_key]),
                'action_text' => 'Verifikasi Email',
            ];

            Mail::to($user->email)->send(new \App\Mail\Registrasi($details));

            return redirect('sesi')->with('success', 'Registrasi berhasil. Silakan cek email Anda untuk verifikasi.');
        } catch (\Exception $e) {
            Log::error('Error saving user: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan data. Silakan coba lagi.');
        }
    }

    public function verify($key)
    {
        $user = User::where('verify_key', $key)->first();
        if ($user) {
            $user->email_verified_at = now();
            $user->verify_key = null; // Clear verification key
            $user->save();

            return redirect('sesi')->with('success', 'Email Anda telah diverifikasi. Silakan login.');
        }

        return redirect('sesi')->with('error', 'Kunci verifikasi tidak valid.');
    }

    public function changePassword()
    {
        return view('sesi.change-password');
    }

    public function storeChangePassword(Request $request)
    {
        $request->validate([
            'recovery_code' => 'required|string|size:6', // Validasi untuk recovery code
            'current_password' => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);

        $user = Auth::user(); // Pastikan pengguna terautentikasi
        if (!$user) {
            return redirect()->back()->withErrors(['user' => 'User not found.']);
        }

        // Validasi kode pemulihan
        $tokenRecord = DB::table('password_reset_tokens')->where('token', $request->recovery_code)->where('email', $user->email)->first();
        if (!$tokenRecord) {
            return redirect()->back()->withErrors(['recovery_code' => 'Recovery code is invalid.']);
        }

        Log::info('Attempting to change password for user: ' . $user->email);
        Log::info('Recovery Code: ' . $request->recovery_code);
        Log::info('New Password: ' . $request->new_password);

        // Periksa apakah password saat ini benar
        if (!Hash::check($request->current_password, $user->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Current password is incorrect.']);
        }

        // Ganti password dengan password baru
        $user->password = Hash::make($request->new_password);
        $user->save();

        // Hapus token setelah berhasil
        DB::table('password_reset_tokens')->where('token', $request->recovery_code)->delete();

        return redirect()->route('dashboard.warga')->with('success', 'Password has been changed successfully.');
    }

    public function forgetPassword()
    {
        return view('sesi.forget-password');
    }

    public function storeForgetPassword(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
    
        try {
            $user = User::where('email', $request->email)->first();
            if (!$user) {
                return redirect()->route('forget-password-failed')->with('error', 'Email tidak ditemukan');
            }
    
            // Generate 6 digit security code
            $securityCode = rand(100000, 999999);
    
            // Simpan kode ke dalam database atau sesi
            DB::table('password_reset_tokens')->updateOrInsert(
                ['email' => $user->email],
                ['token' => $securityCode, 'created_at' => Carbon::now()]
            );
    
            $details = [
                'title' => 'Kode Pemulihan Password',
                'body' => 'Kode pemulihan password Anda adalah: ' . $securityCode,
                'action_url' => route('password.reset', ['token' => $securityCode]), // Pastikan ini ada
                'action_text' => 'Reset Password', // Jika Anda memerlukan teks aksi
            ];
    
            Mail::to($user->email)->send(new \App\Mail\ForgotPassword($details));
    
            return redirect()->route('sesi.forget-password-success')->with('success', 'Silahkan cek email Anda untuk kode pemulihan password');
        } catch (\Exception $e) {
            Log::error('Error sending forgot password email: ' . $e->getMessage());
            return redirect()->route('sesi.forget-password-failed')->with('error', 'Terjadi kesalahan saat mengirim email');
        }
    }

    public function forgetPasswordSuccess()
    {
        return view('sesi.forget-password-success');
    }

    public function forgetPasswordFailed()
    {
        return view('sesi.forget-password-failed');
    }

    public function resetPassword(Request $request)
    {
        // Logic to reset the password
        // After resetting the password, redirect to the login page
        return redirect()->route('login')->with('success', 'Password berhasil direset, silahkan login.');
    }

    public function handle($request, Closure $next, $role)
    {
        if (Auth::check() && Auth::user()->role === $role) {
            return $next($request);
        }

        return redirect('/'); // Redirect ke halaman utama jika peran tidak sesuai
    }
}