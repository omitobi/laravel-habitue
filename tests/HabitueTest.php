<?php
namespace Habitue\Tests;

use Habitue\Habitue;
use PHPUnit\Framework\TestCase;
use Habitue\Integration\Response;
use Habitue\Integration\Collector;
use Habitue\Tests\Helpers\GuzzleMocker;
use Habitue\Contracts\HabitueInterface;
use Tightenco\Collect\Support\Collection;

class HabitueTest extends TestCase
{
    private Habitue $habitue;

    protected function setUp(): void
    {
        parent::setUp();

        $this->habitue = new Habitue(GuzzleMocker::prepareGuzzleMock());
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
