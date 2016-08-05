<?php

namespace VighIosif\ObjectContainers\Traits\Properties;

use VighIosif\ObjectContainers\Exceptions\ExceptionConstants;
use VighIosif\ObjectContainers\Exceptions\PropertyException;

/**
 * Sets "allowAccessToPrivateProperties" to true so that used with trait PropertyProtectionTrait you can access
 * properties directly
 * Class PropertyProtectionTrait
 *
 * @package VighIosif\ObjectContainers\Traits\Properties
 */
trait PrivatePropertyAccessTrait
{
    /**
     * Set to false for obvious security reasons
     *
     * @var bool
     */
    private $allowAccessToPrivateProperties = false;

    /**
     * @return boolean
     */
    public function getAllowAccessToPrivateProperties()
    {
        return $this->allowAccessToPrivateProperties;
    }

    /**
     * @param $allowAccessToPrivateProperties
     *
     * @return PrivatePropertyAccessTrait
     * @throws PropertyException
     */
    public function setAccessToPrivateProperties($allowAccessToPrivateProperties)
    {
        if (!is_bool($allowAccessToPrivateProperties)) {
            throw new PropertyException(
                ExceptionConstants::INVALID_BOOLEAN_MESSAGE,
                ExceptionConstants::INVALID_VALUE_CODE
            );
        }
        $this->allowAccessToPrivateProperties = $allowAccessToPrivateProperties;
        return $this;
    }
}
