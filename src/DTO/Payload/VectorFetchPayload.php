<?php

namespace Jonathanm10\PineconeClient\DTO\Payload;

class VectorFetchPayload extends AbstractPayload
{
    public function __construct(public readonly array $ids = [], public readonly string $namespace = '')
    {
    }
}
