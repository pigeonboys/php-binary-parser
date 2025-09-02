<?php

namespace PigeonBoys\PhpBinaryParser\Tests\Integers;

use PHPUnit\Framework\TestCase;
use PigeonBoys\PhpBinaryParser\BinaryParser;

class Int24Test extends TestCase
{
    public function test_takeArray_int24_signed_big_endian()
    {
        $buffer = [0xFF, 0xFF, 0xFE, 0x00, 0x00, 0x01]; // -2, 1
        $parser = new BinaryParser($buffer);
        $array = $parser->int24()->signed()->bigEndian()->readMany(2);
        $this->assertEquals([-2, 1], $array);
    }

    public function test_takeArray_int24_signed_little_endian()
    {
        $buffer = [0xFE, 0xFF, 0xFF, 0x01, 0x00, 0x00]; // -2, 1
        $parser = new BinaryParser($buffer);
        $array = $parser->int24()->signed()->littleEndian()->readMany(2);
        $this->assertEquals([-2, 1], $array);
    }

    public function test_takeArray_int24_unsigned_big_endian()
    {
        $buffer = [0x00, 0x00, 0x01, 0x00, 0x00, 0x02]; // 1, 2
        $parser = new BinaryParser($buffer);
        $array = $parser->int24()->unsigned()->bigEndian()->readMany(2);
        $this->assertEquals([1, 2], $array);
    }

    public function test_takeArray_int24_unsigned_little_endian()
    {
        $buffer = [0x01, 0x00, 0x00, 0x02, 0x00, 0x00]; // 1, 2
        $parser = new BinaryParser($buffer);
        $array = $parser->int24()->unsigned()->littleEndian()->readMany(2);
        $this->assertEquals([1, 2], $array);
    }

    public function test_take_int24_signed_big_endian()
    {
        $buffer = [0xFF, 0xFF, 0xFE]; // -2
        $parser = new BinaryParser($buffer);
        $value = $parser->int24()->signed()->bigEndian()->read();
        $this->assertEquals(-2, $value);
    }

    public function test_take_int24_signed_little_endian()
    {
        $buffer = [0xFE, 0xFF, 0xFF]; // -2
        $parser = new BinaryParser($buffer);
        $value = $parser->int24()->signed()->littleEndian()->read();
        $this->assertEquals(-2, $value);
    }

    public function test_take_int24_unsigned_big_endian()
    {
        $buffer = [0x00, 0x12, 0x34]; // 0x001234 = 4660
        $parser = new BinaryParser($buffer);
        $value = $parser->int24()->unsigned()->bigEndian()->read();
        $this->assertEquals(0x1234, $value);
    }

    public function test_take_int24_unsigned_little_endian()
    {
        $buffer = [0x34, 0x12, 0x00]; // 0x001234 = 4660
        $parser = new BinaryParser($buffer);
        $value = $parser->int24()->unsigned()->littleEndian()->read();
        $this->assertEquals(0x1234, $value);
    }
}
