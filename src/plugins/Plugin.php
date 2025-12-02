<?php

namespace MT\Plugins;

/**
 * Base Plugin Class
 */
abstract class Plugin implements PluginInterface
{
    protected $name;
    protected $version;
    protected $author;
    protected $description;
    protected $enabled = false;
    
    abstract public function activate();
    abstract public function deactivate();
    
    /**
     * Get plugin information
     */
    public function getInfo()
    {
        return [
            'name' => $this->name,
            'version' => $this->version,
            'author' => $this->author,
            'description' => $this->description,
            'enabled' => $this->enabled,
        ];
    }
    
    /**
     * Register hook
     */
    public function registerHook($hook, $callback, $priority = 10)
    {
        // Hook registration logic
    }
    
    /**
     * Register widget
     */
    public function registerWidget($name, $widget)
    {
        // Widget registration logic
    }
    
    /**
     * Add settings page
     */
    public function addSettingsPage($page)
    {
        // Settings page registration logic
    }
}
