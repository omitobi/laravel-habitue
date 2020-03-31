<p align="center">
<img src="https://github.com/omitobi/assets/blob/master/laravel-habitue-assets/twitter_header_photo_2.png" height="300" align="center" width="100%">
</p>

[![Build Status](https://travis-ci.com/omitobi/laravel-habitue.svg?branch=master)](https://travis-ci.com/omitobi/laravel-habitue)
[![Latest Stable Version](https://poser.pugx.org/omitobisam/laravel-habitue/version)](https://packagist.org/packages/omitobisam/laravel-habitue)
[![Total Downloads](https://poser.pugx.org/omitobisam/laravel-habitue/downloads)](https://packagist.org/packages/omitobisam/laravel-habitue)
[![Latest Unstable Version](https://poser.pugx.org/omitobisam/laravel-habitue/v/unstable)](https://packagist.org/packages/omitobisam/laravel-habitue)
[![Monthly Downloads](https://poser.pugx.org/omitobisam/laravel-habitue/d/monthly)](https://packagist.org/packages/omitobisam/laravel-habitue)

# About Habitue
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

## Contributions

- Create an issue
- Make a PR
- It gets it approved
- It gets gets merged


