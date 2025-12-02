<?php

namespace MT\Modules;

/**
 * Post Controller
 */
class PostController extends Controller
{
    /**
     * Get all posts
     */
    public function index()
    {
        return $this->json([
            'posts' => [
                [
                    'id' => 1,
                    'title' => 'First Post',
                    'slug' => 'first-post',
                    'content' => 'This is the first post content',
                    'author_id' => 1,
                    'category_id' => 1,
                    'status' => 'published',
                    'created_at' => '2025-01-01 00:00:00',
                ]
            ]
        ]);
    }
    
    /**
     * Create new post
     */
    public function store($params)
    {
        return $this->success('Post created successfully');
    }
    
    /**
     * Show single post
     */
    public function show($params)
    {
        return $this->json([
            'id' => $params['id'],
            'title' => 'Post Title',
            'slug' => 'post-slug',
            'content' => 'Post content here',
        ]);
    }
    
    /**
     * Update post
     */
    public function update($params)
    {
        return $this->success('Post updated successfully');
    }
    
    /**
     * Delete post
     */
    public function destroy($params)
    {
        return $this->success('Post deleted successfully');
    }
}
