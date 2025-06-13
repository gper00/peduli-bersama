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

                // Handle redirect parameter if exists and valid
                if ($request->has('redirect') && $this->isValidRedirect($request->redirect)) {
                    return redirect($request->redirect);
                }

                // Default redirect based on role
                if (Auth::user()->role === 'admin') {
                    return redirect('/dashboard');
                } else if (Auth::user()->role === 'creator') {
                    return redirect('/dashboard/campaigns');
                } else if (Auth::user()->role === 'donor') {
                    return redirect('/');
                } else {
                    return redirect('/');
                }
            }

            return back()->with('failed', 'Your email or password are incorrect!');
        } else {
            $credentials['username'] = $credentials['usernameOrEmail'];
            unset($credentials['usernameOrEmail']);

            if(Auth::attempt($credentials))
            {
                $request->session()->regenerate();

                // Handle redirect parameter if exists and valid
                if ($request->has('redirect') && $this->isValidRedirect($request->redirect)) {
                    return redirect($request->redirect);
                }

                // Default redirect based on role
                if (Auth::user()->role === 'admin') {
                    return redirect('/dashboard');
                } else if (Auth::user()->role === 'creator') {
                    return redirect('/dashboard/campaigns');
                } else if (Auth::user()->role === 'donor') {
                    return redirect('/');
                } else {
                    return redirect('/');
                }
            }

            return back()->with('failed', 'Your username or password are incorrect!');
        }
    }

    /**
     * Validasi agar redirect hanya ke halaman yang valid (bukan endpoint API)
     */
    protected function isValidRedirect($url)
    {
        // Hanya izinkan redirect ke halaman public, campaign, donate, dsb, bukan endpoint API
        $forbidden = [
            '/dashboard/notifications/unread-count',
            '/dashboard/notifications/latest',
            '/dashboard/notifications/read-all',
            '/dashboard/messages/unread-count',
            '/api/',
        ];
        foreach ($forbidden as $forbid) {
            if (str_contains($url, $forbid)) {
                return false;
            }
        }
        // Hanya izinkan redirect ke URL dalam domain aplikasi
        return str_starts_with($url, '/') && !str_starts_with($url, '//');
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

        // Handle redirect parameter if exists and valid
        if ($request->has('redirect') && $this->isValidRedirect($request->redirect)) {
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
