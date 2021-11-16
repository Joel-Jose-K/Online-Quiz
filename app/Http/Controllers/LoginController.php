<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login-form');
    }

    public function checkLogin(Request $request)
    {
        $this->validate($request, [
            'email'     => 'required|email',
            'password'  => 'required|min:3'
        ]);

        $user_data = [
            'email'     => $request->get('email'),
            'password'  => $request->get('password')
        ];

        if(Auth::attempt($user_data))
        {
            return redirect('dashboard');
        }
        
        return redirect('login')->with('msg', 'Your credentials do not match!');

    }

    public function successLogin()
    {
      return view('dashboard');
    }

    public function logOut(Request $request) 
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('login');
    }
}
