# A simple PHP wrapper around Pinecone API

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
$skeleton = new Jonathanm10\PineconeClient();
echo $skeleton->echoPhrase('Hello, Jonathanm10!');
```

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
