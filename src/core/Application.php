<?php

namespace MT\Core;

/**
 * Application Core Class
 */
class Application
{
    protected $services = [];
    protected $config = [];
    protected $router;
    protected $container;
    
    public function __construct()
    {
        $this->config = require CONFIG_PATH . '/app.php';
        $this->container = new Container();
    }
    
    /**
     * Register services
     */
    public function registerServices()
    {
        // Register database service
        $this->container->register('db', function () {
            return new Database($this->config['database']);
        });
        
        // Register authentication service
        $this->container->register('auth', function () {
            return new Auth($this->container->resolve('db'));
        });
        
        // Register cache service
        $this->container->register('cache', function () {
            return new Cache($this->config['cache']);
        });
        
        // Register logger service
        $this->container->register('log', function () {
            return new Logger($this->config['logging']);
        });
        
        // Register router service
        $this->container->register('router', function () {
            return new Router();
        });
    }
    
    /**
     * Get service from container
     */
    public function getService($name)
    {
        return $this->container->resolve($name);
    }
    
    /**
     * Run application
     */
    public function run()
    {
        try {
            // Route the request
            $router = $this->container->resolve('router');
            $response = $router->dispatch($_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']);
            
            // Send response
            http_response_code($response['status']);
            echo json_encode($response['data']);
        } catch (\Exception $e) {
            // Handle errors
            http_response_code(500);
            echo json_encode([
                'error' => 'Internal Server Error',
                'message' => $e->getMessage()
            ]);
        }
    }
}
