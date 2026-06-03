<?php

namespace Tests\Feature;

use App\Models\User;
use Tests\TestCase;

describe('Auth API - Lumen', function () {
    beforeEach(fn() => \DB::table('lumen_users')->truncate());

    it('registers a new user', function () {
        $response = $this->post('/api/v1/auth/register', [
            'name' => 'Lumen Test',
            'email' => 'lumen@test.com',
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
            'name' => 'Lumen Test',
            'email' => 'lumen@test.com',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/api/v1/auth/login', [
            'email' => 'lumen@test.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200)
            ->assertJsonStructure(['token', 'token_type', 'expires_in']);
    });

    it('rejects invalid credentials', function () {
        $response = $this->post('/api/v1/auth/login', [
            'email' => 'nonexistent@test.com',
            'password' => 'wrongpassword',
        ]);

        $response->assertStatus(401)
            ->assertJson(['error' => 'Invalid credentials']);
    });

    it('gets user info with valid token', function () {
        User::create([
            'name' => 'Lumen Test',
            'email' => 'lumen@test.com',
            'password' => bcrypt('password123'),
        ]);

        $token = $this->post('/api/v1/auth/login', [
            'email' => 'lumen@test.com',
            'password' => 'password123',
        ])->json('token');

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token"
        ])->get('/api/v1/auth/me');

        $response->assertStatus(200)
            ->assertJson(['email' => 'lumen@test.com']);
    });

    it('rejects protected route without token', function () {
        $this->get('/api/v1/auth/me')->assertStatus(401);
    });

    it('refreshes token', function () {
        User::create([
            'name' => 'Lumen Test',
            'email' => 'lumen@test.com',
            'password' => bcrypt('password123'),
        ]);

        $token = $this->post('/api/v1/auth/login', [
            'email' => 'lumen@test.com',
            'password' => 'password123',
        ])->json('token');

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token"
        ])->post('/api/v1/auth/refresh');

        $response->assertStatus(200)
            ->assertJsonStructure(['token', 'token_type', 'expires_in']);
    });

    it('logs out', function () {
        User::create([
            'name' => 'Lumen Test',
            'email' => 'lumen@test.com',
            'password' => bcrypt('password123'),
        ]);

        $token = $this->post('/api/v1/auth/login', [
            'email' => 'lumen@test.com',
            'password' => 'password123',
        ])->json('token');

        $response = $this->withHeaders([
            'Authorization' => "Bearer $token"
        ])->post('/api/v1/auth/logout');

        $response->assertStatus(200)
            ->assertJson(['message' => 'Successfully logged out']);
    });
});