
[![Latest Version on Packagist](https://img.shields.io/packagist/v/lacasera/api-jwt-scaffold.svg?style=flat-square)](https://packagist.org/packages/lacasera/api-jwt-scaffold)
[![Build Status](https://travis-ci.org/lacasera/api-jwt-scaffold.svg?branch=master)](https://travis-ci.org/lacasera/api-jwt-scaffold)
[![Quality Score](https://img.shields.io/scrutinizer/g/lacasera/api-jwt-scaffold.svg?style=flat-square)](https://scrutinizer-ci.com/g/lacasera/api-jwt-scaffold)
[![Total Downloads](https://img.shields.io/packagist/dt/lacasera/api-jwt-scaffold.svg?style=flat-square)](https://packagist.org/packages/lacasera/api-jwt-scaffold)

This package helps you quickly scaffold api authentication for you laravel project using 
1. [Laravel Passport](https://laravel.com/docs/6.x/passport)
2. [Tymon JWT](https://jwt-auth.readthedocs.io/en/develop/laravel-installation/)

## Installation
`
NB: always install this package on a fresh install of laravel since it will overwrite some existing files
`

You can install the package via composer:
```bash
composer require lacasera/api-jwt-scaffold --dev
```

## Usage

1. run the command 
```bash
php artisan make:auth-api
```
    
```
An Auth and Register Controllers will be generated under the Auth namespace to handle authentication requests to your application.
Feel free to modify them to your applications needs.
```

2. define your routes
```php
//api.php

Route::group(['namespace' => 'Auth'], function(){
    Route::get('me', 'AuthController@me');
    Route::post('login', 'AuthController@login');
    Route::get('logout', 'AuthController@logout');
    Route::post('register', 'RegisterController@create');
});

```
3. Make sure your requests to the api routes add the `Accepts: application/json` header.

4. Enjoy.


### Testing

``` bash
composer test
```

### Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

### Security

If you discover any security related issues, please email aboateng62@gmail.com instead of using the issue tracker.

## Credits

- [Agyenim Boateng Barfi](https://github.com/lacasera)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
