<?php
/**
 * Application Configuration
 */

return [
    'app_name' => 'Movable Type Framework',
    'app_version' => '1.0.0',
    'app_url' => 'http://localhost:8000',
    'debug' => true,
    'timezone' => 'UTC',
    
    // Database configuration
    'database' => [
        'driver' => 'mysql',
        'host' => getenv('DB_HOST', 'localhost'),
        'port' => getenv('DB_PORT', 3306),
        'database' => getenv('DB_NAME', 'movabletype'),
        'username' => getenv('DB_USER', 'root'),
        'password' => getenv('DB_PASS', ''),
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
    ],
    
    // Authentication
    'auth' => [
        'guard' => 'web',
        'password_reset_timeout' => 60,
    ],
    
    // Session
    'session' => [
        'driver' => 'file',
        'lifetime' => 120,
        'expire_on_close' => false,
    ],
    
    // Cache
    'cache' => [
        'default' => 'file',
        'stores' => [
            'file' => [
                'driver' => 'file',
                'path' => BASE_PATH . '/storage/cache',
            ],
        ],
    ],
    
    // Logging
    'logging' => [
        'default' => 'stack',
        'channels' => [
            'single' => [
                'driver' => 'single',
                'path' => BASE_PATH . '/storage/logs/app.log',
                'level' => 'debug',
            ],
        ],
    ],
];
