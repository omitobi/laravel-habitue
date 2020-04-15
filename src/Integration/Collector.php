<?php

namespace Habitue\Integration;

use Habitue\Contracts\ClientResponseInterface;
use Habitue\Traits\MagicGetter;
use Tightenco\Collect\Support\Collection;
use Habitue\Contracts\CollectorInterface;

class Collector extends Collection implements CollectorInterface
{
    use MagicGetter;

    private ClientResponseInterface $response;

    public function response(): ClientResponseInterface
    {
        return $this->response;
    }

    public function statusCode(): int
    {
        return $this->response->getStatusCode();
    }

    public function headers(): array
    {
        return $this->response->getHeaders();
    }

    public function setResponse(ClientResponseInterface $clientResponse)
    {
        $this->response = $clientResponse;
    }
}
