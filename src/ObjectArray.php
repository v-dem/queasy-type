<?php

namespace queasy\type;

class ObjectArray extends TypedArray
{
    public function __construct(array $items = null)
    {
        parent::__construct('object', $items);
    }
}

