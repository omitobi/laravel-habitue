[![Build Status](https://travis-ci.com/omitobi/laravel-habitue.svg?branch=master)](https://travis-ci.com/omitobi/laravel-habitue)
[![Latest Stable Version](https://poser.pugx.org/omitobisam/laravel-habitue/version)](https://packagist.org/packages/omitobisam/laravel-habitue)
[![Total Downloads](https://poser.pugx.org/omitobisam/laravel-habitue/downloads)](https://packagist.org/packages/omitobisam/laravel-habitue)
[![Latest Unstable Version](https://poser.pugx.org/omitobisam/habitue/v/unstable)](//packagist.org/packages/omitobisam/laravel-habitue)
[![Monthly Downloads](https://poser.pugx.org/omitobisam/laravel-habitue/d/monthly)](https://packagist.org/packages/omitobisam/laravel-habitue)

# Habitue
An Http client with the power of collections for your jsonable requests

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

You can use within a class...:

```php
use Habitue\Habitue;

class RequestService {
    
    private Habitue $habitue;

    public function __construct(Habitue $habitue)
    {       
        $this->habitue = $habitue;
    }
}

// or simply

Habitue::make() // An instance of Habitue

->setBody(['page' => 2]) //set body

->setHeaders(['x-key' => 'abcd']) // set header(s)

->get('https//abc.example/ninjas'); // or ->post() 
```

Then call the methods to make the http request:

```php
/**
* @var $response \Habitue\Integration\Response
*/
$response = Habitue::get('https://ninja.example/users');

$response->json(); //returns json string of the response body

$response->array(); // returns array value of the response body

$response->getStatusCode(); //returns status code

$response->getHeaders(); // returns the headers

$response->collect(); // returns the response body in an instance of Habitue\Collector 
```

The `collect` method is a smart Collection that provides all the methods available in Laravel Collection and helps to draw out values deeply nexted into the response.
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
$collected = $habitue->get('https://ninja.example/users') // Returns Habitue/Integration/Collector
    ->collect();

$collected->get('name'); //John Doe

$collected->getName(); // John Doe

$collected->getAddress() // Collection with {"postal": {"code":"11111","region":"lc"}, "city":"Tartu"}

    ->getPostal() // Collection with {"code":"11111","region":"lc"}

    ->getCode(); //11111
```

## Contributions

