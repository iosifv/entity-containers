<?php

namespace VighIosif\ObjectContainers\Traits\Properties;

use VighIosif\ObjectContainers\Exceptions\ExceptionConstants;
use VighIosif\ObjectContainers\Exceptions\PropertyException;

/**
 * Provides a small workaround if you are too lazy to write your setters and getters
 * Just set a private property called "accessPrivateProperties" to true in your class to have this.
 * Class PropertyProtectionTrait
 *
 * @package VighIosif\ObjectContainers\Traits\Properties
 */
trait PropertyProtectionTrait
{
    /**
     * @param $property
     *
     * @return mixed
     * @throws PropertyException
     */
    public function __get($property)
    {
        if (property_exists($this, $property) &&
            isset($this->accessPrivateProperties) &&
            true === $this->accessPrivateProperties
        ) {
            return $this->$property;
        }

        if (property_exists($this, $property)) {
            throw new PropertyException(
                ExceptionConstants::PROPERTY_EXISTS_BUT_IS_PRIVATE,
                ExceptionConstants::PROPERTY_ACCESS_NOT_AUTHORIZED_CODE
            );
        } else {
            throw new PropertyException(
                ExceptionConstants::PROPERTY_EXISTS_BUT_IS_PRIVATE,
                ExceptionConstants::PROPERTY_DOES_NOT_EXIST
            );
        }
    }

    /**
     * @param $property
     * @param $value
     *
     * @return $this
     * @throws PropertyException
     */
    public function __set($property, $value)
    {
        if (property_exists($this, $property) &&
            isset($this->accessPrivateProperties) &&
            true === $this->accessPrivateProperties
        ) {
            $this->$property = $value;
            return $this;
        }

        if (property_exists($this, $property)) {
            throw new PropertyException(
                ExceptionConstants::PROPERTY_EXISTS_BUT_IS_PRIVATE . $property,
                ExceptionConstants::PROPERTY_ACCESS_NOT_AUTHORIZED_CODE
            );
        } else {
            throw new PropertyException(
                ExceptionConstants::PROPERTY_DOES_NOT_EXIST . $property,
                ExceptionConstants::PROPERTY_ACCESS_NOT_AUTHORIZED_CODE
            );
        }
    }
}
