<?php

namespace Jonathanm10\PineconeClient\API;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\RequestOptions;
use Jonathanm10\PineconeClient\DTO\Payload\VectorDeletePayload;
use Jonathanm10\PineconeClient\DTO\Payload\VectorFetchPayload;
use Jonathanm10\PineconeClient\DTO\Payload\VectorQueryPayload;
use Jonathanm10\PineconeClient\DTO\Payload\VectorUpdatePayload;
use Jonathanm10\PineconeClient\DTO\Payload\VectorUpsertPayload;
use Jonathanm10\PineconeClient\DTO\Response\VectorDescribeIndexStatsResponse;
use Jonathanm10\PineconeClient\DTO\Response\VectorFetchResponse;
use Jonathanm10\PineconeClient\DTO\Response\VectorQueryResponse;
use Jonathanm10\PineconeClient\DTO\Response\VectorUpsertData;
use Jonathanm10\PineconeClient\Exceptions\ApiExceptionFactory;
use JsonException;

class VectorAPI extends AbstractAPI
{
    protected string $projectName;

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function __construct(protected Client $httpClient, protected string $environment)
    {
        parent::__construct($httpClient, $environment);

        $this->projectName = $this->whoAmI();
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     * @throws Exception
     */
    public function describeIndexStats(string $index, array $filters = []): VectorDescribeIndexStatsResponse
    {
        try {
            $content = $this
                ->httpClient
                ->post($this->url($index, '/describe_index_stats'), empty($filters) ? [] : [RequestOptions::JSON => $filters])
                ->getBody();
        } catch (ClientException $e) {
            throw ApiExceptionFactory::createFromClientException($e);
        }

        return VectorDescribeIndexStatsResponse::fromString($content);
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function query(string $index, array $params): VectorQueryResponse
    {
        $payload = VectorQueryPayload::fromArray($params);

        $content = $this->httpClient->post($this->url($index, '/query'), [
            RequestOptions::JSON => $payload->toArray(),
        ]);

        return VectorQueryResponse::fromString($content->getBody());
    }

    /**
     * @throws GuzzleException
     * @throws Exception
     */
    public function delete(string $index, array $params): void
    {
        $payload = VectorDeletePayload::fromArray($params);

        try {
            $this->httpClient->post($this->url($index, '/vectors/delete'), [
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
    public function fetch(string $index, array $params): VectorFetchResponse
    {
        $payload = VectorFetchPayload::fromArray($params);

        try {
            $content = $this->httpClient->get($this->url($index, '/vectors/fetch'), [
                RequestOptions::JSON => $payload->toArray(),
            ])->getBody();
        } catch (ClientException $e) {
            throw ApiExceptionFactory::createFromClientException($e);
        }

        return VectorFetchResponse::fromString($content);
    }

    /**
     * @throws GuzzleException
     */
    public function update(string $indexName, array $params): void
    {
        $payload = VectorUpdatePayload::fromArray($params);

        $this->httpClient->post($this->url($indexName, '/vectors/update'), [
            RequestOptions::JSON => $payload->toArray(),
        ]);
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    public function upsert(string $indexName, array $params): VectorUpsertData
    {
        $payload = VectorUpsertPayload::fromArray($params);

        $content = $this->httpClient->post($this->url($indexName, '/vectors/upsert'), [
            RequestOptions::JSON => $payload->toArray(),
        ])->getBody();

        return VectorUpsertData::fromString($content);
    }

    /**
     * @throws GuzzleException
     * @throws JsonException
     */
    protected function whoAmI(): string
    {
        $content = $this->httpClient->get($this->controllerUrl() . '/actions/whoami')->getBody();

        $content = json_decode($content, true, 512, JSON_THROW_ON_ERROR);

        return $content['project_name'];
    }

    protected function url(string $index, string $path): string
    {
        return sprintf(
            'https://%s-%s.svc.%s.%s%s',
            $index,
            $this->projectName,
            $this->environment,
            self::BASE_URI,
            $path
        );
    }
}
