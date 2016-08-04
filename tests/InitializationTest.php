<?php
namespace VighIosif\ObjectContainers\Tests;

use VighIosif\ObjectContainers\Classes\User;
use VighIosif\ObjectContainers\Exceptions\ExceptionConstants;
use VighIosif\ObjectContainers\Exceptions\PropertyException;

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
        $user->setName('john')->setPassword('123');

        $userCopy = User::factory([
            'name'     => 'john',
            'password' => '123',
        ]);

        // Test the factory method
        $this->assertEquals(
            $user,
            $userCopy
        );

        // Test the getData output
        $this->assertEquals(
            $user->getData(),
            $userCopy->getData()
        );
    }

    public function testSetterExceptions()
    {
        $caughtException = null;
        try {
            $user = new User();
            $user->setId('john123');
        } catch (\Exception $e) {
            $caughtException = $e;
        }

        // Test exception type
        $this->assertEquals(
            get_class($caughtException),
            get_class(new PropertyException())
        );

        // Test exception code
        $this->assertEquals(
            $caughtException->getCode(),
            ExceptionConstants::INVALID_VALUE_CODE
        );

        // Test exception message
        $this->assertEquals(
            $caughtException->getMessage(),
            ExceptionConstants::INVALID_ID_MESSAGE
        );

        // Todo:Test Class origin - the exception should know it originated in class User
    }
}
