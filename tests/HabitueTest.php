<?php
namespace Habitue\Tests;

use GuzzleHttp\Psr7\Response as GuzzleResponse;
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

        $this->habitue = new Habitue($this->client);
    }

    public function testMake()
    {
        $habitue = Habitue::make();

        $this->assertInstanceOf(HabitueInterface::class, $habitue);
    }

    public function testPostSuccess()
    {
        $response = $this->habitue->post('ninja', ['data' => 'aaa']);

        $this->assertInstanceOf(Response::class, $response);

        $this->assertEquals('Hello, World', $response->collect()->get('data'));
    }

    public function testPatchSuccess()
    {
        $response = $this->habitue->patch('ninja', ['data' => 'aaa']);

        $this->assertInstanceOf(Response::class, $response);

        $this->assertEquals('Hello, World', $response->collect()->get('data'));
    }

    public function testPutSuccess()
    {
        $response = $this->habitue->put('ninja', ['data' => 'aaa']);

        $this->assertInstanceOf(Response::class, $response);

        $this->assertEquals('Hello, World', $response->collect()->get('data'));
    }

    public function testDeleteSuccess()
    {
        $this->mock->reset();

        $this->mock->append(new GuzzleResponse(204, [], "[]"));

        $response = $this->habitue->delete('ninja');

        $this->assertInstanceOf(Response::class, $response);

        $this->assertEmpty($response->collect());
    }

    public function testGetSuccess()
    {
        $response = $this->habitue->get('ninja', ['data' => 'aaa']);

        $this->assertInstanceOf(Response::class, $response);

        $this->assertInstanceOf(Collector::class, $response->collect());

        $this->assertInstanceOf(Collection::class, $response->collect());

        $this->assertEquals('Hello, World', $response->collect()->get('data'));
    }

    public function testChainedRequest()
    {
        $response = $this->habitue->get('ninja', ['data' => 'aaa'])
            ->then(function (Response $response) {
                return $this->habitue->post('related-names', ['text' => $response->collect()->get('data')]);
        });

        $this->assertEquals('welcome', $response->collect()->get('data'));
    }
}
