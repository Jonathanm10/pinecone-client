<?php

namespace Jonathanm10\PineconeClient;

class Pinecone
{
    public static function init(array $params): Client
    {
        $httpClient = new \GuzzleHttp\Client([
            'headers' => [
                'Api-Key' => $params['api_key'],
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
            ],
        ]);

        return new Client($httpClient, $params['environment']);
    }
}
