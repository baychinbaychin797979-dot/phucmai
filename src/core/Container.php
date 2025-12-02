<?php

namespace MT\Core;

/**
 * Service Container
 */
class Container
{
    protected $bindings = [];
    protected $instances = [];
    
    /**
     * Register a binding
     */
    public function register($name, $resolver)
    {
        $this->bindings[$name] = $resolver;
    }
    
    /**
     * Resolve a service
     */
    public function resolve($name)
    {
        if (isset($this->instances[$name])) {
            return $this->instances[$name];
        }
        
        if (!isset($this->bindings[$name])) {
            throw new \Exception("Service '{$name}' not found in container");
        }
        
        $resolver = $this->bindings[$name];
        $instance = $resolver();
        
        $this->instances[$name] = $instance;
        return $instance;
    }
}
