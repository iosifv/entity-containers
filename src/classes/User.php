<?php

namespace VighIosif\ObjectContainers\Classes;

use VighIosif\ObjectContainers\Interfaces\EntityInterface;
use VighIosif\ObjectContainers\Traits\Methods\GetDataMethodTrait;

class User implements EntityInterface
{
    use GetDataMethodTrait;
    
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
