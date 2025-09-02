<?php

namespace PigeonBoys\PhpBinaryParser\Exceptions;

use RuntimeException;

class CurrentBufferUnderflowException extends RuntimeException implements BinaryParserException
{
    public function __construct()
    {
        parent::__construct("Not enough bytes in buffer.");
    }
}
