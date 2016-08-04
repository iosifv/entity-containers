<?php

namespace VighIosif\ObjectContainers\Traits\Methods;

use VighIosif\ObjectContainers\Exceptions\ExceptionConstants;
use VighIosif\ObjectContainers\Exceptions\MethodException;

/**
 * Class EntityGetData
 * This trait contains methods to deliver an easy way to return key/value arrays from objects with private properties
 * and corresponding get-methods
 *
 * @package VighIosif\ObjectContainers\Traits
 */
trait GetDataMethodTrait
{
    /**
     * Can be used within classes which has private properties and corresponding get methods to return the data
     * This method will allow to get a whole array with all corresponding properties and values back
     *
     * @param bool $addNullValues
     *
     * @return array
     * @throws MethodException
     */
    public function getData($addNullValues = true)
    {
        $result = [];
        // Create a list with all methods in the class which start with 'get'
        $methods = $this->getClassPropertiesWithPrefixedMethods('get');
        // Walk through all methods
        foreach ($methods as $property => $method) {
            if (method_exists($this, $method)) {
                // If the method exists, we save it's value
                $value = $this->{$method}();
                // If the value is null, there's the option to ignore that
                if (!$addNullValues && is_null($value)) {
                    continue;
                }
                /**
                 * The value can be in 3 categories
                 * 1. SCALAR (integer, float, string, boolean)
                 *      - Just assign the value
                 * 2. ARRAY
                 *      - Just assign the array
                 * 3. OBJECT
                 *      - This obviously works only if the object has the getData() method
                 * 4. NULL
                 *      - null value is saved only if permitted by the method parameter
                 */
                if (is_scalar($value) || is_array($value)) {
                    $result[$property] = $value;
                } elseif (is_object($value)) {
                    if (!method_exists($value, 'getData')) {
                        throw new MethodException(
                            ExceptionConstants::GET_DATA_METHOD_MISSING_MESSAGE,
                            ExceptionConstants::MISSING_METHOD_GET_DATA_CODE
                        );
                    }
                    $result[$property] = $value->getData($addNullValues);
                } elseif ($addNullValues) {
                    $result[$property] = null;
                }
            }
        }
        return $result;
    }

    /**
     * Returns a list of methods based on class properties which have the corresponding given prefixed method
     *
     * @param string $prefix
     *
     * @return array
     */
    public final function getClassPropertiesWithPrefixedMethods($prefix = 'get')
    {
        $methodList = [];
        $objectVars = array_keys(get_object_vars($this));
        foreach ($objectVars as $property) {
            $method = $prefix . str_replace('_', '', $property);
            // Only add the property to the result list if the corresponding method exists
            if (method_exists($this, $method)) {
                $methodList[$property] = $method;
            }
        }
        return $methodList;
    }
}
