<?php

namespace Jonathanm10\PineconeClient\DTO\Response;

use JsonException;

class VectorQueryResponse
{
    public function __construct(public readonly array $matches, public readonly string $namespace)
    {
    }

    /**
     * @throws JsonException
     */
    public static function fromString(string $data): self
    {
        $data = json_decode($data, true, 512, JSON_THROW_ON_ERROR);

        $matches = array_map(static fn ($matchData) => new VectorMatchData(
            $matchData['id'],
            $matchData['score'],
            $matchData['values'],
            VectorSparseValuesData::fromArray($matchData['sparseValues'] ?? []),
            $matchData['metadata'] ?? []
        ), $data['matches']);

        return new self($matches, $data['namespace']);
    }
}
