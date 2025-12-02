<?php

namespace MT\Modules;

/**
 * Tag Controller
 */
class TagController extends Controller
{
    /**
     * Get all tags
     */
    public function index()
    {
        return $this->json([
            'tags' => [
                [
                    'id' => 1,
                    'name' => 'PHP',
                    'slug' => 'php',
                ]
            ]
        ]);
    }
    
    /**
     * Create new tag
     */
    public function store($params)
    {
        return $this->success('Tag created successfully');
    }
    
    /**
     * Delete tag
     */
    public function destroy($params)
    {
        return $this->success('Tag deleted successfully');
    }
}
