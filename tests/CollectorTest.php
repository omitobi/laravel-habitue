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
           'height' => 57,
            'address' => [
                'postal' => [
                    'code' => '11111',
                    'region' => 'lc'
                ],
                'city' => 'Tartu',
            ]
        ]);
    }

    public function testMagicGetter()
    {
        $name = $this->collector->getName();
        $address = $this->collector->getAddress();
        $age = $this->collector->get('age');

        $this->assertInstanceOf(Collector::class, $address);
        $this->assertTrue(is_string($name));
        $this->assertEquals('John Doe', $name);
        $this->assertEquals(11, $age);
    }

    public function testDeeperMagicGetter()
    {
        $address = $this->collector
            ->getAddress();

        $city = $address->getCity();
        $postalCode = $address->getPostal()
            ->getCode();

        $this->assertTrue(is_string($city));
        $this->assertEquals('Tartu', $city);
        $this->assertTrue(is_string($postalCode));
        $this->assertEquals('11111', $postalCode);
    }
}