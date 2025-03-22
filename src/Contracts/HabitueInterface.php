<?php

namespace Habitue\Contracts;

use Habitue\Integration\Collector;

interface HabitueInterface
{
    public static function make(string $url, array $data = [],  array $config = []): HabitueInterface;

    public function setHeaders(array $data, bool $overwrite = false): HabitueInterface;

    public function setBody(array $body, bool $overwrite = false): HabitueInterface;

    public function get($key = null);

    public function post($key = null);

    public function patch($key = null);

    public function put($key = null);

    public function delete($key = null);
}
