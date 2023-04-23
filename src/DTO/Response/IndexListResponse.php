<?php

namespace Jonathanm10\PineconeClient\DTO\Response;

use JsonException;

class IndexListResponse
{
    public function __construct(public readonly array $indexes)
    {
    }

    /**
     * @throws JsonException
     */
    public static function fromString(string $data): self
    {
        return new self(json_decode($data, true, 512, JSON_THROW_ON_ERROR));
    }
}
