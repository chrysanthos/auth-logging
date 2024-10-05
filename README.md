# Authentication logger for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/Chrysanthos/auth-logging.svg?style=flat-square)](https://packagist.org/packages/chrysanthos/auth-logging)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/chrysanthos/auth-logging/run-tests.yml?branch=master&?label=tests)](https://github.com/chrysanthos/auth-logging/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Total Downloads](https://img.shields.io/packagist/dt/chrysanthos/auth-logging.svg?style=flat-square)](https://packagist.org/packages/chrysanthos/auth-logging)
[![Buy us a tree](https://img.shields.io/badge/Treeware-%F0%9F%8C%B3-lightgreen?style=flat-square)](https://plant.treeware.earth/chrysanthos/auth-logging)

The "Auth Logging" package logs failed login attempts that occur in your app. It stores the credentials used along with the user ip and user agent in the database which you can analyse at a later point.

## Installation

You can install the package via composer:

```bash
composer require chrysanthos/auth-logging
```

## Usage

The only thing you need to do is run your migrations using

``` bash
php artisan migrate
```

### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please send me a message on twitter (@chrysanthos_cy) instead of using the issue tracker.

## Credits

- [Chrysanthos Prodromou](https://github.com/chrysanthos)

## Licence
This package is [Treeware](https://treeware.earth). If you use it in production, then we ask that you [**buy the world a tree**](https://plant.treeware.earth/chrysanthos/auth-logging) to thank us for our work. By contributing to the Treeware forest you’ll be creating employment for local families and restoring wildlife habitats.
