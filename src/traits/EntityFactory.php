<?php
/**
 * This file contains the EntityFactory trait
 */

namespace VighIosif\ObjectContainers\Traits;

/**
 * Class EntityFactory
 * This trait contains methods to deliver an easy way to create an entity instance with data passed as array in the
 * factory method
 *
 * @package VighIosif\ObjectContainers\Traits
 */
trait EntityFactory
{
    /**
     * Returns an object created from the properly formatted array.
     *
     * @param array $data
     *
     * @return static
     * @throws EntityFactoryException
     */
    public static function factory(array $data = [])
    {
        // This will create a new instance of the object from which this trait-function was called:
        // For the following code UserEntity::factory() starts by creating an UserEntity object
        $instance = new static();
        foreach ($data as $property => $value) {
            // the method for setting a value must start with 'set'
            $method = 'set' . str_replace('_', '', $property);
            // If the value is an array then a special method must be implemented
            // which starts with 'set' and ends with 'AsArray'. Example: setListAsArray()
            if (is_array($value)) {
                $arrayMethod = $method . 'AsArray';
                if (method_exists($instance, $arrayMethod)) {
                    $instance->{$arrayMethod}($value);
                    continue;
                } else {
                    // @ToDo: throw exception?
                }
            }
            if (method_exists($instance, $method)) {
                $instance->{$method}($value);
            } else {
                // @ToDo: throw exception?
            }
        }

        // Automatic force validation
        if (method_exists($instance, 'validateMandatoryFields') &&
            $instance->validateMandatoryFields() !== true
        ) {
            $message = 'Created instance has missing mandatory fields: ' . $instance->getMissingMandatoryFields();
            throw new EntityFactoryException($message, EntityFactoryException::MISSING_FIELDS_IN_INSTANCE);
        }
        return $instance;
    }
}
