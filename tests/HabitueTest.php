<?php
namespace Habitue\Tests;

use GuzzleHttp\Psr7\Response as GuzzleResponse;
use Habitue\Clients\GuzzleClient;
use Habitue\Habitue;
use GuzzleHttp\Client;
use PHPUnit\Framework\TestCase;
use Habitue\Integration\Response;
use Habitue\Integration\Collector;
use GuzzleHttp\Handler\MockHandler;
use Habitue\Tests\Helpers\GuzzleMocker;
use Habitue\Contracts\HabitueInterface;
use Tightenco\Collect\Support\Collection;

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
        $response = Habitue::make('http://ninja.example')->post();

        //todo.test config

        $this->assertInstanceOf(Collector::class, $response);

        $this->assertEquals('Hello, World', $response->get('data'));
    }

    public function testPatchSuccess()
    {
        $response = Habitue::make('http://ninja.example')->patch();

        $this->assertInstanceOf(Collector::class, $response);

        $this->assertEquals('Hello, World', $response->get('data'));
    }

    public function testPutSuccess()
    {
        $response = Habitue::make('ninja', ['data' => 'aaa'])->put();

        $this->assertInstanceOf(Collector::class, $response);

        $this->assertEquals('Hello, World', $response->get('data'));
    }

    public function testDeleteSuccess()
    {
        $this->mock->reset();

        $this->mock->append(new GuzzleResponse(204, [], "[]"));

        $response = Habitue::make('ninja')->delete();

        $this->assertInstanceOf(Collector::class, $response);

        $this->assertEmpty($response);
    }

    public function testGetSuccess()
    {
        $response = $response = Habitue::make('/ninja')->get();

        $this->assertInstanceOf(Collector::class, $response);

        $this->assertInstanceOf(Collector::class, $response);

        $this->assertInstanceOf(Collection::class, $response);

        $this->assertEquals('Hello, World', $response->get('data'));
    }
}
