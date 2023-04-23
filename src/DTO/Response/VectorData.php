<?php

namespace Jonathanm10\PineconeClient\DTO\Response;

class VectorData
{
    public function __construct(
        public readonly string $id,
        public readonly array $values,
        public readonly VectorSparseValuesData $sparseValues,
        public readonly array $metadata
    ) {
    }
}
