<?php

namespace MT\Plugins;

/**
 * Plugin Manager
 */
class PluginManager
{
    protected $plugins = [];
    
    /**
     * Load plugins
     */
    public function load()
    {
        $pluginDir = SRC_PATH . '/plugins';
        
        if (!is_dir($pluginDir)) {
            return;
        }
        
        foreach (glob($pluginDir . '/*') as $file) {
            if (is_file($file) && pathinfo($file, PATHINFO_EXTENSION) === 'php') {
                require_once $file;
            }
        }
    }
    
    /**
     * Register plugin
     */
    public function register($name, $plugin)
    {
        $this->plugins[$name] = $plugin;
    }
    
    /**
     * Activate plugin
     */
    public function activate($name)
    {
        if (isset($this->plugins[$name])) {
            $this->plugins[$name]->activate();
        }
    }
    
    /**
     * Deactivate plugin
     */
    public function deactivate($name)
    {
        if (isset($this->plugins[$name])) {
            $this->plugins[$name]->deactivate();
        }
    }
    
    /**
     * Get all plugins
     */
    public function getAll()
    {
        return $this->plugins;
    }
}
