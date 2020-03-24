<?php

namespace Harbitue\Integration;

use Harbitue\Contracts\CollectorInterface;
use Harbitue\Contracts\ResponseInterface;

class Response implements ResponseInterface
{
    private string $response;
    private CollectorInterface $wrapped;

    public function __construct(string $response)
    {
        $this->wrap($response);
    }

    public function wrap(string $response)
    {
        $this->response = $response;
        $this->wrapped = Collector::make($response);
    }

    public function getWrapped(): CollectorInterface
    {
        return $this->wrapped;
    }

    public function unwrap(): string
    {
        return $this->response;
    }

    public static function make(string $response)
    {
        return new static($response);
    }

    public function __toString()
    {
        return $this->unwrap();
    }
}
