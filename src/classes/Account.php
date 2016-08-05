<?php

namespace VighIosif\ObjectContainers\Classes;

use VighIosif\ObjectContainers\Interfaces\EntityInterface;
use VighIosif\ObjectContainers\Traits\Methods\FactoryMethodTrait;
use VighIosif\ObjectContainers\Traits\Methods\GetDataMethodTrait;
use VighIosif\ObjectContainers\Traits\Methods\UniqueIdentifierMethodTrait;
use VighIosif\ObjectContainers\Traits\Properties\PropertyIdTrait;

class Account implements EntityInterface
{
    use FactoryMethodTrait;
    use GetDataMethodTrait;
    use UniqueIdentifierMethodTrait;

    use PropertyIdTrait;

    const TYPE_SUPER_ADMIN = 1;
    const TYPE_ADMIN       = 2;
    const TYPE_USER        = 3;

    private $username;
    private $password;
    private $type;
    
    /**
     * @return mixed
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     *
     * @return Account
     */
    public function setUsername($username)
    {
        $this->username = $username;
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
     * @return Account
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     *
     * @return Account
     */
    public function setType($type)
    {
        $this->type = $type;
        return $this;
    }
}
