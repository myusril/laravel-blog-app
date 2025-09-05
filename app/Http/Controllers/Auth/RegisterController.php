<?php

namespace App\Http\Controllers\Auth;

use Exception;
use App\Models\User;
use App\Mail\RegisterMail;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Validation\Rules\Password;

class RegisterController extends Controller
{
    public function showRegisterForm(Request $request)
    {
        return view('auth.register', [
            'title' => 'Register',
        ]);
    }

    public function actionRegister(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => [
                'required',
                Password::min(8)
                    ->letters()
                    ->mixedCase()
                    ->numbers()
                    ->symbols(),
            ],
            'password_confirmation' => 'required|same:password',
        ]);

        DB::transaction(function () use ($request) {
            $user = User::create([
                'name' => trim($request->name),
                'email' => trim($request->email),
                'password' => Hash::make($request->password),
                'verification_token' => Str::random(64),
            ]);

            try {
                Mail::to($user->email)->queue(new RegisterMail($user));
            } catch (Exception $e) {
                Log::error('Email gagal dikirim: ' . $e->getMessage());
            }
        });

        return redirect('/login')
            ->with('success', 'Your account registered successfully. Please verify your email.');
    }
}
