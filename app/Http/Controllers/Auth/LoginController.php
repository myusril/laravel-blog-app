<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function showLoginForm(Request $request)
    {
        return view('auth.login', [
            'title' => 'Login',
        ]);
    }

    public function actionLogin(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return redirect()->back()->with('error', 'Email or password wrong.');
        }

        if (!$user->email_verified_at) {
            return redirect()->back()->with('error', 'Please verify your email!');
        }

        Auth::login($user);

        $request->session()->regenerate();

        return redirect('/');
    }
}
