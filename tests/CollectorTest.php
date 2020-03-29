<?php

namespace Harbitue\Tests;

use Harbitue\Integration\Collector;
use PHPUnit\Framework\TestCase;

class CollectorTest extends TestCase
{
    private Collector $collector;

    protected function setUp(): void
    {
        parent::setUp();

        $this->collector = new Collector([
           'name' => 'John Doe',
           'age' => 11,
            'addresses' => [
                'postal' => '11111',
                'city' => 'Tartu',
            ]
        ]);
    }

    public function testMagicGetter()
    {
        $name = $this->collector->getName();
        $address = $this->collector->getAddresses();
        $age = $this->collector->get('age');

        $this->assertInstanceOf(Collector::class, $address);
        $this->assertTrue(is_string($name));
        $this->assertEquals('John Doe', $name);
        $this->assertEquals(11, $age);
    }
}