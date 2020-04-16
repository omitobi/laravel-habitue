<?php

use Habitue\Habitue;

if (! function_exists('habitue')) {

    function habitue(string $url, array $data = [])
    {
        return new Habitue($url, $data);
    }
}