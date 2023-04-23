<?php

namespace Jonathanm10\PineconeClient\DTO\Payload;

use Jonathanm10\PineconeClient\Attributes\TypedArray;

class VectorUpsertPayload extends AbstractPayload
{
    public function __construct(
        #[TypedArray(VectorPayload::class)]
        public readonly array $vectors,
        public readonly string $namespace = '',
    ) {
    }
}
