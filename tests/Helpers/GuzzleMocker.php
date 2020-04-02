<?php

namespace Habitue\Tests\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response as GuzzleResponse;

class GuzzleMocker
{
    public static function prepareGuzzleMock()
    {
        $mock = new MockHandler([
            new GuzzleResponse(200, ['X-Foo' => 'Bar'], '{"data": "Hello, World"}'),
            new RequestException('Error Communicating with Server', new Request('GET', 'test')),
        ]);

        $handlerStack = HandlerStack::create($mock);
        return [$mock, $handlerStack, new Client(['handler' => $handlerStack])];
    }
}