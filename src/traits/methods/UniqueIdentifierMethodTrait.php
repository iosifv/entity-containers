<?php

namespace VighIosif\ObjectContainers\Traits\Methods;

use VighIosif\ObjectContainers\Exceptions\ExceptionConstants;
use VighIosif\ObjectContainers\Exceptions\MethodException;

trait UniqueIdentifierMethodTrait
{
    /**
     * This method is used for assigning list entries into a container, see it as array key.
     *
     * @return int
     * @throws MethodException
     */
    public function getUniqueIdentifier()
    {
        $unique = '';
        // Todo: getDbColumn() does not exist. Switch to using mandatory fields?
        // $fields = $this->getDbColumns();
        $fields = $this->mandatoryFields;
        foreach ($fields as $field) {
            $str = ucwords(str_replace('_', '', $field));
            $unique .= $this->{"get" . $str}();
        }
        if ('' === $unique) {
            throw new MethodException(
                'The entity does not have any fields set, thus can not be uniquely identified.',
                ExceptionConstants::INVALID_UNIQUE_IDENTIFIER_CODE
            );
        }
        return md5($unique);
    }
}
