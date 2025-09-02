<?php

namespace PigeonBoys\PhpBinaryParser\Tests;

use PHPUnit\Framework\TestCase;
use PigeonBoys\PhpBinaryParser\BinaryParser;

class ReadBytesTest extends TestCase
{
    public function test_read_bytes()
    {
        $buffer = [0xFE, 0xFF, 0xFF, 0xFF, 0x01];
        $parser = new BinaryParser($buffer);
        $array = $parser->readBytes(2);
        $this->assertEquals([0xFE, 0xFF], $array);
        $array = $parser->readBytes(3);
        $this->assertEquals([0xFF, 0xFF, 0x01], $array);
    }
}
