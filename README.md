[![Codacy Badge](https://app.codacy.com/project/badge/Grade/6303a8b527924a539a6c321985f494c3)](https://www.codacy.com/gh/v-dem/queasy-type/dashboard?utm_source=github.com&amp;utm_medium=referral&amp;utm_content=v-dem/queasy-type&amp;utm_campaign=Badge_Grade)
[![Build Status](https://travis-ci.com/v-dem/queasy-type.svg?branch=master)](https://travis-ci.com/v-dem/queasy-type)
[![codecov](https://codecov.io/gh/v-dem/queasy-type/branch/master/graph/badge.svg)](https://codecov.io/gh/v-dem/queasy-type)
[![Total Downloads](https://poser.pugx.org/v-dem/queasy-type/downloads)](https://packagist.org/packages/v-dem/queasy-type)
[![License](https://poser.pugx.org/v-dem/queasy-type/license)](https://packagist.org/packages/v-dem/queasy-type)

# [QuEasy PHP Framework](https://github.com/v-dem/queasy-framework/) - Types

## Package `v-dem/queasy-type`

Classes supporting typed "arrays" to help keep code type-safe. For example, `IntArray`, not just `array`:

```php
function giveMeInts(IntArray $ints)
{
    ...
}
```

### Features

Classes allowing to use typed "arrays":

*   `TypedArray` - Base class, implements `ArrayAccess`, `Iterator` and `Countable`
*   `IntArray`
*   `StringArray`
*   `FloatArray`
*   `ResourceArray`
*   `ObjectArray`
*   `ArrayArray`

### Requirements

*   PHP version 5.3 or higher

### Installation

    composer require v-dem/queasy-type:master-dev

### Usage

For example, to create an array of integer values:

```php
$intArray = new queasy\type\IntArray([10, 20, 30]);

$intArray[] = 40;
$intArray['key'] = 50;

unset($intArray[0]); // Will remove value 10

foreach ($intArray as $key => $value) {
    echo $key . ' => ' . $value . PHP_EOL;
}

echo 'Elements count: ' . count($intArray) . PHP_EOL;

$intArray[] = 'wrong'; // Throws InvalidArgumentException
```

To create a specialized class representing array of users:

```php
class UsersArray extends TypedArray
{
    public function __construct(array $items = null)
    {
        parent::__construct(app\model\User::class, $items);
    }
}
```
