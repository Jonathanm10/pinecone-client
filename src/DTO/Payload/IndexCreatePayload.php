<?php

namespace Jonathanm10\PineconeClient\DTO\Payload;

class IndexCreatePayload extends AbstractPayload
{
    public function __construct(
        public readonly string $name,
        public readonly int $dimension,
        public readonly string $metric = 'cosine',
        public readonly int $pods = 1,
        public readonly int $replicas = 1,
        public readonly string $podType = 'p1.x1'
    ) {
    }
}
