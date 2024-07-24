<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthenticateController extends Controller
{
    ////Login
    public function login()
    {
        return view('auth.login');
    }

    public function loginUser(Request $request)
    {
        $request->validate([
            'email' => 'required|email:users',
            'password' => 'required|min:6',
        ]);

        $user = User::where('email', '=', $request->email)->where('is_deleted', '=', 0)->first();

        // return $user;

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                // storing logged in user data into session variables
                $request->session()->put('loginId', $user->id);
                $request->session()->put('name', $user->name);
                $request->session()->put('designation', $user->designation);
                $request->session()->put('role', $user->role);
                $request->session()->put('photo_url', $user->photo_url);

                return redirect('dashboard')->with('success', 'লগইন সফল হয়েছে।');
            } else {
                return back()->with('fail', 'পাসওয়ার্ড সঠিক নয়!');
            }
        } else {
            return back()->with('fail', 'ইমেইলটি নিবন্ধিত নয়!');
        }
    }

    //// Dashboard
    public function dashboard()
    {
        return view('index');
    }

    ///Logout
    public function logout()
    {
        $data = [];
        if (Session::has('loginId')) {
            Session::pull('loginId');

            return redirect('login')->with('success', 'সফলভাবে লগআউট হয়েছেন।');
        } else {
            return redirect('login');
        }
    }
}
