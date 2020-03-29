<?php

namespace Harbitue\Tests;

use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Harbitue\Contracts\ResponseInterface;
use Harbitue\Integration\Collector;
use Harbitue\Integration\Response;
use PHPUnit\Framework\TestCase;
use Tightenco\Collect\Support\Collection;

class ResponseTest extends TestCase
{
    private Response $response;
    private GuzzleResponse $guzzleResponse;

    protected function setUp(): void
    {
        parent::setUp();

        $this->guzzleResponse = new GuzzleResponse(200, ['X-Foo' => 'Bar'], '{"data": "Hello, World"}');
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
}