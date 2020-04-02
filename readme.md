<p align="center">
<img src="https://github.com/omitobi/assets/blob/master/laravel-habitue-assets/twitter_header_photo_2.png">
</p>

<p align="center">
<a href="https://travis-ci.com/omitobi/laravel-habitue"> <img src="https://travis-ci.com/omitobi/laravel-habitue.svg?branch=master" alt="Build Status"/></a>
<a href="https://packagist.org/packages/omitobisam/laravel-habitue"> <img src="https://poser.pugx.org/omitobisam/laravel-habitue/version" alt="Latest Stable Version"/></a>
<a href="https://packagist.org/packages/omitobisam/laravel-habitue"> <img src="https://poser.pugx.org/omitobisam/laravel-habitue/downloads" alt="Total Downloads"/></a>
<a href="https://packagist.org/packages/omitobisam/laravel-habitue"> <img src="https://poser.pugx.org/omitobisam/laravel-habitue/v/unstable" alt="Latest Unstable Version"/></a>
<a href="https://packagist.org/packages/omitobisam/laravel-habitue"> <img src="https://poser.pugx.org/omitobisam/laravel-habitue/d/monthly" alt="Latest Monthly Downloads"/></a>
</p>

## About Habitue
An Http Client with the power of collections for your jsonable requests. Usable on Laravel and non-laravel php project.

## Installation

Using composer:

`composer require omitobisam/laravel-habitue`

or add to the require object of `composer.json` file with the version number:

```json
{
  "require": {
    "omitobisam/laravel-habitue": "v7.0" 
  }
}
```

After this run `composer update`

## Usage

You can call it simply statically:

```php
use Habitue\Habitue;

// or simply
Habitue::make() // An instance of Habitue

->setBody(['page' => 2]) //set body

->setHeaders(['x-key' => 'abcd']) // set header(s)

->get('https//abc.example/ninjas'); // or ->post() 
```

Or you can wire it up in your class:

```php
use Habitue\Habitue;

class RequestService {
    
    private Habitue $habitue;

    public function __construct(Habitue $habitue)
    {       
        $this->habitue = $habitue;
    }
}
```

Then call the methods to make the http request:

```php
use Habitue\Habitue;

/**
* @var $response \Habitue\Integration\Response
*/
$response = Habitue::make()
    ->get('https://ninja.example/users');

$response->json(); //returns json string of the response body

$response->array(); // returns array value of the response body

$response->getStatusCode(); //returns status code

$response->getHeaders(); // returns the headers

$response->collect(); // returns the response body in an instance of Habitue\Collector 
```

The `collect` method is a smart Collection that provides all the methods available in Laravel Collection and helps to draw out values deeply nested into the response.
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
$collected = Habitue::make()
    ->get('https://ninja.example/users')
    ->collect();

$collected->get('name'); //John Doe

$collected->getName(); // John Doe

$collected->getAddress() // Collection with {"postal": {"code":"11111","region":"lc"}, "city":"Tartu"}

    ->getPostal() // Collection with {"code":"11111","region":"lc"}

    ->getCode(); //11111
```

## API Available

### Habitue class

```php
\Habitue\Habitue::__construct(Client $client): void
\Habitue\Habitue::setHeaders(): HabitueInterface
\Habitue\Habitue::setBody(): HabitueInterface
\Habitue\Habitue::get(string $url, array $data = []): ResponseInterface
\Habitue\Habitue::post(string $url, array $data = []): ResponseInterface
\Habitue\Habitue::patch(string $url, array $data = []): ResponseInterface
\Habitue\Habitue::put(string $url, array $data = []): ResponseInterface
\Habitue\Habitue::delete(string $url, array $data = []): ResponseInterface
\Habitue\Habitue::make($client = null): HabitueInterface
```

### Response Class

```php
\Habitue\Integration\Response::__construct(): void
\Habitue\Integration\Response::collect(): CollectorInterface
\Habitue\Integration\Response::array(): array
\Habitue\Integration\Response::json(): string
\Habitue\Integration\Response::getStatusCode(): int
\Habitue\Integration\Response::getHeaders(): array
\Habitue\Integration\Response::getWrapped(): GuzzleResponseInterface
\Habitue\Integration\Response::make($response): ResponseInterface
\Habitue\Integration\Response::__toString(): string
```

## Contributions

- Create an issue
- Make a PR
- It gets it approved
- It gets gets merged


