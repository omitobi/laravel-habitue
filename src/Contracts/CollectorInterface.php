<?php

namespace Harbitue\Contracts;

use Tightenco\Collect\Support\Collection;

interface CollectorInterface
{
    public function attach(string $data, bool $decode = true);

    public function detach(): string;

    public function getAttached(): Collection;

    public function get(string $property);

    public function intercept(callable $caller);

    public static function make(string $data);
}
