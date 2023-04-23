<?php

namespace Jonathanm10\PineconeClient\Exceptions;

use Exception;
use GuzzleHttp\Exception\ClientException;

class ApiExceptionFactory
{
    public static function createFromClientException(ClientException $e): Exception
    {
        $statusCode = $e->getResponse()->getStatusCode();
        $message = sprintf('Error %s: %s', $statusCode, $e->getResponse()->getBody());

        return match ($statusCode) {
            400 => new BadRequestException($message, $statusCode),
            404 => new NotFoundException($message, $statusCode),
            409 => new ConflictException($message, $statusCode),
            500 => new InternalServerErrorException($message, $statusCode),
            default => new Exception(sprintf('Unexpected response code %s encountered.', $statusCode), $statusCode),
        };
    }
}
