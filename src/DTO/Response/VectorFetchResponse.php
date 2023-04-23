<?php

namespace Jonathanm10\PineconeClient\DTO\Response;

use JsonException;

class VectorFetchResponse
{
    public function __construct(
        public readonly array $vectors,
        public readonly string $namespace
    ) {
    }

    /**
     * @throws JsonException
     */
    public static function fromString(string $data): self
    {
        $data = json_decode($data, true, 512, JSON_THROW_ON_ERROR);

        $vectors = [];
        foreach ($data['vectors'] as $vectorName => $vectorData) {
            $vectors[$vectorName] = new VectorData(
                $vectorData['id'],
                $vectorData['values'],
                VectorSparseValuesData::fromArray($vectorData['sparseValues'] ?? []),
                $vectorData['metadata'] ?? []
            );
        }

        return new self($vectors, $data['namespace']);
    }
}
