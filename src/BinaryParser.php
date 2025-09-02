<?php

namespace PigeonBoys\PhpBinaryParser;

class BinaryParser extends BinaryParserContext
{
    public function int8(): self
    {
        $this->setBitness(Enums\Bitness::BITS_8);
        return $this;
    }

    public function int16(): self
    {
        $this->setBitness(Enums\Bitness::BITS_16);
        return $this;
    }

    public function int24(): self
    {
        $this->setBitness(Enums\Bitness::BITS_24);
        return $this;
    }

    public function int32(): self
    {
        $this->setBitness(Enums\Bitness::BITS_32);
        return $this;
    }

    public function int64(): self
    {
        $this->setBitness(Enums\Bitness::BITS_64);
        return $this;
    }

    public function signed(): self
    {
        $this->setSignedness(Enums\Signedness::SIGNED);
        return $this;
    }

    public function unsigned(): self
    {
        $this->setSignedness(Enums\Signedness::UNSIGNED);
        return $this;
    }

    public function littleEndian(): self
    {
        $this->setEndianness(Enums\Endianness::LITTLE);
        return $this;
    }

    public function bigEndian(): self
    {
        $this->setEndianness(Enums\Endianness::BIG);
        return $this;
    }
}
