<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Hash, DB, Str;
// use App\Models\Admin;

class AdminLoginController extends Controller
{
    public function index()
    {
        return view('pages.dashboard');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email'     => 'required|email|exists:users',
            'password'  => 'required',
        ]);

        try {
            $creadential = [
                'email' => $request->email,
                'password' => $request->password,
            ];
            // dd($creadential);
            if (Auth::attempt($creadential, $request->get('remember'))) {
                return redirect('admin/dashboard');
            }
            // if unsuccessful, then redirect back to the login with the form data
            return redirect()->back()
                ->with('error', 'Wrong Credentials or you are deactivated !')
                ->withInput($request->only('email', 'remember'));
        } catch (\Throwable $th) {
            return $th->getMessage();
        }
    }

    public function getUser()
    {
        try {
            if (Auth::check()) {
                return Auth::user();
            }
            return "No User Found";
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    public function logout()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect('login');
        }
        return "No User Found";
    }

    public function getForgotPassword()
    {
        if (Auth::check()) {
            Auth::logout();
            return redirect('login');
        }
        return "No User Found";
    }

    public function enterPassword(Request $request)
    {
        return view('admin.enter_password');
    }



    public function reset_password(Request $request)
    {
        $request->validate([
            'token'    => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);
        // return $request->all();
        try {
            DB::beginTransaction();
            $userToken = \DB::table('password_reset_tokens')->where('token', $request->token)->first();

            if (!$userToken) {
                return back()->with('error', 'Invalid Token');
            }

            $admin           = User::where('email', $userToken->email)->first();

            // return $admin;
            $admin->password = Hash::make($request->password);
            $admin->update();

            \DB::table('password_reset_tokens')->where('token', $request->token)->delete();

            DB::commit();
            return redirect('login')->with('success', 'Please login with your new password');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong');
        }
    }

    public function store(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'token'    => 'required',
            'new_password' => 'required|min:6|confirmed',
        ]);
        // return $request->all();
        try {
            DB::beginTransaction();
            $userToken = \DB::table('password_reset_tokens')->where('token', $request->token)->first();

            if (!$userToken) {
                return back()->with('error', 'Invalid Token');
            }

            $admin           = User::where('email', $request->email)->first();
            $admin->password = Hash::make($request->password);
            $admin->update();

            \DB::table('password_reset_tokens')->where('token', $request->token)->delete();

            DB::commit();
            return redirect('login')->with('success', 'Please login with your new password');
        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong');
        }
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        if (!Hash::check($request->old_password, Auth::user()->password)) {
            return back()->with("error", "Old Password Doesn't match!");
        }

        Admin::whereId(Auth::user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password changed successfully!");
    }
}
