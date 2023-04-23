<?php

namespace Jonathanm10\PineconeClient\DTO\Payload;

class VectorDeletePayload extends AbstractPayload
{
    public function __construct(
            public readonly array $ids = [],
            public readonly bool $deleteAll = false,
            public readonly string $namespace = '',
            public readonly array $filter = []
    ) {
    }
}
