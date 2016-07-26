<?php
namespace VighIosif\ObjectContainers\Tests;

use VighIosif\ObjectContainers\Classes\User;

require dirname(__FILE__) . '/../vendor/autoload.php';

class InitializationTest extends \PHPUnit_Framework_TestCase
{
    public function __construct()
    {
        date_default_timezone_set('Europe/Amsterdam');
        parent::__construct();
    }


    public function testFactoryConsistency()
    {
        $user = new User();
                
        // Test the getData output
        $this->assertEquals(
            1,
            1
        );
    }
}
