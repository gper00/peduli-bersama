<?php

namespace App\Http\Controllers\dashboard;


use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the users (Admin only).
     */
    public function index()
    {
        // Only admin can access user management
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $users = User::paginate(10);
        return view('dashboard.user.index', compact('users'));
    }

    /**
     * Show the form for creating a new user (Admin only).
     */
    public function create()
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        // Regular admins can only create creators, super admins can create both admins and creators
        $canCreateAdmin = auth()->user()->isSuperAdmin();

        return view('dashboard.user.create', compact('canCreateAdmin'));
    }

    /**
     * Store a newly created user in storage (Admin only).
     */
    public function store(Request $request)
    {
        // Check if user has admin role
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        // Regular admins can only create creator users, not other admins
        // Super admin can create both admin and creator users
        $allowedRoles = auth()->user()->isSuperAdmin() ? ['admin', 'creator'] : ['creator'];

        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'nullable|string|max:255|unique:users',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => ['required', Rule::in($allowedRoles)],
            'phone_number' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $userData = [
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'phone_number' => $request->phone_number,
        ];

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('users', 'public');
            $userData['image'] = $imagePath;
        }

        User::create($userData);

        return redirect()->route('dashboard.users.index')
            ->with('success', 'User created successfully');
    }

    /**
     * Display the specified user (Admin only).
     */
    public function show(User $user)
    {
        // Only admins can view any user profile through user management
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        return view('dashboard.user.show', compact('user'));
    }

    /**
     * Show the form for editing the specified user (Admin only).
     */
    public function edit(User $user)
    {
        // Only admins can edit users through user management
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        return view('dashboard.user.edit', compact('user'));
    }

    /**
     * Update the specified user in storage (Admin only).
     */
    public function update(Request $request, User $user)
    {
        // Only admins can update users through user management
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        $rules = [
            'name' => 'required|string|max:255',
            'username' => ['nullable', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone_number' => 'nullable|string|max:20',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];

        // Role update permissions:
        // 1. Super admin can change role of any user except themselves
        // 2. Regular admin can only change role of creators, not other admins
        if (auth()->id() !== $user->id) {
            if (auth()->user()->isSuperAdmin()) {
                // Super admin can change role of any other user
                $rules['role'] = 'required|in:admin,donor,creator';
            } else {
                // Regular admin can only change role of creators
                if ($user->role !== 'admin') {
                    $rules['role'] = 'required|in:creator';
                }
            }
        }

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
        ];

        // Apply role update based on permissions
        if (auth()->id() !== $user->id) {
            if (auth()->user()->isSuperAdmin() || ($user->role !== 'admin' && $request->filled('role'))) {
                $userData['role'] = $request->role;
            }
        }

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

        return redirect()->route('dashboard.users.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified user from storage (Admin only).
     */
    public function destroy(User $user)
    {
        if (!auth()->user()->isAdmin()) {
            abort(403, 'Unauthorized access');
        }

        // Prevent admin from deleting their own account
        if (auth()->id() === $user->id) {
            return redirect()->route('dashboard.users.index')
                ->with('error', 'You cannot delete your own account');
        }

        // Regular admins can only delete creators, not other admins
        if (!auth()->user()->isSuperAdmin() && $user->isAdmin()) {
            return redirect()->route('dashboard.users.index')
                ->with('error', 'Regular admins cannot delete other admin accounts');
        }

        // Delete user image if exists
        if ($user->image) {
            Storage::disk('public')->delete($user->image);
        }

        $user->delete();

        return redirect()->route('dashboard.users.index')
            ->with('success', 'User deleted successfully');
    }
}
