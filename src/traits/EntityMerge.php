<?php
/**
 * This file contains the EntityGetData trait

 */

namespace vighiosif\ObjectContainers\Traits\DataModel;

/**
 * Class EntityMerge
 * This trait contains a method to merge two objects which have methods to deliver an easy way to return key/value
 * arrays from objects with private properties and corresponding get-methods
 *
 * @package vighiosif\ObjectContainers\Traits\DataModel
 */
trait EntityMerge
{
    /**
     * can be used within classes which has private properties and corresponding get methods to return the data
     * this method will allow to merge subsequent objects which implements the getData method
     *
     * @return EntityMerge
     */
    public function merge(\vighiosif\ObjectContainers\Interfaces\DataModel\Entity $entity)
    {
        $data = $entity->getData();
        foreach ($data AS $key => $value) {
            if ($value && (!isset($this->mergeProtectedFields) || !in_array($key, $this->mergeProtectedFields))) {
                $setMethod = 'set' . str_replace('_', '', $key);
                $getMethod = 'get' . str_replace('_', '', $key);
                $getResult = $this->$getMethod();
                if (is_scalar($getResult) || is_null($getResult)) {
                    $this->$setMethod($value);
                } elseif (is_array($getResult)) {
                    $this->$setMethod(array_merge($getResult, $value));
                } elseif (is_object($getResult) && method_exists($getResult, 'merge')) {
                    $this->$setMethod($getResult->merge($entity->$getMethod()));
                }
            }
        }
        return $this;
    }

}
