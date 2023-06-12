<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\AppHelper;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index()
    {
        return view("auth.index");
    }

    public function signinPosts(Request $request)
    {
        $request->validate([
            "email" => "required",
            "password" => "required",
            "g-recaptcha-response" => "required",
        ]);
        $captcha = AppHelper::instance()->VerifyRecaptcha(
            $request["g-recaptcha-response"]
        );
        if ($captcha) {
            if (
                Auth::attempt([
                    "email" => $request->email,
                    "password" => $request->password,
                ])
            ) {
                $request->session()->regenerate();
                return redirect()->intended("/ngadmin");
            }
        }
        return back()->with([
            "status" => "error",
            "message" => 'Check your login information", "Login failed',
        ]);
    }
    public function signout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect("/");
    }
}
