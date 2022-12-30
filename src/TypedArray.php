<?php

namespace queasy\type;

use InvalidArgumentException;

class TypedArray implements \Iterator, \ArrayAccess, \Countable
{
    const SINGLE_TYPES = array('int', 'integer', 'bool', 'boolean', 'float', 'double', 'string', 'array', 'object', 'resource');

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
        // Workaround
        switch ($classOrTypeName) {
            case 'int':
                $classOrTypeName = 'integer';
                break;

            case 'bool':
                $classOrTypeName = 'boolean';
                break;

            case 'float':
                $classOrTypeName = 'double';
                break;
        }

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
        if (null === $offset) {
            $this->append($item);

            return;
        }

        $this->validateType($item);

        $this->items[$offset] = $item;
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
        $result = '';
        foreach ($this->items as $key => $value) {
            $result .= $key . ': ' . (string) $value . PHP_EOL;
        }

        return $result;
    }

    public function toArray()
    {
        return $this->items;
    }

    public function append($item)
    {
        $this->validateType($item);

        $this->items[] = $item;
    }

    protected function validateType($item)
    {
        if ($this->isSingleType) {
            $type = gettype($item);
            if ($this->classOrTypeName !== $type) {
                throw new \InvalidArgumentException(sprintf('Wrong argument type "%s". Argument of type "%s" expected.', $type, $this->classOrTypeName));
            }

            return true;
        }

        if (!is_object($item)) {
            throw new \InvalidArgumentException(sprintf('Wrong argument. Object of class "%s" expected.', $this->classOrTypeName));
        }

        if ($item instanceof $this->classOrTypeName) {
            throw new \InvalidArgumentException(sprintf('Wrong argument class "%s". Object of class "%s" expected.', get_class($item), $this->classOrTypeName));
        }

        return true;
    }
}

