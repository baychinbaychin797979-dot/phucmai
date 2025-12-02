<?php

namespace MT\Core;

/**
 * Logger Handler
 */
class Logger
{
    protected $config;
    protected $channel;
    
    public function __construct($config)
    {
        $this->config = $config;
        $this->channel = $config['default'] ?? 'single';
    }
    
    /**
     * Log message
     */
    public function log($level, $message, $context = [])
    {
        $path = $this->config['channels'][$this->channel]['path'];
        $dir = dirname($path);
        
        if (!is_dir($dir)) {
            mkdir($dir, 0755, true);
        }
        
        $timestamp = date('Y-m-d H:i:s');
        $contextStr = !empty($context) ? json_encode($context) : '';
        $logMessage = "[{$timestamp}] [{$level}] {$message} {$contextStr}\n";
        
        file_put_contents($path, $logMessage, FILE_APPEND);
    }
    
    /**
     * Log info
     */
    public function info($message, $context = [])
    {
        $this->log('INFO', $message, $context);
    }
    
    /**
     * Log error
     */
    public function error($message, $context = [])
    {
        $this->log('ERROR', $message, $context);
    }
    
    /**
     * Log debug
     */
    public function debug($message, $context = [])
    {
        $this->log('DEBUG', $message, $context);
    }
    
    /**
     * Log warning
     */
    public function warning($message, $context = [])
    {
        $this->log('WARNING', $message, $context);
    }
}
