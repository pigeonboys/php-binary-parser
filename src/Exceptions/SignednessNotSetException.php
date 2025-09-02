<?php

namespace PigeonBoys\PhpBinaryParser\Exceptions;

use RuntimeException;

class SignednessNotSetException extends RuntimeException implements BinaryParserException
{
    public function __construct()
    {
        parent::__construct("Signedness must not be null. Did you forget to call signed()/unsigned() ?");
    }
}
