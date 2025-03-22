<?php

namespace Habitue\Integration;

use Habitue\Clients\GuzzleClient;
use Habitue\Contracts\ClientInterface;
use Habitue\Contracts\HabitueInterface;

abstract class AbstractHabitue
{
    protected ClientInterface $client;

    protected function initializeClient(array $config = []): void
    {
        if ($this->getClientName() === 'guzzle') {
            $this->client = $this->getGuzzleClient($config);
        } else {
            $this->client = $this->getGuzzleClient($config);
        }
    }

    protected function getGuzzleClient(array $config = []): GuzzleClient
    {
        $options = $this->getDefaultOptions();

        if (function_exists('app')) {
            return app(GuzzleClient::class, $config + $options);
        }

        return new GuzzleClient($config + $options);
    }

    protected function getClientName()
    {
        return 'guzzle'; //config('habitue.client')
    }

    protected function getDefaultOptions(): array
    {
        // normal config('habitue.default_options')
        return [
            'headers' => [
                'content-type' => 'application/json',
                'accept' => 'application/json'
            ]
        ];
    }

    abstract protected function getResponse(): ClientResponse;
}