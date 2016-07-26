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
    public static function factory(array $data = [])
    {
        $instance = new static();
        foreach ($data as $property => $value) {
            $method = 'set' . str_replace('_', '', $property);
            if (is_array($value)) {
                $arrayMethod = $method . 'AsArray';
                if (method_exists($instance, $arrayMethod)) {
                    $instance->{$arrayMethod}($value);
                    continue;
                }
            }
            if (method_exists($instance, $method)) {
                $instance->{$method}($value);
            }
        }
        if (method_exists($instance, 'validateMandatoryFields') && $instance->validateMandatoryFields() !== true) {
            $message = 'Created instance has missing mandatory fields: ' . $instance->getMissingMandatoryFields();
            throw new EntityFactoryException($message, EntityFactoryException::MISSING_FIELDS_IN_INSTANCE);
        }
        return $instance;
    }
}
