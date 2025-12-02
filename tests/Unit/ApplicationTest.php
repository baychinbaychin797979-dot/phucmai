<?php

namespace Tests\Unit;

use Tests\TestCase;
use MT\Core\Application;

/**
 * Application Test
 */
class ApplicationTest extends TestCase
{
    /**
     * Test application initialization
     */
    public function testApplicationInitialization()
    {
        $app = new Application();
        $this->assertTrue($app !== null);
    }
    
    /**
     * Test service registration
     */
    public function testServiceRegistration()
    {
        $app = new Application();
        $app->registerServices();
        $this->assertTrue(true);
    }
}
