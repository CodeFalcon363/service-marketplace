<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'role' => 'required|string|in:user,vendor',
        ]);

        $role = Role::where('name', $validatedData['role'])->first();

        $user = User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'role_id' => $role->id,
        ]);

        // Redirect to profile creation
        return redirect()->route('profile.create');
    }

    public function createProfile()
    {
        return view('profile.create');
    }

    public function storeProfile(Request $request)
    {
        $user = auth()->user();

        if ($user->role->name == 'vendor') {
            $validatedData = $request->validate([
                'business_name' => 'required|string|max:255',
                'business_location' => 'required|string|max:255',
                'registration_type' => 'required|string',
                'registration_certificate' => 'required|file|mimes:jpg,png,pdf',
            ]);
            $user->update($validatedData);
        } else {
            $validatedData = $request->validate([
                'address' => 'required|string|max:255',
            ]);
            $user->update($validatedData);
        }

        return redirect()->route('home')->with('success', 'Profile created successfully.');
    }
}
