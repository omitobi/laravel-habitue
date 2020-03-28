<?php

namespace Harbitue\Integration;

use Tightenco\Collect\Support\Collection;
use Harbitue\Contracts\CollectorInterface;

class Collector extends Collection implements CollectorInterface 
{
    private $response;

    public function __construct($response = [])
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
}
