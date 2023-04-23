<?php

namespace Jonathanm10\PineconeClient\DTO\Response;

use JsonException;

class IndexDescribeCollectionResponse
{
    public function __construct(
        public readonly string $name,
        public readonly ?int $size,
        public readonly string $status
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
            $data['size'],
            $data['status'],
        );
    }

    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'size' => $this->size,
            'status' => $this->status,
        ];
    }
}
