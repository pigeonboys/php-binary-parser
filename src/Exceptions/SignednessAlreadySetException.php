<?php

namespace PigeonBoys\PhpBinaryParser\Exceptions;

use RuntimeException;

class SignednessAlreadySetException extends RuntimeException implements BinaryParserException
{
    public function __construct()
    {
        parent::__construct("Signedness is already set. Call take() before changing signedness.");
    }
}
