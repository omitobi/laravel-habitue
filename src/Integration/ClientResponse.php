<?php

namespace Habitue\Integration;

use Habitue\Contracts\ClientResponseInterface;

class ClientResponse implements ClientResponseInterface
{
    private string $data;

    private int $statusCode;

    private array $headers;

    public function __construct(string $data, int $statusCode, array $headers)
    {
        $this->data = $data;
        $this->statusCode = $statusCode;
        $this->headers = $headers;
    }

    public function getData(): string
    {
        return $this->data;
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function __toString()
    {
        return $this->getData();
    }
}