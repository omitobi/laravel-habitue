<?php

namespace Harbitue\Integration;

use Illuminate\Support\Collection;
use Harbitue\Contracts\CollectorInterface;

class Collector implements CollectorInterface
{
    private Collection $data;

    public function __construct(string $data)
    {
        $this->attach($data);
    }

    public function attach(string $data, bool $decode = true)
    {
        $this->data = Collection::make(
            $decode
                ? json_decode($data, true)
                : $data
        );
    }

    public function detach(Collection $collection)
    {
        return $this->data->toJson();
    }

    public function get(string $property)
    {
        return $this->data->get($property);
    }

    public function intercept(callable $caller)
    {
        return $caller($this->data);
    }

    public static function make(string $data)
    {
        return new static($data);
    }
}
