<?php

namespace MT\Modules;

/**
 * Category Controller
 */
class CategoryController extends Controller
{
    /**
     * Get all categories
     */
    public function index()
    {
        return $this->json([
            'categories' => [
                [
                    'id' => 1,
                    'name' => 'Technology',
                    'slug' => 'technology',
                    'description' => 'Tech related posts',
                ]
            ]
        ]);
    }
    
    /**
     * Create new category
     */
    public function store($params)
    {
        return $this->success('Category created successfully');
    }
    
    /**
     * Show single category
     */
    public function show($params)
    {
        return $this->json([
            'id' => $params['id'],
            'name' => 'Category Name',
            'slug' => 'category-slug',
        ]);
    }
    
    /**
     * Update category
     */
    public function update($params)
    {
        return $this->success('Category updated successfully');
    }
    
    /**
     * Delete category
     */
    public function destroy($params)
    {
        return $this->success('Category deleted successfully');
    }
}
