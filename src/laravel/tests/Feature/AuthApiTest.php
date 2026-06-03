<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

uses(RefreshDatabase::class);

describe('Auth API - Laravel', function () {
    beforeEach(fn() => User::truncate());

    it('registers a new user', function () {
        $response = $this->postJson('/api/v1/auth/register', [
            'name' => 'Laravel Test',
            'email' => 'laravel@test.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure([
                'message',
                'user' => ['id', 'name', 'email'],
                'token',
                'token_type',
                'expires_in'
            ]);
    });

    it('logs in existing user', function () {
        User::create([
            'name' => 'Laravel Test',
            'email' => 'laravel@test.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->postJson('/api/v1/auth/login', [
            'email' => 'laravel@test.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['token', 'token_type', 'expires_in']);
    });

    it('rejects invalid credentials', function () {
        $response = $this->postJson('/api/v1/auth/login', [
            'email' => 'nonexistent@test.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401)
            ->assertJson(['error' => 'Invalid credentials']);
    });

    it('gets user info with valid token', function () {
        User::create([
            'name' => 'Laravel Test',
            'email' => 'laravel@test.com',
            'password' => bcrypt('password123'),
        ]);

        $token = $this->postJson('/api/v1/auth/login', [
            'email' => 'laravel@test.com',
            'password' => 'password123',
        ])->json('token');

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token"
        ])->getJson('/api/v1/auth/me');

        $response->assertStatus(200)
            ->assertJson(['email' => 'laravel@test.com']);
    });

    it('rejects protected route without token', function () {
        $this->getJson('/api/v1/auth/me')->assertStatus(401);
    });

    it('refreshes token', function () {
        User::create([
            'name' => 'Laravel Test',
            'email' => 'laravel@test.com',
            'password' => bcrypt('password123'),
        ]);

        $token = $this->postJson('/api/v1/auth/login', [
            'email' => 'laravel@test.com',
            'password' => 'password123',
        ])->json('token');

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token"
        ])->postJson('/api/v1/auth/refresh');

        $response->assertStatus(200)
            ->assertJsonStructure(['token', 'token_type', 'expires_in']);
    });

    it('logs out', function () {
        User::create([
            'name' => 'Laravel Test',
            'email' => 'laravel@test.com',
            'password' => bcrypt('password123'),
        ]);

        $token = $this->postJson('/api/v1/auth/login', [
            'email' => 'laravel@test.com',
            'password' => 'password123',
        ])->json('token');

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token"
        ])->postJson('/api/v1/auth/logout');

        $response->assertStatus(200)
            ->assertJson(['message' => 'Successfully logged out']);
    });
});