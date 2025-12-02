<?php

namespace Tests;

/**
 * TestCase Base Class
 */
abstract class TestCase
{
    protected $db;
    protected $auth;
    protected $cache;
    
    /**
     * Set up test case
     */
    protected function setUp()
    {
        // Initialize test dependencies
    }
    
    /**
     * Tear down test case
     */
    protected function tearDown()
    {
        // Clean up test data
    }
    
    /**
     * Assert equal
     */
    protected function assertEqual($expected, $actual)
    {
        assert($expected === $actual, "Expected $expected but got $actual");
    }
    
    /**
     * Assert true
     */
    protected function assertTrue($condition)
    {
        assert($condition === true, "Condition is not true");
    }
    
    /**
     * Assert false
     */
    protected function assertFalse($condition)
    {
        assert($condition === false, "Condition is not false");
    }
}
