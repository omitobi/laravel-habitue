<?php
namespace Habitue\Tests;

use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Habitue\Clients\GuzzleClient;
use Habitue\Habitue;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Habitue\Integration\Collector;
use GuzzleHttp\Handler\MockHandler;
use Habitue\Tests\Helpers\GuzzleMocker;
use Habitue\Contracts\HabitueInterface;
use Illuminate\Support\Collection;

class HabitueTest extends TestCase
{
    private Habitue $habitue;

    private Client $client;

    private MockHandler $mock;

    protected function setUp(): void
    {
        parent::setUp();

        [$this->mock, ,$this->client] = GuzzleMocker::prepareGuzzleMock();

        GuzzleClient::mock($this->client);
    }

    public function testHelper()
    {
        $this->assertInstanceOf(HabitueInterface::class, habitue('abc', []));
    }

    public function testMake()
    {
        $habitue = Habitue::make('http://ninja.example');

        $this->assertInstanceOf(HabitueInterface::class, $habitue);
    }

    public function testPostSuccess()
    {
        /**
         * @var Collector $response
         */
        $response = habitue('http://ninja.example')->post();

        //todo.test config

        $this->assertInstanceOf(Collector::class, $response);

        $this->assertEquals('Hello, World', $response->get('data'));
    }

    public function testPatchSuccess()
    {
        $response = habitue('http://ninja.example')->patch();

        $this->assertInstanceOf(Collector::class, $response);

        $this->assertEquals('Hello, World', $response->get('data'));
    }

    public function testPutSuccess()
    {
        $response = habitue('ninja', ['data' => 'aaa'])->put();

        $this->assertInstanceOf(Collector::class, $response);

        $this->assertEquals('Hello, World', $response->get('data'));
    }

    public function testDeleteSuccess()
    {
        $this->mock->reset();

        $this->mock->append(new GuzzleResponse(204, [], "[]"));

        $response = habitue('ninja')->delete();

        $this->assertInstanceOf(Collector::class, $response);

        $this->assertEmpty($response);
    }

    public function testGetSuccess()
    {
        $response = $response = habitue('/ninja')->get();

        $this->assertInstanceOf(Collector::class, $response);

        $this->assertInstanceOf(Collector::class, $response);

        $this->assertInstanceOf(Collection::class, $response);

        $this->assertEquals('Hello, World', $response->get('data'));
    }

    public function testGetDataFromResponseDirectly()
    {
        $response = $response = habitue('/ninja')->get('data');

        $this->assertEquals('Hello, World', $response);
    }

    public function testRealCall(): void
    {
        // Use realClient.
        GuzzleClient::unMock();

        $response = habitue('http://example.com')->setHeaders([
            'Content-Type' => 'text/html',
        ], true)->get();

        $this->assertInstanceOf(Collector::class, $response);
        $this->assertEquals(200, $response->response()->getStatusCode());
        $this->assertStringContainsString('Example Domain', $response->response()->getData());

        // Let's use headers set from the config.
        $response = habitue('http://example.com', [], [
            'Content-Type' => 'text/html',
        ])->get();

        $this->assertInstanceOf(Collector::class, $response);
        $this->assertEquals(200, $response->response()->getStatusCode());
        $this->assertStringContainsString('Example Domain', $response->response()->getData());
        $this->assertEquals('text/html', $response->headers()['Content-Type'][0]);
    }
}
