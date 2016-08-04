<?php

namespace VighIosif\ObjectContainers\Traits\Methods;

use VighIosif\ObjectContainers\Interfaces\EntityInterface;

/**
 * Class EntityMerge
 * This trait contains a method to merge two objects which have methods to deliver an easy way to return key/value
 * arrays from objects with private properties and corresponding get-methods
 *
 * @package VighIosif\ObjectContainers\Traits
 */
trait MergeMethodTrait
{
    /**
     * Can be used within classes which have private properties and corresponding get methods to return the data
     * This method will allow to merge subsequent objects which implements the getData method
     *
     * @param EntityInterface $entity
     *
     * @return MergeMethodTrait
     */
    public function merge(EntityInterface $entity)
    {
        // First thing to do, is to change the Entity into an array
        $data = $entity->getData();

        // Parse each key-value pair
        foreach ($data as $key => $value) {
            // skip if the key has no value.
            if (empty($value)) {
                continue;
            }

            // Check if there are fields which are protected from merging.
            if (!isset($this->mergeProtectedFields) ||
                !in_array($key, $this->mergeProtectedFields)
            ) {
                $setMethod = 'set' . str_replace('_', '', $key);
                $getMethod = 'get' . str_replace('_', '', $key);
                $getResult = $this->$getMethod();
                /**
                 * The result can be in 3 categories
                 * 1. SCALAR (integer, float, string, boolean)
                 *      - If the result is a scalar we just call the setMethod()
                 * 2. ARRAY
                 *      - Just merge the existing array with the new one
                 * 3. OBJECT
                 *      - This obviously works only if the object to merge has the merge() method.
                 *      - In other words, we can merge objects of this structure between each other.
                 *      - This will result in a recursive call of the merge() function.
                 */
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
