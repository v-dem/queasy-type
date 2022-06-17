<?php

namespace queasy\type;

class IntArray extends TypedArray
{
    public function __construct(array $items = null)
    {
        parent::__construct('int', $items);
    }
}

