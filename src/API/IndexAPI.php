<?php

namespace Jonathanm10\PineconeClient\API;

use Exception;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Jonathanm10\PineconeClient\DTO\Payload\IndexConfigurePayload;
use Jonathanm10\PineconeClient\DTO\Payload\IndexCreateCollectionPayload;
use Jonathanm10\PineconeClient\DTO\Payload\IndexCreatePayload;
use Jonathanm10\PineconeClient\DTO\Response\IndexCollectionsListResponse;
use Jonathanm10\PineconeClient\DTO\Response\IndexDescribeCollectionResponse;
use Jonathanm10\PineconeClient\DTO\Response\IndexInformationResponse;
use Jonathanm10\PineconeClient\DTO\Response\IndexListResponse;
use Jonathanm10\PineconeClient\Exceptions\ApiExceptionFactory;
use JsonException;

class IndexAPI extends AbstractAPI
{
    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function create(array $params): void
    {
        $payload = IndexCreatePayload::fromArray($params);

        try {
            $this->httpClient->post($this->url('/databases'), [
                RequestOptions::JSON => $payload->toArray(),
            ]);
        } catch (ClientException $e) {
            throw ApiExceptionFactory::createFromClientException($e);
        }
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     * @throws Exception
     */
    public function describe(string $indexName): IndexInformationResponse
    {
        try {
            $content = $this->httpClient->get($this->url("/databases/{$indexName}"))->getBody();
        } catch (ClientException $e) {
            throw ApiExceptionFactory::createFromClientException($e);
        }

        return IndexInformationResponse::fromString($content);
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function list(): IndexListResponse
    {
        $content = $this->httpClient->get($this->url('/databases'))->getBody();

        return IndexListResponse::fromString($content);
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function delete(string $indexName): void
    {
        try {
            $this->httpClient->delete($this->url("/databases/{$indexName}"));
        } catch (ClientException $e) {
            throw ApiExceptionFactory::createFromClientException($e);
        }
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function configure(string $indexName, array $params): void
    {
        $payload = IndexConfigurePayload::fromArray($params);

        try {
            $this->httpClient->patch($this->url("/databases/$indexName"), [
                RequestOptions::JSON => $payload->toArray(),
            ]);
        } catch (ClientException $e) {
            throw ApiExceptionFactory::createFromClientException($e);
        }
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function listCollections(): IndexCollectionsListResponse
    {
        $content = $this->httpClient->get($this->url('/collections'))->getBody();

        return IndexCollectionsListResponse::fromArray($content);
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function createCollection(array $params): void
    {
        $payload = IndexCreateCollectionPayload::fromArray($params);

        try {
            $this->httpClient->post($this->url('/collections'), [
                RequestOptions::JSON => $payload->toArray(),
            ]);
        } catch (ClientException $e) {
            throw ApiExceptionFactory::createFromClientException($e);
        }
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     * @throws Exception
     */
    public function describeCollection(string $name): IndexDescribeCollectionResponse
    {
        try {
            $content = $this->httpClient->get($this->url("/collections/{$name}"))->getBody();
        } catch (ClientException $e) {
            throw ApiExceptionFactory::createFromClientException($e);
        }

        return IndexDescribeCollectionResponse::fromString($content);
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function deleteCollection(string $name): void
    {
        try {
            $this->httpClient->delete($this->url("/collections/{$name}"));
        } catch (ClientException $e) {
            throw ApiExceptionFactory::createFromClientException($e);
        }
    }

    protected function url(string $path): string
    {
        return sprintf('https://controller.%s.%s%s', $this->environment, self::BASE_URI, $path);
    }
}
