<?php

namespace VighIosif\EntityContainers\SampleEntity;

use VighIosif\EntityContainers\Interfaces\EntityInterface;
use VighIosif\EntityContainers\Traits\Methods\FactoryMethodTrait;
use VighIosif\EntityContainers\Traits\Methods\GetDataMethodTrait;
use VighIosif\EntityContainers\Traits\Methods\UniqueIdentifierMethodTrait;
use VighIosif\EntityContainers\Traits\Properties\PropertyCreatedAndDeletedTrait;
use VighIosif\EntityContainers\Traits\Properties\PropertyIdTrait;

class AccountEntity implements EntityInterface
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
     * @var integer
     */
    private $type;
    /**
     * @var String
     */
    private $username;
    /**
     * @var String
     */
    private $password;

    private $mandatoryFields = ['type', 'username', 'password'];


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
     * @return AccountEntity
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
     * @return AccountEntity
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
     * @return AccountEntity
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
