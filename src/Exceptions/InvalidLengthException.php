<?php

namespace PigeonBoys\PhpBinaryParser\Exceptions;

use RuntimeException;

class InvalidLengthException extends RuntimeException implements BinaryParserException
{
    public function __construct()
    {
        parent::__construct("Length must be greater than 0.");
    }
}
