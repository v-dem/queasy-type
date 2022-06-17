<?php

namespace queasy\type;

class ArrayArray extends TypedArray
{
    public function __construct(array $items = null)
    {
        parent::__construct('array', $items);
    }
}

