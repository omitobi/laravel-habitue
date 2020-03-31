<?php

namespace Habitue\Tests;

use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Habitue\Contracts\ResponseInterface;
use Habitue\Integration\Collector;
use Habitue\Integration\Response;
use PHPUnit\Framework\TestCase;
use Tightenco\Collect\Support\Collection;

class ResponseTest extends TestCase
{
    private Response $response;
    private GuzzleResponse $guzzleResponse;
    private array $body;
    private array $headers;

    protected function setUp(): void
    {
        parent::setUp();

        $this->headers = ['X-Foo' => 'Bar'];
        $this->body = ['data' => 'Hello, World'];

        $this->guzzleResponse = new GuzzleResponse(200, $this->headers, json_encode($this->body));
        $this->response = new Response($this->guzzleResponse);
    }

    public function testMake()
    {
        $this->assertInstanceOf(ResponseInterface::class, Response::make($this->guzzleResponse));
    }

    public function testCollect()
    {
        $this->assertInstanceOf(Collector::class, $this->response->collect());
        $this->assertInstanceOf(Collection::class, $this->response->collect());
    }

    public function testGetStatusCode()
    {
        $this->assertEquals($this->guzzleResponse->getStatusCode(), $this->response->getStatusCode());
    }

    public function testGetHeaders()
    {
        $this->assertEquals($this->guzzleResponse->getHeaders(), $this->response->getHeaders());
    }

    public function testGetWrapped()
    {
        $this->assertEquals($this->guzzleResponse, $this->response->getWrapped());
    }

    public function testJson()
    {
        $this->assertTrue(is_string($this->response->json()));
        $this->assertEquals(json_encode($this->body), $this->response->json());
    }

    public function testArray()
    {
        $this->assertTrue(is_array($this->response->array()));
        $this->assertEquals(
            $this->body,
            $this->response->array()
        );
    }
}