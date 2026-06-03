<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function register(Request $request): JsonResponse
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');
        $passwordConfirmation = $request->input('password_confirmation');

        $errors = [];

        if (empty($name) || strlen($name) > 255) {
            $errors['name'] = ['The name field is required and must be less than 255 characters.'];
        }

        if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = ['The email field must be a valid email address.'];
        }

        if (empty($password) || strlen($password) < 8) {
            $errors['password'] = ['The password must be at least 8 characters.'];
        }

        if ($password !== $passwordConfirmation) {
            $errors['password_confirmation'] = ['The password confirmation does not match.'];
        }

        if (!empty($errors)) {
            return response()->json(['errors' => $errors], 422);
        }

        $existingUser = User::where('email', $email)->first();
        if ($existingUser) {
            return response()->json(['errors' => ['email' => ['The email has already been taken.']]], 422);
        }

        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);

        $token = JWTAuth::fromUser($user);

        $ttl = config('jwt.ttl');
        $expiresIn = is_numeric($ttl) ? ($ttl * 60) : 3600;

        return response()->json([
            'message' => 'User registered successfully',
            'user' => $user,
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $expiresIn,
        ], 201);
    }

    public function login(Request $request): JsonResponse
    {
        $email = $request->input('email');
        $password = $request->input('password');

        if (empty($email) || empty($password)) {
            return response()->json(['errors' => ['general' => ['Email and password are required.']]], 422);
        }

        $credentials = ['email' => $email, 'password' => $password];

        if (!$token = JWTAuth::attempt($credentials)) {
            return response()->json(['error' => 'Invalid credentials'], 401);
        }

        $ttl = config('jwt.ttl');
        $expiresIn = is_numeric($ttl) ? ($ttl * 60) : 3600;

        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $expiresIn,
        ]);
    }

    public function refresh(): JsonResponse
    {
        $token = JWTAuth::refresh();
        $ttl = config('jwt.ttl');
        $expiresIn = is_numeric($ttl) ? ($ttl * 60) : 3600;
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $expiresIn,
        ]);
    }

    public function logout(): JsonResponse
    {
        JWTAuth::invalidate(JWTAuth::getToken());
        return response()->json(['message' => 'Successfully logged out']);
    }

    public function me(): JsonResponse
    {
        return response()->json(JWTAuth::user());
    }
}