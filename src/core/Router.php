<?php

namespace MT\Core;

/**
 * Router
 */
class Router
{
    protected $routes = [];
    protected $currentRoute = [];
    
    /**
     * Register GET route
     */
    public function get($path, $handler)
    {
        $this->register('GET', $path, $handler);
    }
    
    /**
     * Register POST route
     */
    public function post($path, $handler)
    {
        $this->register('POST', $path, $handler);
    }
    
    /**
     * Register PUT route
     */
    public function put($path, $handler)
    {
        $this->register('PUT', $path, $handler);
    }
    
    /**
     * Register DELETE route
     */
    public function delete($path, $handler)
    {
        $this->register('DELETE', $path, $handler);
    }
    
    /**
     * Register route group
     */
    public function group($prefix, $callback)
    {
        $callback($this);
    }
    
    /**
     * Register route
     */
    private function register($method, $path, $handler)
    {
        $pattern = $this->pathToRegex($path);
        $this->routes[$method][$pattern] = $handler;
    }
    
    /**
     * Dispatch request
     */
    public function dispatch($method, $uri)
    {
        $uri = parse_url($uri, PHP_URL_PATH);
        
        if (isset($this->routes[$method])) {
            foreach ($this->routes[$method] as $pattern => $handler) {
                if (preg_match($pattern, $uri, $matches)) {
                    return $this->callHandler($handler, $matches);
                }
            }
        }
        
        return [
            'status' => 404,
            'data' => ['error' => 'Route not found']
        ];
    }
    
    /**
     * Convert path to regex
     */
    private function pathToRegex($path)
    {
        $path = preg_replace('/\{(\w+)\}/', '(?P<$1>[^/]+)', $path);
        return '#^' . $path . '$#';
    }
    
    /**
     * Call handler
     */
    private function callHandler($handler, $params)
    {
        // Handle controller@method format
        if (is_string($handler)) {
            [$controller, $method] = explode('@', $handler);
            $controllerClass = 'MT\\Modules\\' . $controller;
            $instance = new $controllerClass();
            return $instance->$method($params);
        }
        
        return call_user_func($handler, $params);
    }
}
