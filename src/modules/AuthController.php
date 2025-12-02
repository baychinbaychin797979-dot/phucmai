<?php

namespace MT\Modules;

/**
 * Authentication Controller
 */
class AuthController extends Controller
{
    /**
     * User login
     */
    public function login()
    {
        return $this->json([
            'token' => 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9...',
            'user' => [
                'id' => 1,
                'username' => 'admin',
                'email' => 'admin@example.com',
            ]
        ]);
    }
    
    /**
     * User registration
     */
    public function register()
    {
        return $this->success('User registered successfully', [
            'user' => [
                'id' => 1,
                'username' => 'newuser',
                'email' => 'user@example.com',
            ]
        ]);
    }
    
    /**
     * User logout
     */
    public function logout()
    {
        return $this->success('Logged out successfully');
    }
}
