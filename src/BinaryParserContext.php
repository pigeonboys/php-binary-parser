<?php

namespace PigeonBoys\PhpBinaryParser;

abstract class BinaryParserContext
{
    private array $sourceBuffer;
    private array $currentBuffer;
    private ?Enums\Bitness $bitness;
    private ?Enums\Endianness $endianness;
    private ?Enums\Signedness $signedness;

    public function __construct(array $buffer)
    {
        $this->sourceBuffer = $buffer;
        $this->currentBuffer = $buffer;

        $this->setDefaults();
    }

    protected function setDefaults(): void
    {
        $this->bitness = null;
        $this->endianness = null;
        $this->signedness = null;
    }

    protected function setBitness(Enums\Bitness $bitness)
    {
        if ($this->bitness !== null) {
            throw new Exceptions\BitnessAlreadySetException();
        }

        $this->bitness = $bitness;
    }

    protected function setEndianness(Enums\Endianness $endianness)
    {
        if ($this->endianness !== null) {
            throw new Exceptions\EndiannessAlreadySetException();
        }

        $this->endianness = $endianness;
    }

    protected function setSignedness(Enums\Signedness $signedness)
    {
        if ($this->signedness !== null) {
            throw new Exceptions\SignednessAlreadySetException();
        }

        $this->signedness = $signedness;
    }

    public function resetBuffer()
    {
        $this->currentBuffer = $this->sourceBuffer;
    }

    public function bytesRemaining(): int
    {
        return count($this->currentBuffer);
    }

    public function readBytes(int $length): array
    {
        if ($length < 1) {
            throw new Exceptions\InvalidLengthException();
        }

        $availableBytes = count($this->currentBuffer);

        if ($availableBytes < $length) {
            throw new Exceptions\CurrentBufferUnderflowException();
        }

        return array_splice($this->currentBuffer, 0, $length);
    }

    public function read(): int|float
    {
        $retVal = $this->readInteger();
        $this->setDefaults();
        return $retVal;
    }

    public function readMany(int $count): array
    {
        if ($count < 1) {
            throw new Exceptions\InvalidCountException();
        }

        $retVal = array_map(fn () => $this->readInteger(), range(1, $count));
        $this->setDefaults();
        return $retVal;
    }

    protected function readInteger(): int|float
    {
        if ($this->bitness === null) {
            throw new Exceptions\BitnessNotSetException();
        }

        $skipEndianessCheck = match ($this->bitness) {
            Enums\Bitness::BITS_8 => true,
            default => false,
        };

        if ($this->endianness === null && !$skipEndianessCheck) {
            throw new Exceptions\EndiannessNotSetException();
        }

        if ($this->signedness === null) {
            throw new Exceptions\SignednessNotSetException();
        }

        $bytesRequired = $this->bitness->value / 8;
        $availableBytes = count($this->currentBuffer);

        if ($availableBytes < $bytesRequired) {
            throw new Exceptions\CurrentBufferUnderflowException();
        }

        $bytes = array_splice($this->currentBuffer, 0, $bytesRequired);

        if ($this->endianness === Enums\Endianness::BIG) {
            $bytes = array_reverse($bytes);
        }

        $value = 0;

        for ($i = 0; $i < count($bytes); $i++) {
            $value |= $bytes[$i] << ($i * 8);
        }

        if ($this->signedness === Enums\Signedness::SIGNED) {
            $maxUnsigned = 1 << $this->bitness->value;
            $maxSigned = 1 << ($this->bitness->value - 1);

            if ($value >= $maxSigned) {
                $value -= $maxUnsigned;
            }
        }

        if ($this->bitness === Enums\Bitness::BITS_64 && PHP_INT_SIZE < 8) {
            return (float)$value;
        }

        return $value;
    }
}
