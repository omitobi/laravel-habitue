<?php
namespace Harbitue\Tests;

use Harbitue\Harbitue;
use Harbitue\Tests\Helpers\GuzzleMocker;
use PHPUnit\Framework\TestCase;
use Harbitue\Integration\Collector;
use Harbitue\Integration\Response;
use Tightenco\Collect\Support\Collection;

class HarbitueTest extends TestCase
{
    private Harbitue $harbitue;

    protected function setUp(): void
    {
        parent::setUp();

        $this->harbitue = new Harbitue(GuzzleMocker::prepareGuzzleMock());
    }

    public function testPostSuccess()
    {
        $response = $this->harbitue->post('ninja', ['data' => 'aaa']);

        $this->assertInstanceOf(Response::class, $response);

        $this->assertEquals('Hello, World', $response->collect()->get('data'));
    }

    public function testGetSuccess()
    {
        $response = $this->harbitue->get('ninja', ['data' => 'aaa']);

        $this->assertInstanceOf(Response::class, $response);
        $this->assertInstanceOf(Collector::class, $response->collect());
        $this->assertInstanceOf(Collection::class, $response->collect());

        $this->assertEquals('Hello, World', $response->collect()->get('data'));
    }
}
