<?php

namespace Jonathanm10\PineconeClient\DTO\Payload;

class VectorSparseValuesPayload extends AbstractPayload
{
    public function __construct(
        public readonly array $indices,
        public readonly array $values,
    ) {
    }
}
