# Laravel Artisan Commands

[![Latest Version on Packagist](https://img.shields.io/packagist/v/abaci/artisan-commands.svg?style=flat-square)](https://packagist.org/packages/abaci/artisan-commands)
[![Build Status](https://travis-ci.org/davidsmithitsandbox/abaci-artisan-commands.svg?branch=master)](https://travis-ci.org/davidsmithitsandbox/abaci-artisan-commands)
[![Total Downloads](https://img.shields.io/packagist/dt/abaci/artisan-commands.svg?style=flat-square)](https://packagist.org/packages/abaci/artisan-commands)

A collection of artisan commands

## Installation

You can install the package via composer:

```bash
composer require abaci/artisan-commands
```

## Usage

NOTE:<br>
To invoke interactive mode on most commands, don't specify a include a parameter or use the `--i` option. <br><br>

Make Directory
``` php
php artisan make:dir [path?] --i
```

Delete Directory
``` php
php artisan delete:dir [path?] --i
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email dave0016@gmail.com instead of using the issue tracker.

## Credits

- [David Smith](https://github.com/davidsmithitsandbox)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.