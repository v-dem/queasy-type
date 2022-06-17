<?php

/*
 * Queasy PHP Framework - Types - Tests
 *
 * (c) Vitaly Demyanenko <vitaly_demyanenko@yahoo.com>
 *
 * For the full copyright and license information, please view the LICENSE file that was distributed with this source code.
 */

namespace queasy\type\tests;

use queasy\type\TypedArray;

use PHPUnit\Framework\TestCase;

class TypedArrayTest extends TestCase
{
    public function testInterfaces()
    {
        $array = new TypedArray('int');

        $this->assertInstanceOf(\Iterator::class, $array);
        $this->assertInstanceOf(\ArrayAccess::class, $array);
        $this->assertInstanceOf(\Countable::class, $array);

        $this->assertIsIterable($array);
    }

    public function testDataInConstructor()
    {
        $array = new TypedArray('int', [2, 7, 1]);

        $this->assertCount(3, $array);

        $this->assertEquals(2, $array[0]);
        $this->assertEquals(7, $array[1]);
        $this->assertEquals(1, $array[2]);
    }

    public function testDataAppended()
    {
        $array = new TypedArray('string');

        $array[] = 'abcd';
        $array[] = 'efgh';
        $array[] = 'ijkl';

        $this->assertCount(3, $array);

        $this->assertEquals('abcd', $array[0]);
        $this->assertEquals('efgh', $array[1]);
        $this->assertEquals('ijkl', $array[2]);
    }

    public function testChangeItem()
    {
        $array = new TypedArray('string');

        $array[] = 'abcd';
        $array[] = 'efgh';
        $array[] = 'ijkl';

        $this->assertCount(3, $array);

        $array[1] = 'zzz';

        $this->assertEquals('abcd', $array[0]);
        $this->assertEquals('zzz', $array[1]);
        $this->assertEquals('ijkl', $array[2]);
    }

    public function testChangeItemWrongType()
    {
        $array = new TypedArray('string');

        $array[] = 'abcd';
        $array[] = 'efgh';
        $array[] = 'ijkl';

        $this->expectException(\InvalidArgumentException::class);

        $array[1] = 17;

        $this->assertEquals('abcd', $array[0]);
        $this->assertEquals('zzz', $array[1]);
        $this->assertEquals('ijkl', $array[2]);
    }

    public function testUnset()
    {
        $array = new TypedArray('string');

        $array[] = 'abcd';
        $array[] = 'efgh';
        $array[] = 'ijkl';

        unset($array[1]);

        $this->assertCount(2, $array);

        $this->assertEquals('abcd', $array[0]);
        $this->assertEquals('ijkl', $array[2]);
    }

    public function testBool()
    {
        $array = new TypedArray('bool');

        $array[] = true;
        $array[] = false;

        $this->assertCount(2, $array);

        $this->assertTrue($array[0]);
        $this->assertFalse($array[1]);
    }

    public function testFloat()
    {
        $array = new TypedArray('float');

        $array[] = 1.2;
        $array[] = 7.5;

        $this->assertCount(2, $array);

        $this->assertEquals(1.2, $array[0]);
        $this->assertEquals(7.5, $array[1]);
    }

    public function testForeach()
    {
        $array = new TypedArray('string');

        $array[] = 'abcd';
        $array[] = 'efgh';
        $array[] = 'ijkl';

        $realArray = [];
        foreach ($array as $key => $value) {
            $realArray[$key] = $value;
        }

        $this->assertCount(3, $realArray);

        $this->assertEquals('abcd', $realArray[0]);
        $this->assertEquals('efgh', $realArray[1]);
        $this->assertEquals('ijkl', $realArray[2]);
    }

    public function testInvalidValueType()
    {
        $array = new TypedArray('string');

        $array[] = 'abcd';
        $array[] = 'efgh';

        $this->expectException(\InvalidArgumentException::class);

        $array[] = 2;
    }

    public function testWrongOffset()
    {
        $array = new TypedArray('string');

        $array[] = 'abcd';
        $array[] = 'efgh';

        $this->assertNull($array[10]);
    }

    public function testToArray()
    {
        $array = new TypedArray('string');

        $array[] = 'abcd';
        $array[] = 'efgh';

        $realArray = $array->toArray();

        $this->assertCount(2, $realArray);

        $this->assertEquals('abcd', $realArray[0]);
        $this->assertEquals('efgh', $realArray[1]);
    }
}

