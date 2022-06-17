<?php

/*
 * Queasy PHP Framework - Types - Tests
 *
 * (c) Vitaly Demyanenko <vitaly_demyanenko@yahoo.com>
 *
 * For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 */

namespace queasy\type\tests;

use queasy\type\IntArray;

use PHPUnit\Framework\TestCase;

class IntArrayTest extends TestCase
{
    public function testInt()
    {
        $array = new IntArray([2, 7, 1]);

        $this->assertCount(3, $array);

        $this->assertEquals(2, $array[0]);
        $this->assertEquals(7, $array[1]);
        $this->assertEquals(1, $array[2]);
    }

    public function testWrongValue()
    {
        $array = new IntArray([2, 7, 1]);

        $this->expectException(\InvalidArgumentException::class);

        $array[] = 'abcd';
    }
}

