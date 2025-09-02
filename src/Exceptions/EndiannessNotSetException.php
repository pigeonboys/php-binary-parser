<?php

namespace PigeonBoys\PhpBinaryParser\Exceptions;

use RuntimeException;

class EndiannessNotSetException extends RuntimeException implements BinaryParserException
{
    public function __construct()
    {
        parent::__construct("Endianness must not be null. Did you forget to call littleEndianness()/bigEndianness() ?");
    }
}
