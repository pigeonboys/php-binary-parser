<?php

namespace PigeonBoys\PhpBinaryParser\Tests\Integers;

use PHPUnit\Framework\TestCase;
use PigeonBoys\PhpBinaryParser\BinaryParser;

class Int32Test extends TestCase
{
    public function test_takeArray_int32_signed_big_endian()
    {
        $buffer = [0xFF, 0xFF, 0xFF, 0xFE, 0x00, 0x00, 0x00, 0x01]; // -2, 1
        $parser = new BinaryParser($buffer);
        $array = $parser->int32()->signed()->bigEndian()->readMany(2);
        $this->assertEquals([-2, 1], $array);
    }

    public function test_takeArray_int32_signed_little_endian()
    {
        $buffer = [0xFE, 0xFF, 0xFF, 0xFF, 0x01, 0x00, 0x00, 0x00]; // -2, 1
        $parser = new BinaryParser($buffer);
        $array = $parser->int32()->signed()->littleEndian()->readMany(2);
        $this->assertEquals([-2, 1], $array);
    }

    public function test_takeArray_int32_unsigned_big_endian()
    {
        $buffer = [0x00, 0x00, 0x00, 0x01, 0x00, 0x00, 0x00, 0x02]; // 1, 2
        $parser = new BinaryParser($buffer);
        $array = $parser->int32()->unsigned()->bigEndian()->readMany(2);
        $this->assertEquals([1, 2], $array);
    }

    public function test_takeArray_int32_unsigned_little_endian()
    {
        $buffer = [0x01, 0x00, 0x00, 0x00, 0x02, 0x00, 0x00, 0x00]; // 1, 2
        $parser = new BinaryParser($buffer);
        $array = $parser->int32()->unsigned()->littleEndian()->readMany(2);
        $this->assertEquals([1, 2], $array);
    }

    public function test_take_int32_signed_big_endian()
    {
        $buffer = [0xFF, 0xFF, 0xFF, 0xFE]; // -2
        $parser = new BinaryParser($buffer);
        $value = $parser->int32()->signed()->bigEndian()->read();
        $this->assertEquals(-2, $value);
    }

    public function test_take_int32_signed_little_endian()
    {
        $buffer = [0xFE, 0xFF, 0xFF, 0xFF]; // -2
        $parser = new BinaryParser($buffer);
        $value = $parser->int32()->signed()->littleEndian()->read();
        $this->assertEquals(-2, $value);
    }

    public function test_take_int32_unsigned_big_endian()
    {
        $buffer = [0x00, 0x00, 0x01, 0x00]; // 256
        $parser = new BinaryParser($buffer);
        $value = $parser->int32()->unsigned()->bigEndian()->read();
        $this->assertEquals(256, $value);
    }

    public function test_take_int32_unsigned_little_endian()
    {
        $buffer = [0x00, 0x01, 0x00, 0x00]; // 256
        $parser = new BinaryParser($buffer);
        $value = $parser->int32()->unsigned()->littleEndian()->read();
        $this->assertEquals(256, $value);
    }
}
