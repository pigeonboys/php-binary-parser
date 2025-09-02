<?php

namespace PigeonBoys\PhpBinaryParser\Tests\Integers;

use PHPUnit\Framework\TestCase;
use PigeonBoys\PhpBinaryParser\BinaryParser;

class Int8Test extends TestCase
{
    public function test_take_int8_array_signed()
    {
        $buffer = [0xFF, 0x01, 0x80]; // -1, 1, -128 in signed 8-bit
        $parser = new BinaryParser($buffer);
        $array = $parser->int8()->signed()->readMany(3);
        $this->assertEquals([-1, 1, -128], $array);
    }

    public function test_take_int8_array_unsigned()
    {
        $buffer = [0x01, 0x02, 0x03, 0x04, 0x05]; // 1, 2, 3, 4, 5 unsigned
        $parser = new BinaryParser($buffer);
        $array = $parser->int8()->unsigned()->readMany(5);
        $this->assertEquals([1, 2, 3, 4, 5], $array);
    }

    public function test_take_int8_signed()
    {
        $buffer = [0xFF]; // -1 in signed 8-bit
        $parser = new BinaryParser($buffer);
        $value = $parser->int8()->signed()->read();
        $this->assertEquals(-1, $value);
    }

    public function test_take_int8_unsigned()
    {
        $buffer = [0xFF]; // 255 unsigned
        $parser = new BinaryParser($buffer);
        $value = $parser->int8()->unsigned()->read();
        $this->assertEquals(255, $value);
    }
}
