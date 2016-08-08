<?php

namespace VighIosif\EntityContainers\Traits\Methods;

use VighIosif\EntityContainers\Exceptions\ExceptionConstants;
use VighIosif\EntityContainers\Exceptions\MethodException;

/**
 * This trait deals with the mandatory fields.
 * Class EntityMandatoryFields
 *
 * @package VighIosif\EntityContainers\Traits
 */
trait MandatoryFieldsMethodTrait
{
    /**
     * This method will validate all mandatory fields.
     * The default behaviour is checking if the mandatory fields have a different value from null
     * In other words: check if the setter has been called for all mandatory fields.
     *
     * @param string $check
     *
     * @return bool
     * @throws MethodException
     */
    public final function validateMandatoryFields($check = 'is_null')
    {
        if (!isset($this->mandatoryFields)) {
            throw new MethodException(
                ExceptionConstants::MANDATORY_FIELDS_MISSING_MESSAGE,
                ExceptionConstants::MISSING_FIELD_CODE
            );
        }
        foreach ($this->mandatoryFields as $field) {
            // Todo: add more options here: empty_string, ...
            if ($check($this->{"get" . $field}())) {
                return false;
            }
        }

        return true;
    }

    /**
     * Returns a string list of all Mandatory fields which are missing.
     * Useful for debugging purposes
     *
     * @param string $check
     *
     * @return mixed
     * @throws MethodException
     */
    public final function getMissingMandatoryFields($check = 'is_null')
    {
        if (!isset($this->mandatoryFields)) {
            throw new MethodException(
                ExceptionConstants::MANDATORY_FIELDS_MISSING_MESSAGE,
                ExceptionConstants::MISSING_FIELD_CODE
            );
        }
        
        $missingFields = [];
        foreach ($this->mandatoryFields as $field) {
            if ($check($this->{"get" . $field}())) {
                $missingFields[] = $field;
            }
        }

        return implode(', ', $missingFields);
    }
}
