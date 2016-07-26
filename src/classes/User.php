<?php

namespace VighIosif\ObjectContainers\Classes;

use VighIosif\ObjectContainers\Interfaces\EntityInterface;
use VighIosif\ObjectContainers\Traits\EntityGetData;

class User implements EntityInterface
{
    use EntityGetData;
    
    public function getUniqueIdentifier()
    {
        // TODO: Implement getUniqueIdentifier() method.
    }
    
    private $name;
    
    public function __construct()
    {
        $this->name = 'gugu';
    }
}
