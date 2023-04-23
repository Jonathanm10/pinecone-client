<?php

namespace Jonathanm10\PineconeClient\DTO\Payload;

class VectorQueryPayload extends AbstractPayload
{
    public function __construct(
        public readonly string $topK,
        public readonly string $namespace = '',
        public readonly array $filter = [],
        public readonly bool $includeValues = false,
        public readonly bool $includeMetadata = false,
        public readonly array $vector = [],
        public readonly ?VectorSparseValuesPayload $sparseVector = null,
        public readonly ?string $id = null,
    ) {
    }
}
