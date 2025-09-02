<?php

namespace PigeonBoys\PhpBinaryParser\Exceptions;

use RuntimeException;

class InvalidCountException extends RuntimeException implements BinaryParserException
{
    public function __construct()
    {
        parent::__construct("Count must be greater than 0.");
    }
}
