<?php

namespace VighIosif\ObjectContainers\Classes;

use VighIosif\ObjectContainers\Interfaces\EntityInterface;
use VighIosif\ObjectContainers\Traits\Methods\FactoryMethodTrait;
use VighIosif\ObjectContainers\Traits\Methods\GetDataMethodTrait;
use VighIosif\ObjectContainers\Traits\Methods\UniqueIdentifierMethodTrait;
use VighIosif\ObjectContainers\Traits\Properties\PrivatePropertyAccessTrait;
use VighIosif\ObjectContainers\Traits\Properties\PropertyIdTrait;
use VighIosif\ObjectContainers\Traits\Properties\PropertyProtectionTrait;

class User implements EntityInterface
{
    use FactoryMethodTrait;
    use GetDataMethodTrait;
    use UniqueIdentifierMethodTrait;

    use PropertyIdTrait;
    use PropertyProtectionTrait;
    use PrivatePropertyAccessTrait;

    private $firstName;
    private $lastName;

    /**
     * @return mixed
     */
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * @param mixed $firstName
     *
     * @return User
     */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * @param mixed $lastName
     *
     * @return User
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }
}
