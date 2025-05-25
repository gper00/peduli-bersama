<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    /**
     * Display the user's profile.
     */
    public function index()
    {
        $user = Auth::user();
        return view('dashboard.profile.index', compact('user'));
    }

    /**
     * Show the form for editing the user's profile.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('dashboard.profile.edit', compact('user'));
    }

    /**
     * Update the user's profile.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        
        $rules = [
            'name' => 'required|string|max:255',
            'username' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone_number' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'bio' => 'nullable|string',
            'address' => 'nullable|string',
            'facebook_url' => 'nullable|string|url',
            'twitter_url' => 'nullable|string|url',
            'instagram_url' => 'nullable|string|url',
        ];

        // Only validate password if it's provided
        if ($request->filled('password')) {
            $rules['password'] = 'string|min:8|confirmed';
        }

        $request->validate($rules);

        $userData = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'bio' => $request->bio,
            'address' => $request->address,
            'facebook_url' => $request->facebook_url,
            'twitter_url' => $request->twitter_url,
            'instagram_url' => $request->instagram_url,
        ];

        // Update password only if provided
        if ($request->filled('password')) {
            $userData['password'] = Hash::make($request->password);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($user->image) {
                Storage::disk('public')->delete($user->image);
            }

            $imagePath = $request->file('image')->store('users', 'public');
            $userData['image'] = $imagePath;
        }

        $user->update($userData);

        return redirect()->route('dashboard.profile.index')
            ->with('success', 'Profile updated successfully');
    }
}
