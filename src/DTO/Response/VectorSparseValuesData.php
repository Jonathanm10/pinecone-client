<?php

namespace Jonathanm10\PineconeClient\DTO\Response;

class VectorSparseValuesData
{
    public function __construct(
        public readonly array $indices,
        public readonly array $values
    ) {
    }

    public static function fromArray(array $sparseValues): self
    {
        if (empty($sparseValues)) {
            return new self([], []);
        }

        return new self($sparseValues['indices'], $sparseValues['values']);
    }
}
