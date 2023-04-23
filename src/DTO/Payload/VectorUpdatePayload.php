<?php

namespace Jonathanm10\PineconeClient\DTO\Payload;

class VectorUpdatePayload extends AbstractPayload
{
    public function __construct(
        public readonly string $id,
        public readonly array $values,
        public readonly ?VectorSparseValuesPayload $sparseValues = null,
        public readonly array $setMetadata = [],
        public readonly string $namespace = '',
    ) {
    }
}
