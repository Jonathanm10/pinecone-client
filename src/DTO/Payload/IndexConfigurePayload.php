<?php

namespace Jonathanm10\PineconeClient\DTO\Payload;

class IndexConfigurePayload extends AbstractPayload
{
    public function __construct(
        public readonly int $replicas = 1,
        public readonly string $podType = 'p1.x1'
    ) {
    }

    public function toArray(): array
    {
        return [
            'replicas' => $this->replicas,
            'pod_type' => $this->podType,
        ];
    }
}
