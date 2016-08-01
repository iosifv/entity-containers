<?php

namespace VighIosif\ObjectContainers\Exceptions;

class EntityFactoryException extends \Exception
{
    const MISSING_FIELDS_IN_INSTANCE     = 1;
    const MISSING_METHOD_IN_OBJECT       = 2;
    const MISSING_ARRAY_METHOD_IN_OBJECT = 3;
}
