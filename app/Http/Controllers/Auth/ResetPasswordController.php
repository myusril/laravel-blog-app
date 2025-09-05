<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ResetPasswordController extends Controller
{
    public function showResetPasswordForm(String $token)
    {
        $user = User::where('remember_token', '=', $token)->first();

        if (!empty($user)) {
            $data['user'] = $user;
            $data['title'] = 'Reset Password';

            return view('auth.reset-password', $data);
        } else {
            abort(404);
        }
    }

    public function actionResetPassword(Request $request, String $token)
    {
        request()->validate([
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
            'password_confirmation' => [
                'required',
                'same:password',
            ],
        ]);

        $user = User::where('remember_token', '=', $token)->first();

        if (!empty($user)) {
            $user->password = Hash::make($request->password);

            if (empty($user->email_verified_at)) {
                $user->email_verified_at = date('Y-m-d H:i:s');
            }

            $user->remember_token = Str::random(40);
            $user->save();

            return redirect('/login')->with('success', 'Your password successfully reset.');
        } else {
            abort(404);
        }
    }
}
