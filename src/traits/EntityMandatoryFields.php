<?php

namespace VighIosif\ObjectContainers\Traits;

/**
 * This trait deals with the mandatory fields.
 *
 * Class EntityMandatoryFields
 *
 * @package VighIosif\ObjectContainers\Traits
 */
trait EntityMandatoryFields
{
    /**
     * This method will validate all mandatory fields.
     * The default behaviour is checking if the mandatory fields have a different value from null
     * In other words: check if the seter has been called for all mandatory fields.
     *
     * @param string $check
     *
     * @return bool
     */
    public final function validateMandatoryFields($check = 'is_null')
    {
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
     */
    public final function getMissingMandatoryFields($check = 'is_null')
    {
        $missingFields = [];
        foreach ($this->mandatoryFields as $field) {
            if ($check($this->{"get" . $field}())) {
                $missingFields[] = $field;
            }
        }
        return implode(', ', $missingFields);
    }
}
