<?php

/*
 * Queasy PHP Framework - Types - Tests
 *
 * (c) Vitaly Demyanenko <vitaly_demyanenko@yahoo.com>
 *
 * For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 */

namespace queasy\type\tests;

use queasy\type\StringArray;

use PHPUnit\Framework\TestCase;

class StringArrayTest extends TestCase
{
    public function testString()
    {
        $array = new StringArray(['abcd']);

        $this->assertCount(1, $array);

        $this->assertEquals('abcd', $array[0]);
    }

    public function testWrongValue()
    {
        $array = new StringArray(['abcd']);

        $this->expectException(\InvalidArgumentException::class);

        $array[] = 5;
    }
}

