<?php

namespace PigeonBoys\PhpBinaryParser\Exceptions;

use RuntimeException;

class EndiannessAlreadySetException extends RuntimeException implements BinaryParserException
{
    public function __construct()
    {
        parent::__construct("Endianness is already set. Call take() before changing endianness.");
    }
}
