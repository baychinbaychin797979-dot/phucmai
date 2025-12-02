<?php
/**
 * Routes Configuration
 */

// API Routes
$app->group('/api', function ($group) {
    // Blog Routes
    $group->get('/posts', 'PostController@index');
    $group->post('/posts', 'PostController@store');
    $group->get('/posts/{id}', 'PostController@show');
    $group->put('/posts/{id}', 'PostController@update');
    $group->delete('/posts/{id}', 'PostController@destroy');
    
    // Category Routes
    $group->get('/categories', 'CategoryController@index');
    $group->post('/categories', 'CategoryController@store');
    $group->get('/categories/{id}', 'CategoryController@show');
    $group->put('/categories/{id}', 'CategoryController@update');
    $group->delete('/categories/{id}', 'CategoryController@destroy');
    
    // Tag Routes
    $group->get('/tags', 'TagController@index');
    $group->post('/tags', 'TagController@store');
    $group->delete('/tags/{id}', 'TagController@destroy');
    
    // User Routes
    $group->post('/auth/login', 'AuthController@login');
    $group->post('/auth/register', 'AuthController@register');
    $group->post('/auth/logout', 'AuthController@logout');
    $group->get('/users/{id}', 'UserController@show');
    $group->put('/users/{id}', 'UserController@update');
});

// Web Routes
$app->get('/', 'HomeController@index');
$app->get('/blog', 'BlogController@index');
$app->get('/blog/{slug}', 'BlogController@show');
$app->get('/category/{slug}', 'BlogController@category');
$app->get('/tag/{slug}', 'BlogController@tag');
$app->get('/search', 'SearchController@index');
