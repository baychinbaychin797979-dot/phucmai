<?php

namespace MT\Console;

/**
 * Console Application
 */
class Console
{
    protected $commands = [];
    protected $config = [];
    
    public function bootstrap()
    {
        // Load console configuration
        $this->config = require CONFIG_PATH . '/console.php';
    }
    
    public function run($argv)
    {
        if (count($argv) < 2) {
            $this->showHelp();
            return;
        }
        
        $command = $argv[1];
        
        if ($command === 'help') {
            $this->showHelp();
            return;
        }
        
        // Find and execute command
        foreach ($this->config['commands'] as $cmd) {
            if ($cmd['name'] === $command) {
                $class = $cmd['class'];
                $instance = new $class();
                $instance->execute(array_slice($argv, 2));
                return;
            }
        }
        
        echo "Command not found: {$command}\n";
        $this->showHelp();
    }
    
    public function showHelp()
    {
        echo "\nMovable Type Framework Console\n";
        echo "==============================\n\n";
        
        echo "Available commands:\n\n";
        
        foreach ($this->config['commands'] as $cmd) {
            printf("  %-20s %s\n", $cmd['name'], $cmd['description']);
        }
        
        echo "\n";
    }
}
