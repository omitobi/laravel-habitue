<?php

namespace Harbitue\Integration;

use Tightenco\Collect\Support\Collection;
use Harbitue\Contracts\CollectorInterface;

class Collector extends Collection implements CollectorInterface
{
    private array $response;

    public function __construct(array $response = [])
    {
        $this->attach($response);

        parent::__construct($response);
    }

    public function attach($response)
    {
        $this->response = $response;
    }

    public function detach()
    {
        return $this->response;
    }

    // Trait Getter

    public function __call($method, $parameters)
    {
        if (method_exists($this, $method)) {
            return parent::__call($method, $parameters);
        }

        if (!(strlen($method) > 3 && strtolower(substr($method, 0, 3)) === 'get')) {
            return parent::__call($method, $parameters);
        }

        $value = $this->get(strtolower(substr($method, 3)));

        return is_array($value)
            ? $this->make($value)
            : $value;
    }
}
