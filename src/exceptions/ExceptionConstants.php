<?php

namespace VighIosif\ObjectContainers\Exceptions;

class ExceptionConstants extends BaseException
{
    // Codes
    const INVALID_VALUE_CODE                  = 1;
    const MISSING_FIELD_CODE                  = 2;
    const MISSING_METHOD_CODE                 = 3;
    const MISSING_METHOD_GET_DATA_CODE        = 4;
    const MISSING_ARRAY_METHOD_IN_OBJECT_CODE = 5;
    const MISSING_METHOD_IN_OBJECT_CODE       = 6;
    const MISSING_FIELDS_IN_INSTANCE_CODE     = 7;
    const INVALID_UNIQUE_IDENTIFIER_CODE      = 8;
    const INVALID_ENTITY_FORMAT_CODE          = 9;
    const PROPERTY_ACCESS_NOT_AUTHORIZED_CODE = 10;

    // Messages - Invalid values
    const INVALID_ID_MESSAGE      = 'Positive integer is needed';
    const INVALID_DATE_MESSAGE    = 'Valid date format is needed';
    const INVALID_ENTITY_FORMAT   = 'Invalid entity format';
    const INVALID_BOOLEAN_MESSAGE = 'Boolean format is needed';

    // Messages - Missing data
    const MANDATORY_FIELDS_MISSING_MESSAGE = 'Field \'mandatoryFields\' is missing';

    // Messages - Missing methods
    const GET_DATA_METHOD_MISSING_MESSAGE = 'Method \'getData()\' is missing';

    // Messages - Not authorized
    const PROPERTY_EXISTS_BUT_IS_PRIVATE = 'Can not directly access private property: ';
    const PROPERTY_DOES_NOT_EXIST        = 'The required property does not exist: ';
}
