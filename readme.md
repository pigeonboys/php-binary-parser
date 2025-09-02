# PhpBinaryParser

A lightweight PHP library for parsing binary data from byte arrays. Supports signed and unsigned integers, arrays, and endian-aware formats (big/little endian). Ideal for reading hardware data streams, binary protocols, or any low-level byte-oriented data.

## Features

- Supports 8, 16, 24, 32, and 64-bit integers
- Signed and unsigned parsing
- Little-endian and big-endian support
- **Bytes are consumed from the buffer after each read**
- Multi-read support (`readMany()`)
- Resettable buffer with `resetBuffer()`
- Type-safe with meaningful exceptions

## Installation

You can install via Composer:

```bash
composer require pigeonboys/php-binary-parser
```

PHP version 8.0+ is required.

## Usage

### Basic Usage

```php
use PigeonBoys\PhpBinaryParser\BinaryParser;

$buffer = [0x12, 0x34, 0x56, 0x78];
$parser = new BinaryParser($buffer);

// Read an unsigned 16-bit integer in big-endian
$value = $parser->int16()->unsigned()->bigEndian()->read();
echo $value; // 4660

// After this read, the first two bytes are removed from the buffer
echo $parser->bytesRemaining(); // 2
```

### Reading Multiple Values

```php
$parser = new BinaryParser([0x01, 0x02, 0x03, 0x04]);

// Read two unsigned 8-bit integers
$values = $parser->int8()->unsigned()->readMany(2);
print_r($values); // [1, 2]

// Only remaining bytes are left in the buffer
echo $parser->bytesRemaining(); // 2
```

### Resetting Buffer

```php
$parser->resetBuffer(); // restores all original bytes
```

## Methods

- `int8()`, `int16()`, `int24()`, `int32()`, `int64()` — _Set the bitness_
- `signed()`, `unsigned()` — _Set the signedness_
- `littleEndian()`, `bigEndian()` — _Set the endianness_
- `read()` — _Read a single value and consume bytes from the buffer_
- `readMany(int $count)` — _Read multiple values and consume bytes from the buffer_
- `resetBuffer()` — _Reset buffer to original content_
- `bytesRemaining()` — _Get the number of bytes left_

## Exceptions

- `BitnessAlreadySetException` — _Thrown if you try to set the bitness more than once before reading._
- `EndiannessAlreadySetException` — _Thrown if you try to set the endianness more than once before reading._
- `SignednessAlreadySetException` — _Thrown if you try to set signedness more than once before reading._
- `BitnessNotSetException` — _Thrown if you attempt to read an integer without first specifying the bitness._
- `EndiannessNotSetException` — _Thrown if you attempt to read a multi-byte integer without specifying endianness (except 8-bit)._
- `SignednessNotSetException` — _Thrown if you attempt to read an integer without specifying signed or unsigned._
- `InvalidLengthException` — _Thrown if the number of bytes requested for `readBytes()` is less than 1._
- `InvalidCountException` — _Thrown if `readMany()` is called with a count less than 1._
- `CurrentBufferUnderflowException` — _Thrown if there are not enough bytes left in the buffer to satisfy a read._
