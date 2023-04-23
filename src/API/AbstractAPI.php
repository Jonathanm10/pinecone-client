<?php

namespace Jonathanm10\PineconeClient\API;

use GuzzleHttp\Client;

abstract class AbstractAPI
{
    protected const BASE_URI = 'pinecone.io';

    public function __construct(protected Client $httpClient, protected string $environment)
    {
    }

    public function controllerUrl(): string
    {
        return 'https://controller.'.$this->environment.'.'.self::BASE_URI;
    }
}
