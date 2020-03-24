<?php
namespace Harbitue\Tests;

use GuzzleHttp\Client;
use Harbitue\Harbitue;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use GuzzleHttp\Handler\MockHandler;
use Harbitue\Integration\Collector;
use GuzzleHttp\Exception\RequestException;

class HarbitueTest extends TestCase
{
    private Harbitue $harbitue;

    protected function setUp(): void
    {
        parent::setUp();

        $this->harbitue = new Harbitue($this->prepareGuzzleMock());
    }

    public function testPostSuccess()
    {
        $response = $this->harbitue->post('ninja', ['data' => 'aaa']);

        $this->assertInstanceOf(Collector::class, $response);

        $this->assertEquals('Hello, World', $response->get('data'));
    }

    public function testGetSuccess()
    {
        $response = $this->harbitue->get('ninja', ['data' => 'aaa']);

        $this->assertInstanceOf(Collector::class, $response);

        $this->assertEquals('Hello, World', $response->get('data'));
    }

    public function prepareGuzzleMock()
    {
        $mock = new MockHandler([
            new Response(200, ['X-Foo' => 'Bar'], '{"data": "Hello, World"}'),
            new Response(202, ['Content-Length' => 0]),
            new RequestException('Error Communicating with Server', new Request('GET', 'test')),
            new RequestException('Error Communicating with Server', new Request('POST', 'test')),
        ]);

        $handlerStack = HandlerStack::create($mock);
        return new Client(['handler' => $handlerStack]);
    }
}
