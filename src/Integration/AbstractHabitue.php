<?php

namespace Habitue\Integration;

use Habitue\Clients\GuzzleClient;
use Habitue\Contracts\ClientInterface;

abstract class AbstractHabitue
{
    protected ClientInterface $client;

    protected function initializeClient()
    {
        if ($this->getClientName() === 'guzzle') {
            $this->client = $this->getGuzzleClient();
        } else {
            $this->client = $this->getGuzzleClient();
        }
    }

    protected function getGuzzleClient()
    {
        $options = $this->getDefaultOptions();

        if (function_exists('app')) {
            return app(GuzzleClient::class, $options);
        }

        return new GuzzleClient($options);
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