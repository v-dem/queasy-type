<?php

/*
 * Queasy PHP Framework - Types - Tests
 *
 * (c) Vitaly Demyanenko <vitaly_demyanenko@yahoo.com>
 *
 * For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 */

namespace queasy\type\tests;

use queasy\type\ArrayArray;

use PHPUnit\Framework\TestCase;

class ArrayArrayTest extends TestCase
{
    public function testArray()
    {
        $array = new ArrayArray([[4]]);

        $this->assertCount(1, $array);

        $this->assertIsArray($array[0]);
        $this->assertCount(1, $array[0]);
        $this->assertEquals(4, $array[0][0]);
    }

    public function testWrongValue()
    {
        $array = new ArrayArray([[4]]);

        $this->expectException(\InvalidArgumentException::class);

        $array[] = 'abcd';
    }
}

