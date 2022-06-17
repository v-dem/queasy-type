<?php

namespace queasy\type;

class TypedArray implements \Iterator, \ArrayAccess, \Countable
{
    const SINGLE_TYPES = array('int', 'bool', 'float', 'string', 'array', 'object', 'resource');

    private $classOrTypeName;

    private $isSingleType;

    private $items = array();

    private $position = 0;

    /**
     * Constructor.
     *
     * @param string $classOrTypeName Class or type of collection items.
     * @param array $items Optional. Array of initial values.
     */
    public function __construct($classOrTypeName, array $items = null)
    {
        $this->classOrTypeName = $classOrTypeName;
        $this->isSingleType = in_array($classOrTypeName, self::SINGLE_TYPES);

        if (null === $items) {
            return;
        }

        foreach ($items as $item) {
            $this->append($item);
        }
    }

    // Iterator implementation

    public function rewind() {
        $this->position = 0;
    }

    public function current() {
        $keys = array_keys($this->items);
        $key = $keys[$this->position];

        return $this->items[$key];
    }

    public function key() {
        return $this->position;
    }

    public function next() {
        ++$this->position;
    }

    public function valid() {
        $keys = array_keys($this->items);
        if (count($keys) <= $this->position) {
            return false;
        }

        $key = $keys[$this->position];

        return isset($this->items[$key]);
    }

    // ArrayAccess implementation

    public function offsetSet($offset, $item) {
        if (is_null($offset)) {
            $this->append($item);
        } else {
            if (!$this->validateType($item)) {
                throw new \InvalidArgumentException();
            }

            $this->items[$offset] = $item;
        }
    }

    public function offsetExists($offset) {
        return isset($this->items[$offset]);
    }

    public function offsetUnset($offset) {
        unset($this->items[$offset]);
    }

    public function offsetGet($offset) {
        return isset($this->items[$offset])
            ? $this->items[$offset]
            : null;
    }

    // Countable implementation

    public function count(): int
    {
        return count($this->items);
    }

    public function __toString()
    {
        return print_r($this->items, true);
    }

    public function toArray()
    {
        return $this->items;
    }

    protected function append($item)
    {
        if (!$this->validateType($item)) {
            throw new \InvalidArgumentException();
        }

        $this->items[] = $item;
    }

    protected function validateType($item)
    {
        if ($this->isSingleType) {
            if ($this->classOrTypeName !== gettype($item)) {
                return false;
            }
        } else {
            if ($this->classOrTypeName !== get_class($item)) {
                return false;
            }
        }

        return true;
    }
}
