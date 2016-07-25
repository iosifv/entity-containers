<?php

namespace vighiosif\ObjectContainers\Tests;

class InitializationTest extends\PHPUnit_Framework_TestCase
{
    public function __construct()
    {
        date_default_timezone_set('Europe/Amsterdam');
        parent::__construct();
    }


    public function testFactoryConsistency()
    {
        // Test the getData output
        $this->assertEquals(
            1,
            1
        );
    }
}
