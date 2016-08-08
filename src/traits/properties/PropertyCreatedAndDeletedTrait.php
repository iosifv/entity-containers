<?php

namespace VighIosif\EntityContainers\Traits\Properties;

use DateTime;
use VighIosif\EntityContainers\Exceptions\ExceptionConstants;
use VighIosif\EntityContainers\Exceptions\PropertyException;

trait PropertyCreatedAndDeletedTrait
{
    /**
     * Stores the creation date of the entity. Defaults to null in the constructor.
     *
     * @var string
     */
    private $created;

    /**
     * Stores the creation date of the entity. Defaults to null in the constructor.
     *
     * @var string
     */
    private $deleted;

    /**
     * Stores the datetime format used. Variable because an not use constants in traits.
     *
     * @var string
     */
    private $DEFAULT_DATETIME_FORMAT = 'Y-m-d H:i:s';

    /**
     * Returns the created date as a Datetime object
     *
     * @return DateTime
     */
    public function getCreatedDatetime()
    {
        return DateTime::createFromFormat($this->DEFAULT_DATETIME_FORMAT, $this->getCreated());
    }

    /**
     * Returns the created date as string
     *
     * @return string
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Parameter must be formatted as a valid datetime with this format: 'Y-m-d H:i:s'
     *
     * @param String $createdString Value to be set
     *
     * @return $this
     * @throws PropertyException
     */
    public function setCreated($createdString)
    {
        if (null !== $createdString) {
            $this->validateDatetimeString($createdString, $this->DEFAULT_DATETIME_FORMAT);
        }
        $this->created = $createdString;
        return $this;
    }

    /**
     * Returns the deleted date as a Datetime object
     *
     * @return DateTime
     */
    public function getDeletedDatetime()
    {
        return DateTime::createFromFormat($this->DEFAULT_DATETIME_FORMAT, $this->getDeleted());
    }

    /**
     * Returns the deleted date as string
     *
     * @return String
     */
    public function getDeleted()
    {
        return $this->deleted;
    }

    /**
     * Parameter must be formatted as a valid datetime with this format: 'Y-m-d H:i:s'
     *
     * @param String $deletedString Value to be set
     *
     * @return $this
     * @throws PropertyException
     */
    public function setDeleted($deletedString)
    {
        if (null !== $deletedString) {
            $this->validateDatetimeString($deletedString, $this->DEFAULT_DATETIME_FORMAT);
        }
        $this->deleted = $deletedString;
        return $this;
    }

    /**
     * Sets created from a Datetime Object
     *
     * @param DateTime $created Value to be set
     *
     * @return $this
     */
    public function setCreatedDatetime(DateTime $created)
    {
        $formattedDate = $created->format($this->DEFAULT_DATETIME_FORMAT);
        $this->setCreated($formattedDate);
        return $this;
    }

    /**
     * Sets deleted from a Datetime Object
     *
     * @param DateTime $deleted Value to be set
     *
     * @return $this
     */
    public function setDeletedDatetime(DateTime $deleted)
    {
        $formattedDate = $deleted->format($this->DEFAULT_DATETIME_FORMAT);
        $this->setDeleted($formattedDate);
        return $this;
    }

    /**
     * Sets the created date to NOW()
     *
     * @return $this
     */
    public function setCreatedToNow()
    {
        $this->setCreated(date($this->DEFAULT_DATETIME_FORMAT));
        return $this;
    }

    /**
     * Sets the deleted date to NOW()
     *
     * @return $this
     */
    public function setDeletedToNow()
    {
        $this->setDeleted(date($this->DEFAULT_DATETIME_FORMAT));
        return $this;
    }

    /**
     * Validates a datetime string to make sure it has a certain format.
     *
     * @param String $datetimeString Datetime value as string
     * @param String $format         date format
     *
     * @return null
     * @throws PropertyException
     */
    private function validateDatetimeString($datetimeString, $format)
    {
        $datetimeObject = DateTime::createFromFormat($format, $datetimeString);
        if ($datetimeObject === false || $datetimeObject->format($format) !== $datetimeString) {
            // $exceptionClassName = self::EXCEPTION_CLASS;
            // /**
            //  * Will be some class extended from this BaseException, but this is good enough for code linting
            //  *
            //  * @var BaseException $exceptionClassName
            //  */
            // throw $exceptionClassName::factoryInvalidValue($datetimeString, 'created|deleted', 'format: ' . $format);
            throw new PropertyException(
                ExceptionConstants::INVALID_ID_MESSAGE,
                ExceptionConstants::INVALID_DATE_MESSAGE
            );
        }
    }
}
