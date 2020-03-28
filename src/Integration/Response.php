<?php

namespace Harbitue\Integration;

use Harbitue\Contracts\CollectorInterface;
use Harbitue\Contracts\ResponseInterface;
use Harbitue\Integration\Collectable;

class Response implements ResponseInterface
{
    private $response;
    private $collectable;
    private CollectorInterface $wrapped;

    public function __construct($response)
    {
        $this->wrap($response);

        $this->collectable = new Collectable(
            $this->response->getBody()->getContents(),
            $this->response->getStatusCode(),
            [],
        );

    }

    public function wrap($response)
    {
        $this->response = $response;
    }

    public function collect()
    {
        return new Collector(
            json_decode($this->collectable->getContent(), true)
        );
    }

    public function getStatusCode()
    {
        return $this->response->getBody()->getStatusCode();
    }

    public function getWrapped()
    {
        return $this->wrapped;
    }

    public function unwrap()
    {
        return $this->response;
    }

    public static function make($response)
    {
        return new static($response);
    }

    public function __toString()
    {
        return $this->unwrap();
    }
}
