<?php
namespace VighIosif\EntityContainers\Tests;

use VighIosif\EntityContainers\Classes\User;
use VighIosif\EntityContainers\Exceptions\ExceptionConstants;
use VighIosif\EntityContainers\Exceptions\PropertyException;

require dirname(__FILE__) . '/../vendor/autoload.php';

class InitializationTest extends \PHPUnit_Framework_TestCase
{
    public function __construct()
    {
        date_default_timezone_set('Europe/Amsterdam');
        parent::__construct();
    }

    /**
     * Test the consistency of the factory() and getData() methods
     *
     * @throws \VighIosif\EntityContainers\Exceptions\MethodException
     */
    public function testFactoryConsistency()
    {
        $user = new User();
        $user->setId(5)
            ->setFirstName('John')
            ->setLastName('Doe');

        $userCompare = User::factory([
            'id'        => 5,
            'firstName' => 'John',
            'lastName'  => 'Doe',
        ]);

        // Test the factory method
        $this->assertEquals(
            $user,
            $userCompare
        );

        // Test the getData output
        $this->assertEquals(
            $user->getData(),
            $userCompare->getData()
        );

        // Test to show the main feature of this library :)
        $this->assertEquals(
            $user,
            User::factory($user->getData())
        );
    }

    /**
     * Test all possible exceptions that can be thrown by setter methods
     */
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
        $user->setAccessPrivateProperties(true);
        $user->firstName = 'John';
        $user->lastName  = 'Doe';
        $userCompare     = new User();
        $userCompare->setAccessPrivateProperties(true)
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
