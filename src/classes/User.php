<?php

namespace VighIosif\ObjectContainers\Classes;

use VighIosif\ObjectContainers\Interfaces\EntityInterface;
use VighIosif\ObjectContainers\Traits\Methods\FactoryMethodTrait;
use VighIosif\ObjectContainers\Traits\Methods\GetDataMethodTrait;
use VighIosif\ObjectContainers\Traits\Methods\UniqueIdentifierMethodTrait;
use VighIosif\ObjectContainers\Traits\Properties\PropertyIdTrait;

class User implements EntityInterface
{
    use FactoryMethodTrait;
    use GetDataMethodTrait;
    use UniqueIdentifierMethodTrait;

    use PropertyIdTrait;

    private $name;
    private $password;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     *
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }
}
