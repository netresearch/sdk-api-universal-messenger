# Requirements

## System Requirements
- PHP 8.1+ with JSON and XML extension


# Installation
To install this package your set-up requires already installed packages implementing
`psr/http-client-implementation` and `psr/http-factory-implementation`, for instance `php-http/guzzle6-adapter`
and `nyholm/psr7`.

```bash
composer require netresearch/sdk-api-universal-messenger
```


# Uninstallation
```bash
composer remove netresearch/sdk-api-universal-messenger
```


# Testing
```bash
composer update
composer ci:cgl
composer ci:test
composer ci:test:php:phplint
composer ci:test:php:phpstan
composer ci:test:php:rector
composer ci:test:php:unit
```
