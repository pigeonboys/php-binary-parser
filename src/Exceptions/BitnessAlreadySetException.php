<?php

namespace PigeonBoys\PhpBinaryParser\Exceptions;

use RuntimeException;

class BitnessAlreadySetException extends RuntimeException implements BinaryParserException
{
    public function __construct()
    {
        parent::__construct("Bitness is already set. Call take() before changing bitness.");
    }
}
