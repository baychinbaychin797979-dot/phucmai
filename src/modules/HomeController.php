<?php

namespace MT\Modules;

/**
 * Home Controller
 */
class HomeController extends Controller
{
    /**
     * Show homepage
     */
    public function index()
    {
        return $this->json([
            'title' => 'Welcome to Movable Type',
            'description' => 'A modern blogging and content management platform',
            'featured_posts' => [
                [
                    'id' => 1,
                    'title' => 'Featured Post',
                    'excerpt' => 'This is a featured post excerpt',
                ]
            ]
        ]);
    }
}
