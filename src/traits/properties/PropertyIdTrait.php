<?php

namespace VighIosif\EntityContainers\Traits\Properties;

use VighIosif\EntityContainers\Exceptions\ExceptionConstants;
use VighIosif\EntityContainers\Exceptions\PropertyException;

trait PropertyIdTrait
{
    /**
     * Unique ID of any of the Entity Objects
     *
     * @var int
     */
    private $id;

    /**
     * Id getter
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Id setter
     *
     * @param int $id value to be set
     *
     * @return $this
     * @throws PropertyException
     */
    public function setId($id)
    {
        $idInt = intval($id);
        if (!is_numeric($id) || $id != $idInt || $idInt <= 0) {
            // $exceptionClassName = self::EXCEPTION_CLASS;
            // /**
            //  * Will be some class extended from this base Exception, but this is good enough for code linting
            //  *
            //  * @var BaseException $exceptionClassName
            //  */
            // throw $exceptionClassName::factoryInvalidValue($id, 'id', 'positive integer');
            throw new PropertyException(
                ExceptionConstants::INVALID_ID_MESSAGE,
                ExceptionConstants::INVALID_VALUE_CODE
            );
        }
        $this->id = $idInt;
        return $this;
    }
}
