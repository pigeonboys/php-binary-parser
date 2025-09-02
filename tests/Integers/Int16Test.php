<?php

namespace PigeonBoys\PhpBinaryParser\Tests\Integers;

use PHPUnit\Framework\TestCase;
use PigeonBoys\PhpBinaryParser\BinaryParser;

class Int16Test extends TestCase
{
    public function test_takeArray_int16_signed_big_endian()
    {
        $buffer = [0xFF, 0xFF, 0x80, 0x00]; // -1, -32768 big-endian
        $parser = new BinaryParser($buffer);
        $array = $parser->int16()->signed()->bigEndian()->readMany(2);
        $this->assertEquals([-1, -32768], $array);
    }

    public function test_takeArray_int16_signed_little_endian()
    {
        $buffer = [0xFF, 0xFF, 0x00, 0x80]; // -1, -32768 little-endian
        $parser = new BinaryParser($buffer);
        $array = $parser->int16()->signed()->littleEndian()->readMany(2);
        $this->assertEquals([-1, -32768], $array);
    }

    public function test_takeArray_int16_unsigned_big_endian()
    {
        $buffer = [0x00, 0x01, 0x00, 0x02]; // 1, 2 big-endian
        $parser = new BinaryParser($buffer);
        $array = $parser->int16()->unsigned()->bigEndian()->readMany(2);
        $this->assertEquals([1, 2], $array);
    }

    public function test_takeArray_int16_unsigned_little_endian()
    {
        $buffer = [0x01, 0x00, 0x02, 0x00]; // 1, 2 little-endian
        $parser = new BinaryParser($buffer);
        $array = $parser->int16()->unsigned()->littleEndian()->readMany(2);
        $this->assertEquals([1, 2], $array);
    }

    public function test_take_int16_signed_big_endian()
    {
        $buffer = [0xFF, 0xFE]; // -2 in signed 16-bit big-endian
        $parser = new BinaryParser($buffer);
        $value = $parser->int16()->signed()->bigEndian()->read();
        $this->assertEquals(-2, $value);
    }

    public function test_take_int16_signed_little_endian()
    {
        $buffer = [0xFE, 0xFF]; // -2 in signed 16-bit little-endian
        $parser = new BinaryParser($buffer);
        $value = $parser->int16()->signed()->littleEndian()->read();
        $this->assertEquals(-2, $value);
    }

    public function test_take_int16_unsigned_big_endian()
    {
        $buffer = [0x12, 0x34]; // Big-endian: 0x1234 = 4660
        $parser = new BinaryParser($buffer);
        $value = $parser->int16()->unsigned()->bigEndian()->read();
        $this->assertEquals(0x1234, $value);
    }

    public function test_take_int16_unsigned_little_endian()
    {
        $buffer = [0x34, 0x12]; // Little-endian: 0x1234 = 4660
        $parser = new BinaryParser($buffer);
        $value = $parser->int16()->unsigned()->littleEndian()->read();
        $this->assertEquals(0x1234, $value);
    }
}
