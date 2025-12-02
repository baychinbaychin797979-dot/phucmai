<?php
/**
 * Bootstrap - Initialize test environment
 */

define('BASE_PATH', dirname(__DIR__));
define('SRC_PATH', BASE_PATH . '/src');
define('CONFIG_PATH', BASE_PATH . '/config');
define('STORAGE_PATH', BASE_PATH . '/storage');

// Autoloader
require_once BASE_PATH . '/vendor/autoload.php';

// Load environment
if (file_exists(BASE_PATH . '/.env')) {
    $dotenv = \Dotenv\Dotenv::createImmutable(BASE_PATH);
    $dotenv->load();
}
