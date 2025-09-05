<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LogoutController extends Controller
{
    public function actionLogout(Request $request)
    {

        // Logout user saat ini
        Auth::logout();

        // Hapus session lama agar tidak bisa digunakan kembali
        $request->session()->invalidate();

        // Generate token CSRF baru untuk keamanan
        $request->session()->regenerateToken();

        // Redirect ke halaman login atau homepage
        return redirect('/login');
    }
}
