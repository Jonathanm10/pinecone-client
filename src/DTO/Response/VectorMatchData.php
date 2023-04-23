<?php

namespace Jonathanm10\PineconeClient\DTO\Response;

class VectorMatchData
{
    public function __construct(
        public readonly string $id,
        public readonly float $score,
        public readonly array $values,
        public readonly VectorSparseValuesData $sparseValues,
        public readonly array $metadata
    ) {
    }
}
