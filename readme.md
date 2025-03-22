<p align="center">
<img src="https://github.com/omitobi/assets/blob/master/laravel-habitue-assets/twitter_header_photo_2.png">
</p>

<p align="center">
<a href="https://omitobi.github.io/laravel-habitue/"> <img src="https://github.com/omitobi/laravel-habitue/actions/workflows/php.yml/badge.svg" alt="Build Status"/></a>
<a href="https://packagist.org/packages/omitobisam/laravel-habitue"> <img src="https://poser.pugx.org/omitobisam/laravel-habitue/version" alt="Latest Stable Version"/></a>
<a href="https://packagist.org/packages/omitobisam/laravel-habitue"> <img src="https://poser.pugx.org/omitobisam/laravel-habitue/downloads" alt="Total Downloads"/></a>
<a href="https://packagist.org/packages/omitobisam/laravel-habitue"> <img src="https://poser.pugx.org/omitobisam/laravel-habitue/v/unstable" alt="Latest Unstable Version"/></a>
<a href="https://packagist.org/packages/omitobisam/laravel-habitue"> <img src="https://poser.pugx.org/omitobisam/laravel-habitue/d/monthly" alt="Latest Monthly Downloads"/></a>
</p>

## About Habitue
The easiest and fluent HTTP Client for PHP.

## Installation

Using composer:

`composer require omitobisam/laravel-habitue`

or add to the require object of `composer.json` file with the version number:

```json
{
  "require": {
    "omitobisam/laravel-habitue": "^v3.0" 
  }
}
```

After this run `composer update`

## Usage

You can call the helper function simply:

```php
$response = habitue('http://ninja.example/users')->get();
$response = habitue('http://ninja.example/users', ['data' => 'aaa'])->post();
$response = habitue('http://ninja.example/users')->delete();
$response = habitue('http://ninja.example/users', ['data' => 'aaa'])->patch();

$response->get('data')
```

You can call it simply statically:

```php
use Habitue\Habitue;
Habitue::::make('http://ninja.example/api/users')->get(); // or ->post() 

```

With Configuration:

```php
use Habitue\Habitue;
// or simply
Habitue::::make('http://ninja.example/api/users') // An instance of Habitue
->setBody(['page' => 2]) //set body
->setHeaders(['x-key' => 'abcd']) // set header(s)
->get()
```

Handling Responses returned:

```php
use Habitue\Habitue;

/**
* @var $response Habitue\Integration\Collector
*/
$response = habitue('http://ninja.example/users')->get();

$response->statusCode(); // int
$response->headers(); // array
$response->toJson(); // string
// And others method available in Illuminate\Collection


$clientResponse = $response->response(); // Habitue\Integration\ClientResponse
$clientResponse->getData(); // string
$clientResponse->getStatusCode(); // int
$clientResponse->getHeaders(); // array
```

The Response (as Habitue\Integration\Collector) is a smart Collection that provides all the methods available in Laravel Collection and helps to draw out values deeply nested into the response.
Say your response is the following:

```json
{
  "name":"John Doe",
  "age":11,
  "height":57,
  "address": {
    "postal": {
      "code":"11111",
      "region":"lc"
    },
  "city":"Tartu"
  }
}
```

You can get the value `code`  with the following

```php
use Habitue\Habitue;

/**
* @var $collected \Habitue\Integration\Collector
*/
$collected = \habitue('https://ninja.example/users')->get();

$collected->get('name'); //John Doe

$collected->getName(); // John Doe

$collected->getAddress() // Collection with {"postal": {"code":"11111","region":"lc"}, "city":"Tartu"}

    ->getPostal() // Collection with {"code":"11111","region":"lc"}

    ->getCode(); //11111
```

## API Available

### Habitue class

```php
Habitue::__construct(url: string, [data: array = [...]], [config: array = [...]])
Habitue::setHeaders(headers: array, [overwrite: bool = false]): HabitueInterface
Habitue::setBody(body: array, [overwrite: bool = false]): HabitueInterface
Habitue::get([key = null]): HabitueResponse.getReturn): Collector|mixed // Depends on the type of configuration at config: 'habitue.return'
Habitue::post([key = null]): Collector|mixed // Depends on the type of configuration at config: 'habitue.return'
Habitue::patch([key = null]): Collector|mixed // Depends on the type of configuration at config: 'habitue.return'
Habitue::put([key = null]): Collector|mixed // Depends on the type of configuration at config: 'habitue.return'
Habitue::delete([key = null]): Collector|mixed // Depends on the type of configuration at config: 'habitue.return'
Habitue::getResponse(): ClientResponse
Habitue::make(url: string, [data: array = [...]], [config: array = [...]]): HabitueInterface

```

### ClientResponse Class

```php
ClientResponse::__construct(data: string, statusCode: int, headers: array)
ClientResponse::getData(): string
ClientResponse::getStatusCode(): int
ClientResponse::getHeaders(): array
ClientResponse::__toString(): string
```

## Contributions

- Make a PR
- Make sure the tests passes
- It gets it approved
- It gets merged


