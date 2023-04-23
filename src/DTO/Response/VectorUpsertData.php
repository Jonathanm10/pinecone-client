<?php

namespace Jonathanm10\PineconeClient\DTO\Response;

use JsonException;

class VectorUpsertData
{
    public function __construct(public readonly int $upsertedCount)
    {
    }

    /**
     * @throws JsonException
     */
    public static function fromString(string $data): self
    {
        $data = json_decode($data, true, 512, JSON_THROW_ON_ERROR);

        return new self($data['upsertedCount']);
    }
}
