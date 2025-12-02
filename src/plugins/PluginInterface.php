<?php

namespace MT\Plugins;

/**
 * Plugin Interface
 */
interface PluginInterface
{
    /**
     * Activate plugin
     */
    public function activate();
    
    /**
     * Deactivate plugin
     */
    public function deactivate();
    
    /**
     * Get plugin info
     */
    public function getInfo();
}
