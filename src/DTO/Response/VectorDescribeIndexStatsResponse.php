<?php

namespace Jonathanm10\PineconeClient\DTO\Response;

use JsonException;

class VectorDescribeIndexStatsResponse
{
    public function __construct(
        public readonly array $namespaces,
        public readonly int $dimension,
        public readonly float $indexFullness,
        public readonly int $totalVectorCount
    ) {
    }

    /**
     * @throws JsonException
     */
    public static function fromString(string $data): self
    {
        $data = json_decode($data, true, 512, JSON_THROW_ON_ERROR);

        $namespaces = [];
        foreach ($data['namespaces'] as $namespaceName => $namespaceData) {
            $namespaces[$namespaceName] = new VectorNamespaceSummaryData(
                $namespaceData['vectorCount']
            );
        }

        return new self(
            $namespaces,
            $data['dimension'],
            $data['indexFullness'],
            $data['totalVectorCount']
        );
    }
}
