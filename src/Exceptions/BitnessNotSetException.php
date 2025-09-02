<?php

namespace PigeonBoys\PhpBinaryParser\Exceptions;

use RuntimeException;

class BitnessNotSetException extends RuntimeException implements BinaryParserException
{
    public function __construct()
    {
        parent::__construct("Bitness must not be null. Did you forget to call int8()/int16()/... ?");
    }
}
