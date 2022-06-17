<?php

/*
 * Queasy PHP Framework - Types - Tests
 *
 * (c) Vitaly Demyanenko <vitaly_demyanenko@yahoo.com>
 *
 * For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 */

namespace queasy\type\tests;

use queasy\type\FloatArray;

use PHPUnit\Framework\TestCase;

class FloatArrayTest extends TestCase
{
    public function testFloat()
    {
        $array = new FloatArray([2.1, 7.2, 1.3]);

        $this->assertCount(3, $array);

        $this->assertEquals(2.1, $array[0]);
        $this->assertEquals(7.2, $array[1]);
        $this->assertEquals(1.3, $array[2]);
    }

    public function testWrongValue()
    {
        $array = new FloatArray([2.1, 7.2, 1.3]);

        $this->expectException(\InvalidArgumentException::class);

        $array[] = 'abcd';
    }
}

