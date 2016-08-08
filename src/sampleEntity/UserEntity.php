<?php

namespace VighIosif\EntityContainers\SampleEntity;

use VighIosif\EntityContainers\Interfaces\EntityInterface;
use VighIosif\EntityContainers\Traits\Methods\FactoryMethodTrait;
use VighIosif\EntityContainers\Traits\Methods\GetDataMethodTrait;
use VighIosif\EntityContainers\Traits\Methods\UniqueIdentifierMethodTrait;
use VighIosif\EntityContainers\Traits\Properties\PrivatePropertyAccessTrait;
use VighIosif\EntityContainers\Traits\Properties\PropertyIdTrait;
use VighIosif\EntityContainers\Traits\Properties\PropertyProtectionTrait;

class UserEntity implements EntityInterface
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
     * @return UserEntity
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
     * @return UserEntity
     */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
        return $this;
    }
}
