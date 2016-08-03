<?php

namespace VighIosif\ObjectContainers\Traits\Methods;

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
        $fields = $this->getDbColumns();
        foreach ($fields as $field) {
            $str = ucwords(str_replace('_', '', $field));
            $unique .= $this->{"get" . $str}();
        }
        if ('' === $unique) {
            throw new MethodException(
                'The entity does not have any fields set, thus can not be uniquely identified.',
                MethodException::INVALID_UNIQUE_IDENTIFIER
            );
        }
        return md5($unique);
    }
}
