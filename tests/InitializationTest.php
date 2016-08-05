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
        $user->setFirstName('John')->setLastName('Doe');

        $userCopy = User::factory([
            'firstName' => 'John',
            'lastName'  => 'Doe',
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

    /**
     * 1. Test if exception is thrown if trying to access a non-existing property
     * 2. Test if exception is thrown if trying to access a private property
     * 3. Try to directly access a private property if access is allowed
     */
    public function testMagicSettersAndGetters()
    {
        $user                         = new User();
        $propertyNotExistingException = null;
        try {
            $user->inexistentProperty = 'Blah';
        } catch (\Exception $e) {
            $propertyNotExistingException = $e;
        }

        $propertyPrivateException = null;
        try {
            $user->firstName = 'John';
        } catch (\Exception $e) {
            $propertyPrivateException = $e;
        }

        $user = new User();
        $user->setAccessToPrivateProperties(true);
        $user->firstName = 'John';
        $user->lastName  = 'Doe';
        $userCompare     = new User();
        $userCompare->setAccessToPrivateProperties(true)
            ->setFirstName('John')
            ->setLastName('Doe');

        $this->assertEquals(
            $propertyNotExistingException->getMessage(),
            ExceptionConstants::PROPERTY_DOES_NOT_EXIST . 'inexistentProperty'
        );
        $this->assertEquals(
            $propertyPrivateException->getMessage(),
            ExceptionConstants::PROPERTY_EXISTS_BUT_IS_PRIVATE . 'firstName'
        );
        $this->assertEquals($user, $userCompare);
    }
}
