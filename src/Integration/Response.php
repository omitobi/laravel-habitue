<?php

namespace Harbitue\Integration;

use Harbitue\Contracts\CollectorInterface;
use Harbitue\Contracts\ResponseInterface;
use Psr\Http\Message\ResponseInterface as GuzzleResponseInterface;

class Response implements ResponseInterface
{
    private GuzzleResponseInterface $response;
    private Collectable $collectable;

    public function __construct($response)
    {
        $this->wrap($response);

        $this->collectable = new Collectable(
            $this->response->getBody()->getContents(),
            $this->response->getStatusCode(),
            $this->response->getHeaders(),
        );

    }

    public function wrap($response): ResponseInterface
    {
        $this->response = $response;

        return $this;
    }

    public function collect(): CollectorInterface
    {
        return new Collector($this->array());
    }

    public function array(): array
    {
        return json_decode($this->json(), true);
    }

    public function json(): string
    {
        return $this->collectable->getContent();
    }

    public function getStatusCode(): int
    {
        return $this->collectable->getStatusCode();
    }

    public function getHeaders(): array
    {
        return $this->collectable->getHeaders();
    }

    public function getWrapped(): GuzzleResponseInterface
    {
        return $this->response;
    }

    private function unwrap(): string
    {
        return $this->collectable->toJson();
    }

    public static function make($response): ResponseInterface
    {
        return new static($response);
    }

    public function __toString(): string
    {
        return $this->unwrap();
    }
}
