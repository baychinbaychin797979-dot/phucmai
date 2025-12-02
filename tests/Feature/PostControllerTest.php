<?php

namespace Tests\Feature;

use Tests\TestCase;
use MT\Modules\PostController;

/**
 * Post API Test
 */
class PostControllerTest extends TestCase
{
    /**
     * Test get all posts
     */
    public function testGetAllPosts()
    {
        $controller = new PostController();
        $result = $controller->index();
        $this->assertTrue(isset($result['data']['posts']));
    }
    
    /**
     * Test create post
     */
    public function testCreatePost()
    {
        $controller = new PostController();
        $result = $controller->store([]);
        $this->assertTrue(isset($result['data']['message']));
    }
}
