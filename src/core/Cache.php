<?php

namespace MT\Core;

/**
 * Caching Handler
 */
class Cache
{
    protected $driver;
    protected $config;
    
    public function __construct($config)
    {
        $this->config = $config;
        $this->driver = $config['default'] ?? 'file';
    }
    
    /**
     * Get cached value
     */
    public function get($key, $default = null)
    {
        $file = $this->getFilePath($key);
        
        if (!file_exists($file)) {
            return $default;
        }
        
        $data = json_decode(file_get_contents($file), true);
        
        if ($data['expires'] && $data['expires'] < time()) {
            unlink($file);
            return $default;
        }
        
        return $data['value'];
    }
    
    /**
     * Set cached value
     */
    public function set($key, $value, $ttl = 3600)
    {
        $path = dirname($this->getFilePath($key));
        
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
        
        $data = [
            'value' => $value,
            'expires' => time() + $ttl,
        ];
        
        file_put_contents($this->getFilePath($key), json_encode($data));
    }
    
    /**
     * Delete cached value
     */
    public function forget($key)
    {
        $file = $this->getFilePath($key);
        if (file_exists($file)) {
            unlink($file);
        }
    }
    
    /**
     * Clear all cache
     */
    public function flush()
    {
        $path = $this->config['stores'][$this->driver]['path'];
        array_map('unlink', glob("{$path}/*"));
    }
    
    /**
     * Get file path for cache key
     */
    private function getFilePath($key)
    {
        $path = $this->config['stores'][$this->driver]['path'];
        return $path . '/' . md5($key) . '.cache';
    }
}
