<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    function login()
    {
        setcookie("visit_cookie", "login_page_visited", time()+(60*60*24));
        return view('auth/login');
    }

    function signup()
    {
        return view('auth/signup');
    }

    function register_acc(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required'
        ]);

        $user = new User;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $save = $user->save();

        if ($save) {
            return back()->with('success', 'Sign up successful. <a href="' . route('login') . '">Login</a> now');
        } else {
            return back()->with('fail', 'Something went wrong, try again later');
        }
    }

    function check_acc(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $userInfo = User::where('email', '=', $request->email)->first();

        if (!$userInfo) {
            return back()->with('fail', 'Incorrect email address or password. Please try again.');
        } else {
            if (Hash::check($request->password, $userInfo->password)) {
                $request->session()->put('LoggedUser', $userInfo->id);
                return redirect(route('home'));
            } else {
                return back()->with('fail', 'Incorrect email address or password. Please try again.');
            }
        }
    }

    function logout(Request $request) {
        if(session()->has('LoggedUser')) {
            session()->pull('LoggedUser');
            return redirect(route('login'));
        }
    }
}
