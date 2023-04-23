# A simple PHP wrapper around Pinecone API (Unofficial)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/jonathanm10/pinecone-client.svg?style=flat-square)](https://packagist.org/packages/jonathanm10/pinecone-client)
[![Tests](https://img.shields.io/github/actions/workflow/status/jonathanm10/pinecone-client/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/jonathanm10/pinecone-client/actions/workflows/run-tests.yml)
[![Total Downloads](https://img.shields.io/packagist/dt/jonathanm10/pinecone-client.svg?style=flat-square)](https://packagist.org/packages/jonathanm10/pinecone-client)

## Installation

You can install the package via composer:

```bash
composer require jonathanm10/pinecone-client
```

## Usage

```php
$client = Pinecone::init([
    'api_key' => 'xxxx-xxx-xxxx-xxxx',
    'environment' => 'us-east-1-aws',
]);

// Accessing the index API
$client->index();

// Accessing the vector API
$client->vector();
```

All Pinecone's methods are available as methods on the client: https://docs.pinecone.io/reference/describe_index_stats_post


## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](https://github.com/spatie/.github/blob/main/CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Jonathan Macheret](https://github.com/Jonathanm10)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
