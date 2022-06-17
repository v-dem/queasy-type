<?php

namespace queasy\type;

class ResourceArray extends TypedArray
{
    public function __construct(array $items = null)
    {
        parent::__construct('resource', $items);
    }
}

