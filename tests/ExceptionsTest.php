<?php

namespace PigeonBoys\PhpBinaryParser\Tests;

use PHPUnit\Framework\TestCase;
use PigeonBoys\PhpBinaryParser\BinaryParser;
use PigeonBoys\PhpBinaryParser\Exceptions;

class ExceptionsTest extends TestCase
{
    public function test_exception_thrown_if_current_buffer_underflows()
    {
        $this->expectException(Exceptions\CurrentBufferUnderflowException::class);

        $buffer = [0xFF, 0xFF];
        $parser = new BinaryParser($buffer);
        $parser->int16()->unsigned()->littleEndian()->read();
        $parser->int16()->unsigned()->littleEndian()->read();
    }

    public function test_exception_thrown_if_bitness_is_not_set()
    {
        $this->expectException(Exceptions\BitnessNotSetException::class);

        $buffer = [0xFF, 0xFF];
        $parser = new BinaryParser($buffer);
        $parser->unsigned()->read();
    }

    public function test_exception_thrown_if_endianess_is_not_set()
    {
        $this->expectException(Exceptions\EndiannessNotSetException::class);

        $buffer = [0xFF, 0xFF];
        $parser = new BinaryParser($buffer);
        $parser->int16()->unsigned()->read();
    }

    public function test_exception_thrown_if_signedness_is_not_set()
    {
        $this->expectException(Exceptions\SignednessNotSetException::class);

        $buffer = [0xFF, 0xFF];
        $parser = new BinaryParser($buffer);
        $parser->int16()->littleEndian()->read();
    }

    public function test_exception_thrown_if_bitness_is_already_set()
    {
        $this->expectException(Exceptions\BitnessAlreadySetException::class);

        $buffer = [0xFF, 0xFF];
        $parser = new BinaryParser($buffer);
        $parser->int16()->unsigned()->littleEndian()->int8()->read();
    }

    public function test_exception_thrown_if_count_is_less_then_one()
    {
        $this->expectException(Exceptions\InvalidCountException::class);

        $buffer = [0x01, 0x02, 0x03, 0x04, 0x05]; // 1, 2, 3, 4, 5 unsigned
        $parser = new BinaryParser($buffer);
        $array = $parser->int8()->unsigned()->readMany(0);
    }

    public function test_exception_thrown_if_length_is_less_then_one()
    {
        $this->expectException(Exceptions\InvalidLengthException::class);

        $buffer = [0xFF, 0xFF];
        $parser = new BinaryParser($buffer);
        $parser->readBytes(0);
    }

    public function test_exception_thrown_if_endianess_is_already_set()
    {
        $this->expectException(Exceptions\EndiannessAlreadySetException::class);

        $buffer = [0xFF, 0xFF];
        $parser = new BinaryParser($buffer);
        $parser->int16()->unsigned()->littleEndian()->bigEndian()->read();
    }

    public function test_exception_thrown_if_signedness_is_already_set()
    {
        $this->expectException(Exceptions\SignednessAlreadySetException::class);

        $buffer = [0xFF, 0xFF];
        $parser = new BinaryParser($buffer);
        $parser->int16()->unsigned()->littleEndian()->signed()->read();
    }
}
