<?php

namespace VighIosif\ObjectContainers\Classes;

use VighIosif\ObjectContainers\Interfaces\EntityInterface;
use VighIosif\ObjectContainers\Traits\Methods\FactoryMethodTrait;
use VighIosif\ObjectContainers\Traits\Methods\GetDataMethodTrait;
use VighIosif\ObjectContainers\Traits\Methods\UniqueIdentifierMethodTrait;
use VighIosif\ObjectContainers\Traits\Properties\PropertyCreatedAndDeletedTrait;
use VighIosif\ObjectContainers\Traits\Properties\PropertyIdTrait;

class Account implements EntityInterface
{
    use FactoryMethodTrait;
    use GetDataMethodTrait;
    use UniqueIdentifierMethodTrait;

    use PropertyIdTrait;
    use PropertyCreatedAndDeletedTrait;

    const TYPE_SUPER_ADMIN = 1;
    const TYPE_ADMIN       = 2;
    const TYPE_USER        = 3;

    /**
     * @var String
     */
    private $username;
    /**
     * @var String
     */
    private $password;
    /**
     * @var integer
     */
    private $type;


    public function getUserTypes()
    {
        return [
            1 => self::TYPE_SUPER_ADMIN,
            2 => self::TYPE_ADMIN,
            3 => self::TYPE_USER,
        ];
    }

    /**
     * @return String
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param String $username
     *
     * @return Account
     */
    public function setUsername($username)
    {
        $this->username = $username;
        return $this;
    }

    /**
     * @return String
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param String $password
     *
     * @return Account
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return int
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param int $type
     *
     * @return Account
     * @throws \Exception
     */
    public function setType($type)
    {
        if (!in_array($type, $this->getUserTypes())) {
            // Todo: make exception class for this
            throw new \Exception('Invalid user type: ' . $type);
        }
        $this->type = $type;
        return $this;
    }
}
