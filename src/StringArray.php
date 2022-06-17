<?php

namespace queasy\type;

class StringArray extends TypedArray
{
    public function __construct(array $items = null)
    {
        parent::__construct('string', $items);
    }
}

