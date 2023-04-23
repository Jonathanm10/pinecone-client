<?php

namespace Jonathanm10\PineconeClient\DTO\Response;

use JsonException;

class IndexCollectionsListResponse
{
    public function __construct(public readonly array $collections)
    {
    }

    /**
     * @throws JsonException
     */
    public static function fromArray(string $data): self
    {
        return new self(json_decode($data, true, 512, JSON_THROW_ON_ERROR));
    }

    public function toArray(): array
    {
        return ['collections' => $this->collections];
    }
}
