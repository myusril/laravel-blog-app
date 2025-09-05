<?php

namespace App\Http\Controllers\Auth;

use Carbon\Carbon;
use App\Models\User;
use App\Http\Controllers\Controller;

class VerificationController extends Controller
{
    public function actionVerify(string $token)
    {
        $user = User::where('verification_token', $token)->first();

        if (!$user) {
            abort(404, 'Token tidak valid');
        }

        if ($user->email_verified_at) {
            return redirect('/login')->with('info', 'Akun sudah diverifikasi.');
        }

        $user->update([
            'email_verified_at' => Carbon::now(),
            'verification_token' => null,
        ]);

        return redirect('/login')->with('success', 'Your account has been successfully verified.');
    }
}
