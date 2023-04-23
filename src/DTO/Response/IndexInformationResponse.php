<?php

namespace Jonathanm10\PineconeClient\DTO\Response;

use JsonException;

class IndexInformationResponse
{
    public function __construct(
        public readonly string $name,
        public readonly string $dimension,
        public readonly string $metric,
        public readonly int $pods,
        public readonly int $replicas,
        public readonly int $shards,
        public readonly string $podType,
        public readonly array $indexConfig,
        public readonly array $metadataConfig,
        public readonly array $status,
    ) {
    }

    /**
     * @throws JsonException
     */
    public static function fromString(string $data): self
    {
        $data = json_decode($data, true, 512, JSON_THROW_ON_ERROR);

        return new self(
            $data['name'],
            $data['dimension'],
            $data['metric'],
            $data['pods'],
            $data['replicas'],
            $data['shards'],
            $data['pod_type'],
            $data['index_config'],
            $data['metadata_config'],
            $data['status'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'dimension' => $this->dimension,
            'metric' => $this->metric,
            'pods' => $this->pods,
            'replicas' => $this->replicas,
            'shards' => $this->shards,
            'pod_type' => $this->podType,
            'index_config' => $this->indexConfig,
            'metadata_config' => $this->metadataConfig,
            'status' => $this->status,
        ];
    }
}
