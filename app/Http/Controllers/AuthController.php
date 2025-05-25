<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
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
                
                // Handle redirect parameter if exists
                if ($request->has('redirect')) {
                    return redirect($request->redirect);
                }
                
                // Default redirect based on role
                if (Auth::user()->role === 'admin') {
                    return redirect('/dashboard');
                } else if (Auth::user()->role === 'creator') {
                    return redirect('/dashboard/campaigns');
                } else {
                    return redirect()->intended('/');
                }
            }

            return back()->with('failed', 'Your email or password are incorrect!');
        } else {
            $credentials['username'] = $credentials['usernameOrEmail'];

            unset($credentials['usernameOrEmail']);

            if(Auth::attempt($credentials))
            {
                $request->session()->regenerate();
                
                // Handle redirect parameter if exists
                if ($request->has('redirect')) {
                    return redirect($request->redirect);
                }
                
                // Default redirect based on role
                if (Auth::user()->role === 'admin') {
                    return redirect('/dashboard');
                } else if (Auth::user()->role === 'creator') {
                    return redirect('/dashboard/campaigns');
                } else {
                    return redirect()->intended('/');
                }
            }

            return back()->with('failed', 'Your username or password are incorrect!');
        }

    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
    
    /**
     * Show registration form
     */
    public function register()
    {
        return view('register');
    }
    
    /**
     * Store a new user
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|max:30|unique:users|alpha_dash',
            'password' => 'required|string|min:8|confirmed',
        ]);
        
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'username' => $validated['username'],
            'password' => Hash::make($validated['password']),
            'role' => 'donor', // Set default role to donor
        ]);
        
        Auth::login($user);
        
        // Handle redirect parameter if exists
        if ($request->has('redirect')) {
            return redirect($request->redirect)->with('success', 'Akun berhasil dibuat dan Anda telah masuk.');
        }
        
        // Default redirect based on role
        if ($user->role === 'donor') {
            return redirect('/')->with('success', 'Akun berhasil dibuat dan Anda telah masuk.');
        } else {
            return redirect('/dashboard')->with('success', 'Akun berhasil dibuat dan Anda telah masuk.');
        }
    }
}
