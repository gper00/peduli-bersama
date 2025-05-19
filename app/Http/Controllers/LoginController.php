<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $credentials = $request->validate([
            'usernameOrEmail' => 'required',
            'password' => 'required'
        ]);

        if(Str::contains($credentials['usernameOrEmail'], '@')){
            $credentials['email'] = $credentials['usernameOrEmail'];

            unset($credentials['usernameOrEmail']);

            if(Auth::attempt($credentials))
            {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
            }

            return back()->with('failed', 'Your email or password are incorrcect!');
        } else {
            $credentials['username'] = $credentials['usernameOrEmail'];

            unset($credentials['usernameOrEmail']);

            if(Auth::attempt($credentials))
            {
                $request->session()->regenerate();
                return redirect()->intended('/dashboard');
            }

            return back()->with('failed', 'Your username or password are incorrcect!');
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
