<?php

namespace Harbitue\Contracts;

use Illuminate\Support\Collection;

interface CollectorInterface
{
    public function attach(string $data, bool $decode = true);

    public function detach(Collection $collection);

    public function get(string $property);

    public function intercept(callable $caller);

    public static function make(string $data);
}
