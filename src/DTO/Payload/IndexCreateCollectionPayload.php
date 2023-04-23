<?php

namespace Jonathanm10\PineconeClient\DTO\Payload;

class IndexCreateCollectionPayload extends AbstractPayload
{
    public function __construct(public readonly string $name, public readonly string $source)
    {
    }
}
