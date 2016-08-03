<?php

namespace VighIosif\ObjectContainers\Exceptions;

class MethodException extends BaseException
{
    const MISSING_ARRAY_METHOD_IN_OBJECT = 1;
    const MISSING_METHOD_IN_OBJECT       = 2;
    const MISSING_FIELDS_IN_INSTANCE     = 3;
    const MISSING_GET_DATA_FUNCTION      = 4;
    const INVALID_UNIQUE_IDENTIFIER      = 5;
}
