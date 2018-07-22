# LaravelRoleManagement

[![Latest Version on Packagist][ico-version]][link-packagist]
[![Total Downloads][ico-downloads]][link-downloads]
[![Build Status][ico-travis]][link-travis]
[![StyleCI][ico-styleci]][link-styleci]

This is where your description should go. Take a look at [contributing.md](contributing.md) to see a to do list.

## Installation

Via Composer

``` bash
$ composer require pooyadch/laravelrolemanagement:dev-master
```
migrate all database
```
php artisan migrate
```

add following code into Kernel.php in App/Http
```php
   protected $routeMiddleware = [
           'UserRolePermissionMiddleware' =>UserRolePermissionMiddleware::class,
       ];
```

## Usage
add "UserRolePermissionMiddleware" middleware on your route

## Change log

Please see the [changelog](changelog.md) for more information on what has changed recently.

## Testing

``` bash
$ composer test
```

## Contributing

Please see [contributing.md](contributing.md) for details and a todolist.

## Security

If you discover any security related issues, please email author email instead of using the issue tracker.

## Credits

- [author name][link-author]
- [All Contributors][link-contributors]

## License

license. Please see the [license file](license.md) for more information.

[ico-version]: https://img.shields.io/packagist/v/pooyadch/laravelrolemanagement.svg?style=flat-square
[ico-downloads]: https://img.shields.io/packagist/dt/pooyadch/laravelrolemanagement.svg?style=flat-square
[ico-travis]: https://img.shields.io/travis/pooyadch/laravelrolemanagement/master.svg?style=flat-square
[ico-styleci]: https://styleci.io/repos/12345678/shield

[link-packagist]: https://packagist.org/packages/pooyadch/laravelrolemanagement
[link-downloads]: https://packagist.org/packages/pooyadch/laravelrolemanagement
[link-travis]: https://travis-ci.org/pooyadch/laravelrolemanagement
[link-styleci]: https://styleci.io/repos/12345678
[link-author]: https://github.com/pooyadch
[link-contributors]: ../../contributors]