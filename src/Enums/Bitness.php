<?php

namespace PigeonBoys\PhpBinaryParser\Enums;

enum Bitness: int
{
    case BITS_8 = 8;
    case BITS_16 = 16;
    case BITS_24 = 24;
    case BITS_32 = 32;
    case BITS_64 = 64;
}
