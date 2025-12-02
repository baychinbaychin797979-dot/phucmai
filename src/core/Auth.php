<?php

namespace MT\Core;

/**
 * Authentication Handler
 */
class Auth
{
    protected $db;
    protected $currentUser = null;
    
    public function __construct(Database $db)
    {
        $this->db = $db;
    }
    
    /**
     * Authenticate user
     */
    public function authenticate($username, $password)
    {
        $user = $this->db->queryOne(
            "SELECT * FROM users WHERE username = ? OR email = ?",
            [$username, $username]
        );
        
        if (!$user) {
            return false;
        }
        
        if (!password_verify($password, $user['password'])) {
            return false;
        }
        
        $this->currentUser = $user;
        return $user;
    }
    
    /**
     * Register new user
     */
    public function register($data)
    {
        // Validate email
        if ($this->db->queryOne("SELECT id FROM users WHERE email = ?", [$data['email']])) {
            throw new \Exception('Email already registered');
        }
        
        $data['password'] = password_hash($data['password'], PASSWORD_BCRYPT);
        $data['created_at'] = date('Y-m-d H:i:s');
        
        return $this->db->insert('users', $data);
    }
    
    /**
     * Get current user
     */
    public function getCurrentUser()
    {
        return $this->currentUser;
    }
    
    /**
     * Check if user is authenticated
     */
    public function isAuthenticated()
    {
        return $this->currentUser !== null;
    }
    
    /**
     * Logout user
     */
    public function logout()
    {
        $this->currentUser = null;
    }
}
