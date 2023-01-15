# Authentication logger for Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/Chrysanthos/auth-logging.svg?style=flat-square)](https://packagist.org/packages/chrysanthos/auth-logging)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/chrysanthos/auth-logging/run-tests.yml?branch=main&?label=tests)](https://github.com/chrysanthos/auth-logging/actions?query=workflow%3Arun-tests+branch%3Amaster)
[![Quality Score](https://img.shields.io/scrutinizer/g/chrysanthos/auth-logging.svg?style=flat-square)](https://scrutinizer-ci.com/g/chrysanthos/auth-logging)
[![Total Downloads](https://img.shields.io/packagist/dt/chrysanthos/auth-logging.svg?style=flat-square)](https://packagist.org/packages/chrysanthos/auth-logging)
[![Buy us a tree](https://img.shields.io/badge/Treeware-%F0%9F%8C%B3-lightgreen?style=flat-square)](https://plant.treeware.earth/chrysanthos/auth-logging)

The Laravel package logs failed attempts to login. It stores the credentials used along with the user ip and user agent in a table where you can later check. A Nova tool will be provided soon. 

## Installation

You can install the package via composer:

```bash
composer require chrysanthos/auth-logging
```

## Usage

The package service provider is registered automatically and a migration is provided to be run. 

The only thing you need to do is run your migrations by running

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

## Treeware

You're free to use this package, but if it makes it to your production environment you are required to buy the world a tree.

It’s now common knowledge that one of the best tools to tackle the climate crisis and keep our temperatures from rising above 1.5C is to <a href="https://www.bbc.co.uk/news/science-environment-48870920">plant trees</a>. If you support this package and contribute to the Treeware forest you’ll be creating employment for local families and restoring wildlife habitats.

You can buy trees here [offset.earth/treeware](https://plant.treeware.earth/chrysanthos/auth-logging)

Read more about Treeware at [treeware.earth](http://treeware.earth)
