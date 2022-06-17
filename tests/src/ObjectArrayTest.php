<?php

/*
 * Queasy PHP Framework - Types - Tests
 *
 * (c) Vitaly Demyanenko <vitaly_demyanenko@yahoo.com>
 *
 * For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 */

namespace queasy\type\tests;

use queasy\type\ObjectArray;

use PHPUnit\Framework\TestCase;

class ObjectArrayTest extends TestCase
{
    public function testObject()
    {
        $array = new ObjectArray([new \stdClass()]);

        $this->assertCount(1, $array);

        $this->assertIsObject($array[0]);
    }

    public function testWrongValue()
    {
        $array = new ObjectArray([new \stdClass()]);

        $this->expectException(\InvalidArgumentException::class);

        $array[] = 'abcd';
    }
}

