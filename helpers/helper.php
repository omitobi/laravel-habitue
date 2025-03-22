<?php

use Habitue\Contracts\HabitueInterface;
use Habitue\Habitue;

if (! function_exists('habitue')) {

    function habitue(string $url, array $data = [], array $config = []): HabitueInterface
    {
        return new Habitue($url, $data, $config);
    }
}