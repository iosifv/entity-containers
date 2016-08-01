<?php
/**
 * Exception class
 *
 * @category  Exceptions
 * @package   Iqu\ContactApiClient
 * @author    Iosif Vigh <iosif.vigh@iqu.com>
 * @copyright 2016 iQU. All rights reserved.
 * @license   https://composer.iqugroup.com/license Proprietary and private
 * @link      http://www.iqu.com iQU Homepage
 */

namespace Iqu\ContactApiClient\Entity\Exceptions;

/**
 * Class BaseException.
 * This has the Factory methods needed to create customized exceptions.
 * All other exceptions in this package must extend this class.
 *
 * @category Exceptions
 * @package  Iqu\ContactApiClient
 * @author   Iosif Vigh <iosif.vigh@iqu.com>
 * @license  https://composer.iqugroup.com/license Proprietary and private
 * @link     http://www.iqu.com iQU Homepage
 */
class BaseException extends \Exception
{
    const INVALID_VALUE_EXCEPTION             = 1;
    const INVALID_TYPE_ID_EXCEPTION           = 2;
    const INVALID_UNIQUE_IDENTIFIER_EXCEPTION = 3;

    /**
     * Creates a custom message if all parameters are provided.
     *
     * @param string $typeString Text description of the needed type
     *
     * @return \Exception
     */
    protected static function messageForInvalidType($typeString)
    {
        $message = 'Invalid ' . $typeString;
        return $message;
    }

    /**
     * Creates a custom message if all parameters are provided.
     *
     * @param string $value        Pass the invalid value which has to be shown
     * @param null   $fieldName    Name of the field in which the value was found
     * @param null   $requirements What the value should have been
     *
     * @return \Exception
     */
    protected static function messageForInvalidValue($value, $fieldName = null, $requirements = null)
    {
        $type    = gettype($value);
        $message = 'Invalid value provided: ' . (string) $value . ' of type: (' . $type . ').';
        if ($fieldName !== null && $requirements !== null) {
            $message .= ' For field <' . $fieldName . '> a <' . $requirements . '> is required.';
        }
        return $message;
    }

    /**
     * Creates one Exception object and sets the appropriate Code and Message
     * Example parameters: ('email type id')
     *
     * @param String $invalidTypeDescription Text description or name of the invalid type id
     *
     * @return static
     */
    public static function factoryInvalidTypeId($invalidTypeDescription)
    {
        $exception = new static(
            self::messageForInvalidType($invalidTypeDescription),
            self::INVALID_TYPE_ID_EXCEPTION
        );
        return $exception;
    }

    /**
     * Creates one Exception object and sets the appropriate Code and Message
     * Example parameters: ($id, 'id', 'positive integer')
     *
     * @param mixed $value        Pass the invalid value
     * @param null  $fieldName    Name of the field in which the value has been found
     * @param null  $requirements What the value should have been
     *
     * @return static
     */
    public static function factoryInvalidValue($value, $fieldName = null, $requirements = null)
    {
        $exception = new static(
            self::messageForInvalidValue($value, $fieldName, $requirements),
            self::INVALID_VALUE_EXCEPTION
        );
        return $exception;
    }

    /**
     * Creates one Exception object and sets the appropriate Code and Message
     * Example parameters: ($name, 'name', 50)
     *
     * @param mixed $value     Pass the invalid value
     * @param null  $fieldName Name of the field in which the value has been found
     * @param null  $max       What the maximum length should have been
     * @param null  $min       What the minimum length should have been
     *
     * @return static
     */
    public static function factoryInvalidString($value, $fieldName = null, $max = null, $min = null)
    {
        $requirements = '';
        if (!is_null($max)) {
            $requirements = 'a string with less than ' . $max . ' characters';
            if (!is_null($min)) {
                $requirements .= ' and more than ' . $min . ' characters';
            }
        }
        $exception = new static(
            self::messageForInvalidValue($value, $fieldName, $requirements),
            self::INVALID_VALUE_EXCEPTION
        );
        return $exception;
    }

    /**
     * Creates one Exception object and sets the appropriate Code and Message
     *
     * @return static
     */
    public static function factoryIncompleteIdentifier()
    {
        $exception = new static(
            'The entity does not have any fields set, thus can not be uniquely identified.',
            self::INVALID_UNIQUE_IDENTIFIER_EXCEPTION
        );
        return $exception;
    }
}
