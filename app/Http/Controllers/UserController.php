<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller
{
    public function index()
    {
        return view('users.index', [
            'users' => User::orderBy('created_at', 'desc')->get(),
            'roles' => Role::all(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validateWithBag('usersDeletion', [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'numeric|starts_with:62',
            'password' => ['required', Password::defaults(), 'confirmed'],
            'role' => 'required|exists:roles,id',
            'address' => 'nullable',
            'gender' => 'required',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $path = Storage::putFile('photos', $request->file('photo'));
        }

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'role_id' => $request->role,
            'gender' => $request->gender,
            'address' => $request->address,
            'photo' => $path ?? null,
        ]);

        return redirect()->route('users')
            ->with('success', 'User created successfully');
    }

    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'roles' => Role::all(),
        ]);
    }

    public function update(Request $request, User $user)
    {
        $request->validateWithBag('usersDeletion', [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'numeric|starts_with:62',
            'password' => ['nullable', Password::defaults(), 'confirmed'],
            'role' => 'required|exists:roles,id',
            'address' => 'nullable',
            'gender' => 'required',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('photo')) {
            $path = Storage::putFile('photos', $request->file('photo'));
        }

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => bcrypt($request->password),
            'role_id' => $request->role,
            'gender' => $request->gender,
            'address' => $request->address,
            'photo' => $path ?? null,
        ]);

        return redirect()->route('users')
            ->with('success', 'User updated successfully');
    }

    public function destroy(User $user)
    {
        if ($user->photo) {
            Storage::delete($user->photo);
        }
        $user->delete();

        return redirect()->route('users');
    }
}
