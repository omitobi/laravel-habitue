<?php

namespace Habitue\Tests;

use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Habitue\Integration\ClientResponse;
use Habitue\Integration\Collector;
use Habitue\Integration\HabitueResponse;
use PHPUnit\Framework\TestCase;
use Illuminate\Support\Collection;

class ResponseTest extends TestCase
{
    private Collector $response;
    private GuzzleResponse $guzzleResponse;
    private array $body;
    private array $headers;

    protected function setUp(): void
    {
        parent::setUp();

        $this->headers = ['X-Foo' => 'Bar'];
        $this->body = ['data' => 'Hello, World'];

        $this->guzzleResponse = new GuzzleResponse(200, $this->headers, json_encode($this->body));

        $this->response = (new HabitueResponse(
            new ClientResponse(
                $this->guzzleResponse->getBody()->getContents(),
                $this->guzzleResponse->getStatusCode(),
                $this->guzzleResponse->getHeaders()
            )
        ))->respond();
    }

    public function testCollect()
    {
        $this->assertInstanceOf(Collector::class, $this->response);
        $this->assertInstanceOf(Collection::class, $this->response);
    }

    public function testGetStatusCode()
    {
        $this->assertEquals($this->guzzleResponse->getStatusCode(), $this->response->statusCode());
    }

    public function testGetHeaders()
    {
        $this->assertEquals($this->guzzleResponse->getHeaders(), $this->response->headers());
    }


    public function testJson()
    {
        $this->assertTrue(is_string($this->response->toJson()));
        $this->assertEquals(json_encode($this->body), $this->response->toJson());
    }

    public function testArray()
    {
        $this->assertTrue(is_array($this->response->toArray()));
        $this->assertEquals(
            $this->body,
            $this->response->toArray()
        );
    }
}