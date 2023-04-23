<?php

use Jonathanm10\PineconeClient\DTO\Payload\VectorSparseValuesPayload;
use Jonathanm10\PineconeClient\DTO\Payload\VectorUpdatePayload;

it('should recursively validate mandatory attributes', function () {
    try {
        VectorUpdatePayload::fromArray([
            'id' => 'xxx',
            'values' => [],
            'sparseValues' => [
                'values' => [],
            ],
        ]);
    } catch (InvalidArgumentException $e) {
        expect($e->getMessage())
            ->toBe("Mandatory attribute 'indices' is missing from '".VectorSparseValuesPayload::class."'");
    }
});

it('should recursively instantiate DTOs', function () {
    $payload = VectorUpdatePayload::fromArray([
        'id' => 'xxx',
        'values' => [],
        'sparseValues' => [
            'indices' => [],
            'values' => [],
        ],
    ]);

    expect($payload)
        ->toBeInstanceOf(VectorUpdatePayload::class)
        ->sparseValues->toBeInstanceOf(VectorSparseValuesPayload::class);
});

it('should recursively convert DTOs to arrays', function () {
    $payload = VectorUpdatePayload::fromArray([
        'id' => 'xxx',
        'values' => [1, 2, 3],
        'sparseValues' => [
            'indices' => [1, 2, 3],
            'values' => [1, 2, 3],
        ],
    ]);

    expect($payload->toArray())->toEqual([
        'id' => 'xxx',
        'values' => [1, 2, 3],
        'sparseValues' => [
            'indices' => [1, 2, 3],
            'values' => [1, 2, 3],
        ],
        'setMetadata' => [],
        'namespace' => '',
    ]);
});
