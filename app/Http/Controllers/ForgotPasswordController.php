<?php

namespace App\Http\Controllers;

use DB;
use Mail;

use Illuminate\Support\Str; 
use Illuminate\Http\Request;

class ForgotPasswordController extends Controller
{
    public function index()
    {
        return view('auth.passwords.email');
    }

    public function postEmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email|exists:users',
        ]);

        $token = Str::random(64);

        DB::table('password_resets')->insert(
            ['email' => $request->email, 'token' => $token]
        );

        Mail::send('auth.passwords.confirm', ['token' => $token], function($message) use($request){
            $message->to($request->email);
            $message->subject('Reset Password Notification');
        });
    

        return back()->with('msg', 'A reset link has been sent to your mail.');
    }
}
