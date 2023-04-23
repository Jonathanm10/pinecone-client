<?php

namespace Jonathanm10\PineconeClient\DTO\Payload;

class VectorPayload
{
    public function __construct(
        public readonly string $id,
        public readonly array $values,
        public readonly VectorSparseValuesPayload $sparseValues,
        public readonly array $metadata
    ) {
    }
}
