<?php

namespace MT\Modules;

/**
 * Blog Controller
 */
class BlogController extends Controller
{
    /**
     * Show blog posts list
     */
    public function index()
    {
        return $this->json([
            'posts' => [
                [
                    'id' => 1,
                    'title' => 'Blog Post Title',
                    'slug' => 'blog-post-title',
                    'excerpt' => 'This is the post excerpt',
                    'author' => 'Admin',
                    'created_at' => '2025-01-01',
                ]
            ],
            'pagination' => [
                'current_page' => 1,
                'total_pages' => 10,
                'per_page' => 10,
            ]
        ]);
    }
    
    /**
     * Show single blog post
     */
    public function show($params)
    {
        return $this->json([
            'id' => $params['slug'],
            'title' => 'Blog Post Title',
            'slug' => $params['slug'],
            'content' => 'Full blog post content here...',
            'author' => 'Admin',
            'tags' => ['tag1', 'tag2'],
        ]);
    }
    
    /**
     * Show category posts
     */
    public function category($params)
    {
        return $this->json([
            'category' => $params['slug'],
            'posts' => []
        ]);
    }
    
    /**
     * Show tag posts
     */
    public function tag($params)
    {
        return $this->json([
            'tag' => $params['slug'],
            'posts' => []
        ]);
    }
}
