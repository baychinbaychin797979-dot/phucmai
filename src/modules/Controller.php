<?php

namespace MT\Modules;

/**
 * Base Controller
 */
class Controller
{
    protected $db;
    protected $auth;
    protected $cache;
    protected $log;
    
    public function __construct()
    {
        // Services will be injected
    }
    
    /**
     * Render JSON response
     */
    protected function json($data, $status = 200)
    {
        return [
            'status' => $status,
            'data' => $data
        ];
    }
    
    /**
     * Render error response
     */
    protected function error($message, $status = 400)
    {
        return $this->json(['error' => $message], $status);
    }
    
    /**
     * Render success response
     */
    protected function success($message, $data = [])
    {
        return $this->json(array_merge(['message' => $message], $data), 200);
    }
}
