<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordController extends Controller
{
    public function showResetForm(Request $request)
    {
        $email = session('reset_email');

        if (! $email) {
            return redirect()->route('password.request');
        }

        return view('auth.reset-password', ['email' => $email]);
    }

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return back()->withErrors(['email' => 'Email not found.']);
        }

        $user->forceFill([
            'password' => Hash::make($request->password),
        ])->setRememberToken(Str::random(60));

        $user->save();

        session()->forget('reset_email');

        return redirect()->route('login')->with('status', 'Password changed successfully. Please login.');
    }
}
