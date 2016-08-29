<?php

namespace VighIosif\EntityContainers\Interfaces;

interface EntityInterface
{
    /**
     * Returns unique identifier for the
     *
     * @return string
     */
    public function getUniqueIdentifier();

    /**
     * Returns an array version of the Object
     *
     * @param bool $addNullValues
     *
     * @return array
     */
    public function getData($addNullValues = true);
}
