<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class StaffForgotPasswordController extends Controller
{
    public function show()
    {
        return view('auth.forgot-password-staff');
    }

    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $status = Password::sendResetLink($request->only('email'));

        if ($status === Password::RESET_LINK_SENT) {
            return back()->with('sent', true);
        }

        return back()->withErrors(['email' => __($status)]);
    }
}
