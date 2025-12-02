<?php

namespace MT\Modules;

/**
 * User Controller
 */
class UserController extends Controller
{
    /**
     * Show user profile
     */
    public function show($params)
    {
        return $this->json([
            'id' => $params['id'],
            'username' => 'username',
            'email' => 'user@example.com',
            'display_name' => 'User Name',
            'bio' => 'User biography',
            'avatar' => 'https://example.com/avatar.jpg',
        ]);
    }
    
    /**
     * Update user profile
     */
    public function update($params)
    {
        return $this->success('User updated successfully');
    }
}
