<?php

namespace VighIosif\EntityContainers\Interfaces;

interface EntityInterface
{
    /**
     * Returns unique identifier for the
     *
     * @return string|integer
     */
    public function getUniqueIdentifier();

    /**
     * Returns an array version of the Object
     *
     * @return array
     */
    public function getData();
}
