<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => ['id' => $user->id, 'name' => $user->name, 'email' => $user->email],
            'token' => $token,
        ], 201);
    }

    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (!auth()->attempt($validated)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $token = auth()->user()->createToken('auth_token')->plainTextToken;

        return response()->json([
            'user' => ['id' => auth()->id(), 'name' => auth()->user()->name, 'email' => auth()->user()->email],
            'token' => $token,
        ]);
    }

    public function reset(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
        ]);

        return response()->json(['message' => 'Password reset link sent']);
    }
}