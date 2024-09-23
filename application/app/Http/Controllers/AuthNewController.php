<?php

namespace App\Http\Controllers;

use Str;
use Mail;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\PasswordResetTokens;

class AuthNewController extends Controller
{
    public function forgot_password()
    {
        return view('admin.forgot_password');
    }


    public function resetMail(Request $request)
    {
        $request->validate([
            'email'     => 'required|email|exists:users'
        ]);

        $token = Str::random(60);
        $check_email_reset = PasswordResetTokens::where('email', $request->email)->first();
        if ($check_email_reset) {
            $check_email_reset->token = $token;
            $check_email_reset->save();
        } else {
            $check_email_reset = new PasswordResetTokens();
            $check_email_reset->email = $request->email;
            $check_email_reset->token = $token;
            $check_email_reset->save();
        }

        $details = [
            'token' => $token,
            'email' => $request->email,
            'backUri' => url('/')
        ];

        try {
            \Mail::to($request->email)->send(new \App\Mail\ResetPasswordMail($details));
            return back()->with('message', 'Reset Link send to your mail.');
        } catch (\Throwable $e) {
            return back()->with('error', 'Something went wrong. '.$e->getMessage() );
        }
        return $check_email_reset;
    }

    public function resetPassword(Request $request)
    {
        $token_data = PasswordResetTokens::where(['token' => $request->token, 'email' => $request->email])->first();
        if ($token_data) {
            return view('admin.enter_password');
        } else {
            return redirect('/forgot-password')->with('error', 'Link is invalid');
        }
    }


    public function set_password(Request $request)
    {
        $request->validate([
            'email'     => 'required|email|exists:users',
            'new_password'  => 'required|confirmed',
            'token' => 'required'
        ]);

        $token_data = PasswordResetTokens::where('token', $request->token)->first();
        $user = User::where('email', $token_data->email)->first();
        $user->raw_pass = $request->new_password;
        $user->password = bcrypt($request->new_password);
        $user->save();
        $token_data->delete();

        return redirect('/login')->with('message', 'Password Changed Successfully');
    }
}
