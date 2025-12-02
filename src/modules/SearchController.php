<?php

namespace MT\Modules;

/**
 * Search Controller
 */
class SearchController extends Controller
{
    /**
     * Search posts
     */
    public function index()
    {
        $query = $_GET['q'] ?? '';
        
        return $this->json([
            'query' => $query,
            'results' => [
                [
                    'id' => 1,
                    'title' => 'Search Result Title',
                    'excerpt' => 'Result excerpt matching the search query',
                    'url' => '/blog/search-result-title',
                ]
            ],
            'total' => 1,
        ]);
    }
}
