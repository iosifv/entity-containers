<?php

namespace VighIosif\EntityContainers\Traits\Properties;

use VighIosif\EntityContainers\Exceptions\ExceptionConstants;
use VighIosif\EntityContainers\Exceptions\PropertyException;

/**
 * Sets "allowAccessToPrivateProperties" to true so that used with trait PropertyProtectionTrait you can access
 * properties directly
 * Class PropertyProtectionTrait
 *
 * @package VighIosif\EntityContainers\Traits\Properties
 */
trait PrivatePropertyAccessTrait
{
    /**
     * Set to false for obvious security reasons
     *
     * @var bool
     */
    private $accessPrivateProperties = false;

    /**
     * @return boolean
     */
    public function getAccessPrivateProperties()
    {
        return $this->accessPrivateProperties;
    }

    /**
     * @param $accessPrivateProperties
     *
     * @return PrivatePropertyAccessTrait
     * @throws PropertyException
     */
    public function setAccessPrivateProperties($accessPrivateProperties)
    {
        if (!is_bool($accessPrivateProperties)) {
            throw new PropertyException(
                ExceptionConstants::INVALID_BOOLEAN_MESSAGE,
                ExceptionConstants::INVALID_VALUE_CODE
            );
        }
        $this->accessPrivateProperties = $accessPrivateProperties;
        return $this;
    }
}
