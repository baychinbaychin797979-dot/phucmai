#!/usr/bin/env php
<?php
/**
 * Movable Type Framework Console
 */

define('BASE_PATH', __DIR__);
define('SRC_PATH', BASE_PATH . '/src');
define('CONFIG_PATH', BASE_PATH . '/config');

// Load environment
require_once BASE_PATH . '/vendor/autoload.php';

// Initialize console
$console = new \MT\Console\Console();
$console->bootstrap();

// Run console
$argv = $_SERVER['argv'] ?? [];
$console->run($argv);
