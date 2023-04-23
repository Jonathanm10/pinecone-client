<?php

namespace Jonathanm10\PineconeClient;

use GuzzleHttp\Exception\GuzzleException;
use Jonathanm10\PineconeClient\API\IndexAPI;
use Jonathanm10\PineconeClient\API\VectorAPI;
use JsonException;

class Client
{
    public function __construct(protected \GuzzleHttp\Client $httpClient, protected string $environment)
    {
    }

    public function index(): IndexAPI
    {
        return new IndexAPI($this->httpClient, $this->environment);
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function vector(): VectorAPI
    {
        return new VectorAPI($this->httpClient, $this->environment);
    }
}
