<?php

namespace App\Http\Controllers\dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{

    public function index()
    {
        return view('dashboard.user.index', [
            'users' => User::all(),
            'userPage' => true,
        ]);
    }

    public function create()
    {
        return view('dashboard.user.create', [
            'userPage' => true,
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:5|max:30|unique:users',
            'username' => 'required|min:3|max:20|unique:users',
            'email' => 'required|unique:users',
            'password' => 'required|min:4|same:password_confirmation',
            'password_confirmation' => 'required|min:4|same:password',
            'image' => 'file|image|max:2048',
        ]);

        $validatedData['role'] = 'admin';

        $validatedData['password'] = Hash::make($request->password);

        $validatedData['slug'] = Str::of($request->name)->slug('-');

        if($request->image){
            $validatedData['image'] = $request->file('image')->store('/uploads/users');
        }

        User::create($validatedData);

        return redirect('/dashboard/users')->with('success', 'New user created successfully!');

    }

    public function show(User $user)
    {
        return view('dashboard.user.show', [
            'users' => $user
        ]);
    }

    public function edit(User $user)
    {
        // return view('dashboard.user.edit');
    }

    public function update(Request $request, User $user)
    {
        //
    }

    public function destroy(User $user)
    {
        if($user->image){
            Storage::delete($user->image);
        }

        User::destroy($user->id);

        return redirect('/dashboard/users')->with('success', 'User deleted successfully!');
    }
}
