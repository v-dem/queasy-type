<?php

namespace queasy\type;

class FloatArray extends TypedArray
{
    public function __construct(array $items = null)
    {
        parent::__construct('float', $items);
    }
}

